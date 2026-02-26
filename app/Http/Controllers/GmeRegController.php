<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\BusinessPhoto;

use App\Models\GmeBusinessForm;
use App\Models\BusinessCategory;
use App\Mail\BusinessCreatedMail;
use App\Mail\BusinessCreatedMailforDirectory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendBusinessCreationEmailJob;

class GmeRegController extends Controller
{
    //FOR ALL

    public function showRegisterForm(Request $request)
    {
        $step = $request->get('step', 1);
        // $customer = session('customer');
        $customer = auth()->guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Please login first');
        }

        // Check if draft exists
        $business = GmeBusinessForm::where('customer_id', $customer->id)
            ->where('status', 'draft')
            ->first();

        // If no draft exists, create a blank object (not saved yet)
        if (!$business) {
            $business = new GmeBusinessForm();
            $business->customer_id = $customer->id;
            $business->status = 'draft';
        }

        $categories = BusinessCategory::all();
        $countries = $this->getCountries();

        return view('gme-reg.register', compact('step', 'business', 'categories', 'countries'));
    }

    public function getServices($categoryId)
    {
        return response()->json(
            Service::where('business_category_id', $categoryId)
                ->select('id', 'name')
                ->get()
        );
    }

    public function saveStep(Request $request)
    {
        $step = $request->input('step');
        $customer = auth()->guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Session expired. Please login again.');
        }

        // Validation
        $validator = $this->validateStep($request, $step);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find existing draft or create new
        $business = GmeBusinessForm::where('customer_id', $customer->id)
            ->where('status', 'draft')
            ->first();

        if (!$business) {
            $business = new GmeBusinessForm();
            $business->customer_id = $customer->id;
            $business->status = 'draft';
        }

        // Save data based on step
        switch ($step) {
            case 1:
                $this->saveStep1($request, $business);
                break;
            case 2:
                $this->saveStep2($request, $business);
                break;
            case 3:
                $this->saveStep3($request, $business);
                break;
            case 4:
                $this->saveStep4($request, $business);
                break;
        }

        $business->last_updated_step = $step;
        $business->save();

        // If final step, change status to pending
        if ($step == 4) {
            $business->status = 'pending';
            $business->save();

            // Send email to customer for creation of business
            // BusinessCreatedMail::dispatch($business);
            Mail::to($customer->email)->send(new BusinessCreatedMail($business));

            // Send notification email to directory@gme.network
            Mail::to('directory@gme.network')->send(new BusinessCreatedMailforDirectory($business, 'Notification for business request'));



            return redirect()->route('gme.business.success')
                ->with('success', 'Your business has been successfully registered!');
        }

        // Move to next step
        $nextStep = $step + 1;
        return redirect()->route('gme.business.register', ['step' => $nextStep])
            ->with('success', 'Step ' . $step . ' saved successfully!');
    }

    /**
     * Validate step data
     */
    private function validateStep(Request $request, $step)
    {
        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'business_name' => 'required|string|max:255',
                    'short_introduction' => 'nullable|string',
                    'year_established' => 'nullable|string',
                    'business_category_id' => 'required|exists:business_categories,id',
                    'countries_of_operation' => 'required|array|min:1',
                    'business_address' => 'nullable|string',
                    'email' => 'required|email',
                    'whatsapp_prefix' => 'nullable|string|max:10',
                    'business_contact_person_name' => 'nullable|string|max:255',
                    'whatsapp_number' => 'nullable|string|max:20',
                    'website' => 'nullable|string|max:255',
                    'facebook' => 'nullable|string|max:255',
                    'instagram' => 'nullable|string|max:255',
                    'linkedin' => 'nullable|string|max:255',
                    'youtube' => 'nullable|string|max:255',
                    'online_store' => 'nullable|string|max:255',
                    'founders' => 'required|array|min:1',
                    'founders.*.name' => 'required|string',
                    'founders.*.designation' => 'required|string',
                    'founders.*.whatsapp' => 'nullable|string',
                    'founders.*.linkedin' => 'nullable|string|max:255',
                ];
                break;

            case 2:
                $rules = [
                    'registration_status' => 'required|in:registered_company,sole_proprietorship,partnership,startup_early_stage,home_based,not_registered_yet',
                    'employee_count' => 'required|in:1-3,4-10,11-25,26-50,51+',
                    'operational_scale' => 'required|in:local,nationwide,international,online_only,hybrid',
                    'annual_revenue' => 'nullable|in:under_10k,10k-50k,50k-200k,200k-1m,above_1m',
                    'business_overview' => 'nullable|string|max:1800',
                    'services_id' => 'required|array|max:10',
                    // 'services_id.*' => 'exists:services,id',
                    // Custom validation যোগ করুন
                    'services_id.*' => [
                        'required',
                        'string',
                        function ($attribute, $value, $fail) {
                            // যদি "new:" দিয়ে শুরু হয় তাহলে allow করুন
                            if (strpos($value, 'new:') === 0) {
                                $serviceName = str_replace('new:', '', $value);
                                // Check করুন নাম খালি নয়
                                if (empty(trim($serviceName))) {
                                    $fail('Service name cannot be empty.');
                                }
                                return;
                            }
                            // নাহলে database-এ exist করতে হবে
                            if (!is_numeric($value) || !\App\Models\Service::where('id', $value)->exists()) {
                                $fail('The selected service is invalid.');
                            }
                        }
                    ],

                    'collaboration_open' => 'required|in:yes,no,maybe',
                    'collaboration_types' => 'nullable|array',
                    'collaboration_types.*' => 'in:Partnerships,Investment Oportunities,Vendor Supply Chain,Marketing Promotion,Networking,Mentorship or Growth Coaching,Community Charity Projects,Not Sure Yet',

                    // Documents + Images
                    'registration_document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif|max:5120',
                    'business_profile'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif|max:5120',
                    'product_catalogue'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif|max:5120',

                    // Images only (all image types)
                    'logo'                  => 'nullable|image|max:2048',
                    'cover_photo'           => 'nullable|image|max:2048',
                    'photos.*'              => 'nullable|image|max:2048',

                    // 'registration_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                    // 'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                    // 'cover_photo' => 'nullable|image|max:5120',
                    // 'photos.*' => 'nullable|image|max:5120',
                    // 'business_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                    // 'product_catalogue' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                ];
                break;

            case 3:
                $rules = [
                    'finance_practices' => 'nullable|array',
                    'finance_practices.*' => 'string|max:255',
                    
                    'product_practices' => 'nullable|array',
                    'product_practices.*' => 'string|max:255',
                    
                    'community_practices' => 'nullable|array',
                    'community_practices.*' => 'string|max:255',
                    
                    'ethical_description' => 'nullable|string|max:1200',
                ];
                break;

            case 4:
                $rules = [
                    'info_accuracy' => 'required|accepted',
                    'allow_publish' => 'nullable|boolean',
                    'allow_contact' => 'required|accepted',
                    'digital_signature' => 'required|string',
                ];
                break;
        }

        return Validator::make($request->all(), $rules);
    }

    /**
     * Save Step 1 data
     */

    private function saveStep1(Request $request, GmeBusinessForm $business)
    {
        // Save business WhatsApp
        $businessPrefix = $request->input('whatsapp_prefix', '+880');
        $businessNumber = preg_replace('/\D/', '', $request->input('whatsapp_number', ''));
        
        $business->business_name = $request->business_name;
        $business->business_contact_person_name = $request->business_contact_person_name;
        $business->short_introduction = $request->short_introduction;
        $business->year_established = $request->year_established;
        $business->business_category_id = $request->business_category_id;
        $business->countries_of_operation = json_encode($request->countries_of_operation);
        $business->business_address = $request->business_address;
        $business->email = $request->email;
        
        // Combine prefix and number for business WhatsApp
        $business->whatsapp_number = $businessNumber ? $businessPrefix . $businessNumber : null;
        
        $business->website = $request->website;
        $business->facebook = $request->facebook;
        $business->instagram = $request->instagram;
        $business->linkedin = $request->linkedin;
        $business->youtube = $request->youtube;
        $business->online_store = $request->online_store;

        // Process founders and combine their WhatsApp numbers
        $founders = $request->input('founders', []);
        foreach ($founders as $index => &$founder) {
            $founderPrefix = $founder['whatsapp_prefix'] ?? '+880';
            $founderNumber = preg_replace('/\D/', '', $founder['whatsapp_number'] ?? '');
            
            // Combine prefix and number, or set to null if no number
            $founder['whatsapp_number'] = $founderNumber ? $founderPrefix . $founderNumber : null;
            
            // Remove the separate prefix field since we've combined it
            unset($founder['whatsapp_prefix']);
        }
        
        // Save founders as JSON
        $business->founders = json_encode($founders);
    }

    /**
     * Save Step 2 data
     */

    private function saveStep2(Request $request, GmeBusinessForm $business)
    {
        $business->registration_status = $request->registration_status;
        $business->employee_count = $request->employee_count;
        $business->operational_scale = $request->operational_scale;
        $business->annual_revenue = $request->annual_revenue;
        $business->business_overview = $request->business_overview;

        // FIX: Save services_id properly
        // $business->services_id = $request->services_id ? json_encode($request->services_id) : null;
        // Process services - handle both existing and new services
        $servicesData = [];
        
        if ($request->has('services_id') && is_array($request->services_id)) {
            foreach ($request->services_id as $serviceId) {
                if (strpos($serviceId, 'new:') === 0) {
                    // নতুন custom service
                    $newServiceName = trim(str_replace('new:', '', $serviceId));
                    
                    if (!empty($newServiceName)) {
                        // Database-এ নতুন service create করুন
                        $newService = \App\Models\Service::firstOrCreate(
                            ['name' => $newServiceName],
                            ['business_category_id' => $business->business_category_id ?? null]
                        );
                        
                        $servicesData[] = $newService->id;
                    }
                } else {
                    // Existing service ID
                    $servicesData[] = (int)$serviceId;
                }
            }
        }
        
        // Save services as JSON
        // $business->services_id = json_encode($servicesData);
        $business->services_id = $servicesData;

        $business->collaboration_open = $request->collaboration_open;
        $business->collaboration_types = json_encode($request->collaboration_types ?? []);

       
    }

    /**
     * Save Step 3 data
     */
    private function saveStep3(Request $request, GmeBusinessForm $business)
    {
        $business->finance_practices = $request->finance_practices ?? [];
        $business->product_practices = $request->product_practices ?? [];
        $business->community_practices = $request->community_practices ?? [];
        $business->ethical_description = $request->ethical_description;

    }

    /**
     * Save Step 4 data
     */
    private function saveStep4(Request $request, GmeBusinessForm $business)
    {
        $business->info_accuracy = $request->has('info_accuracy');
        $business->allow_publish = $request->has('allow_publish');
        $business->allow_contact = $request->has('allow_contact');
        $business->digital_signature = $request->digital_signature;
        $business->status = 'pending'; // Set to pending for admin approval
    }

    /**
     * Success page
     */
    public function success()
    {
        return view('gme-reg.success');
    }

    /**
     * Get list of countries (helper method)
     */
    private function getCountries()
    {
        return [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Argentina', 'Armenia', 'Australia',
            'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium',
            'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei',
            'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde',
            'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo',
            'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica',
            'Dominican Republic', 'East Timor', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea',
            'Eritrea', 'Estonia', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia',
            'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana',
            'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland',
            'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'North Korea',
            'South Korea', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho',
            'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Madagascar',
            'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius',
            'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique',
            'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger',
            'Nigeria', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea',
            'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda',
            'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino',
            'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone',
            'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan',
            'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Swaziland', 'Sweden', 'Switzerland', 'Syria',
            'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia',
            'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom',
            'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam',
            'Yemen', 'Zambia', 'Zimbabwe'
        ];
    }
    ///////////////////////////
    // Auto-upload single file
    //////////////////////////
    public function uploadFile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|max:5120',
                'field_name' => 'required|string',
                'business_id' => 'required|exists:gme_business_forms,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $fieldName = $request->field_name;
            $business = GmeBusinessForm::findOrFail($request->business_id);

            // Validate file type based on field
            $allowedMimes = [
                'logo' => 'image',
                'cover_photo' => 'image',
                'registration_document' => 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif',
                'business_profile' => 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif',
                'product_catalogue' => 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,avif'
            ];

            $maxSizes = [
                'logo' => 2048,
                'cover_photo' => 2048,
                'registration_document' => 5120,
                'business_profile' => 5120,
                'product_catalogue' => 5120
            ];

            $fileValidator = Validator::make($request->all(), [
                'file' => ($allowedMimes[$fieldName] ?? 'file') . '|max:' . ($maxSizes[$fieldName] ?? 5120)
            ]);

            if ($fileValidator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $fileValidator->errors()->first()
                ], 422);
            }

            // Delete old file if exists
            if ($business->$fieldName && file_exists(public_path('assets/' . $business->$fieldName))) {
                unlink(public_path('assets/' . $business->$fieldName));
            }

            // Upload new file
            $folderMap = [
                'logo' => 'uploads/business/logos',
                'cover_photo' => 'uploads/business/covers',
                'registration_document' => 'uploads/business/documents',
                'business_profile' => 'uploads/business/profiles',
                'product_catalogue' => 'uploads/business/catalogues'
            ];

            $path = $request->file('file')->store($folderMap[$fieldName] ?? 'uploads/business', 'public_folder');
            
            $business->$fieldName = $path;
            $business->save();

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'file_url' => asset('assets/' . $path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete single file
    public function deleteFile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'business_id' => 'required|exists:gme_business_forms,id',
                'field_name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $business = GmeBusinessForm::findOrFail($request->business_id);
            $fieldName = $request->field_name;

            // Delete file from storage
            if ($business->$fieldName && file_exists(public_path('assets/' . $business->$fieldName))) {
                unlink(public_path('assets/' . $business->$fieldName));
            }

            // Clear database field
            $business->$fieldName = null;
            $business->save();

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Upload gallery photos
    public function uploadGallery(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'photos.*' => 'required|image|max:2048',
                'business_id' => 'required|exists:gme_business_forms,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $business = GmeBusinessForm::findOrFail($request->business_id);
            
            // Check max limit
            $existingCount = $business->businessPhotos()->count();
            $newCount = count($request->file('photos'));
            
            if ($existingCount + $newCount > 6) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum 6 photos allowed. You have ' . $existingCount . ' photos already.'
                ], 422);
            }

            $uploadedPhotos = [];

            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('uploads/business/gallery', 'public_folder');

                $businessPhoto = BusinessPhoto::create([
                    'gme_business_form_id' => $business->id,
                    'image_url' => $path
                ]);

                $uploadedPhotos[] = [
                    'id' => $businessPhoto->id,
                    'url' => asset('assets/' . $path)
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Photos uploaded successfully',
                'photos' => $uploadedPhotos
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete gallery photo
    public function deleteGalleryPhoto(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'photo_id' => 'required|exists:business_photos,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $photo = BusinessPhoto::findOrFail($request->photo_id);

            // Delete file from storage
            if ($photo->image_url && file_exists(public_path('assets/' . $photo->image_url))) {
                unlink(public_path('assets/' . $photo->image_url));
            }

            // Delete database record
            $photo->delete();

            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
