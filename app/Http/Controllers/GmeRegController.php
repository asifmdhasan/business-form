<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GmeRegController extends Controller
{
    public function showRegister(Request $request)
    {
        $step = $request->get('step', 1);
        $businessId = $request->get('business_id');
        
        $business = $businessId ? GmeBusiness::find($businessId) : new GmeBusiness();
        
        // Get dropdown data
        $categories = BusinessCategory::all();
        $services = Service::all();
        $countries = $this->getCountries(); // You can create this helper method
        
        return view('gme.business.register', compact('step', 'business', 'categories', 'services', 'countries'));
    }

    /**
     * Save step data
     */
    public function saveStep(Request $request)
    {
        $step = $request->input('step');
        $businessId = $request->input('business_id');
        
        // Validate based on step
        $validator = $this->validateStep($request, $step);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Find or create business
        $business = $businessId ? GmeBusiness::find($businessId) : new GmeBusiness();
        
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
        
        $business->save();
        
        // Determine next action
        if ($request->input('action') === 'submit' && $step == 4) {
            return redirect()->route('gme.business.success')
                ->with('success', 'Your business has been successfully registered!');
        }
        
        // Move to next step
        $nextStep = $step + 1;
        return redirect()->route('gme.business.register', [
            'step' => $nextStep,
            'business_id' => $business->id
        ])->with('success', 'Step ' . $step . ' saved successfully!');
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
                    'whatsapp_number' => 'required|string',
                    'website' => 'nullable|url',
                    'facebook' => 'nullable|url',
                    'instagram' => 'nullable|url',
                    'linkedin' => 'nullable|url',
                    'youtube' => 'nullable|url',
                    'online_store' => 'nullable|url',
                    'founders' => 'required|array|min:1',
                    'founders.*.name' => 'required|string',
                    'founders.*.designation' => 'required|string',
                    'founders.*.whatsapp' => 'nullable|string',
                    'founders.*.linkedin' => 'nullable|url',
                ];
                break;
                
            case 2:
                $rules = [
                    'registration_status' => 'nullable|in:registered_company,sole_proprietorship,partnership,startup_early_stage,home_based,not_registered_yet',
                    'employee_count' => 'nullable|in:1-3,4-10,11-25,26-50,51+',
                    'operational_scale' => 'nullable|in:local,nationwide,international,online_only,hybrid',
                    'annual_revenue' => 'nullable|in:under_10k,10k-50k,50k-200k,200k-1m,above_1m',
                    'business_overview' => 'nullable|string|max:1800',
                    'services_id' => 'nullable|array|max:10',
                    'services_id.*' => 'exists:services,id',
                    'registration_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                    'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                    'cover_photo' => 'nullable|image|max:5120',
                    'photos.*' => 'nullable|image|max:5120',
                    'business_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                    'product_catalogue' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                ];
                break;
                
            case 3:
                $rules = [
                    'avoid_riba' => 'required|in:yes,partially_transitioning,no,prefer_not_to_say',
                    'avoid_haram_products' => 'required|in:yes,partially_compliant,no',
                    'fair_pricing' => 'required|in:yes,mostly,needs_improvement',
                    'ethical_description' => 'nullable|string|min:100|max:1200',
                    'open_for_guidance' => 'required|in:yes,no,maybe',
                    'collaboration_open' => 'required|in:yes,no,maybe',
                    'collaboration_types' => 'nullable|array',
                    'collaboration_types.*' => 'in:partnerships,investment_opportunities,vendor_supply_chain,marketing_promotion,networking,training_workshops,community_charity_projects,not_sure_yet',
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
    private function saveStep1(Request $request, GmeBusiness $business)
    {
        $business->business_name = $request->business_name;
        $business->short_introduction = $request->short_introduction;
        $business->year_established = $request->year_established;
        $business->business_category_id = $request->business_category_id;
        $business->countries_of_operation = json_encode($request->countries_of_operation);
        $business->business_address = $request->business_address;
        $business->email = $request->email;
        $business->whatsapp_number = $request->whatsapp_number;
        $business->website = $request->website;
        $business->facebook = $request->facebook;
        $business->instagram = $request->instagram;
        $business->linkedin = $request->linkedin;
        $business->youtube = $request->youtube;
        $business->online_store = $request->online_store;
        
        // Save founders as JSON
        $business->founders = json_encode($request->founders);
    }

    /**
     * Save Step 2 data
     */
    private function saveStep2(Request $request, GmeBusiness $business)
    {
        $business->registration_status = $request->registration_status;
        $business->employee_count = $request->employee_count;
        $business->operational_scale = $request->operational_scale;
        $business->annual_revenue = $request->annual_revenue;
        $business->business_overview = $request->business_overview;
        $business->services_id = json_encode($request->services_id);
        
        // Handle file uploads
        if ($request->hasFile('registration_document')) {
            if ($business->registration_document) {
                Storage::disk('public')->delete($business->registration_document);
            }
            $business->registration_document = $request->file('registration_document')->store('business/documents', 'public');
        }
        
        if ($request->hasFile('logo')) {
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }
            $business->logo = $request->file('logo')->store('business/logos', 'public');
        }
        
        if ($request->hasFile('cover_photo')) {
            if ($business->cover_photo) {
                Storage::disk('public')->delete($business->cover_photo);
            }
            $business->cover_photo = $request->file('cover_photo')->store('business/covers', 'public');
        }
        
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('business/photos', 'public');
            }
            $business->photos = json_encode($photos);
        }
        
        if ($request->hasFile('business_profile')) {
            if ($business->business_profile) {
                Storage::disk('public')->delete($business->business_profile);
            }
            $business->business_profile = $request->file('business_profile')->store('business/profiles', 'public');
        }
        
        if ($request->hasFile('product_catalogue')) {
            if ($business->product_catalogue) {
                Storage::disk('public')->delete($business->product_catalogue);
            }
            $business->product_catalogue = $request->file('product_catalogue')->store('business/catalogues', 'public');
        }
    }

    /**
     * Save Step 3 data
     */
    private function saveStep3(Request $request, GmeBusiness $business)
    {
        $business->avoid_riba = $request->avoid_riba;
        $business->avoid_haram_products = $request->avoid_haram_products;
        $business->fair_pricing = $request->fair_pricing;
        $business->ethical_description = $request->ethical_description;
        $business->open_for_guidance = $request->open_for_guidance;
        $business->collaboration_open = $request->collaboration_open;
        $business->collaboration_types = json_encode($request->collaboration_types ?? []);
    }

    /**
     * Save Step 4 data
     */
    private function saveStep4(Request $request, GmeBusiness $business)
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
        return view('gme.business.success');
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
}
