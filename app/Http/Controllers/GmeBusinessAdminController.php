<?php

namespace App\Http\Controllers;

use App\Mail\BusinessAdminUpdateNotification;
use App\Mail\BusinessStatusUpdated;
use App\Mail\ContactRequestApproved;
use App\Mail\ContactRequestApprovedOwner;
use App\Mail\ContactRequestRejected;
use App\Models\BusinessCategory;
use App\Models\ContactRequest;
use App\Models\GmeBusinessForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GmeBusinessAdminController extends Controller
{
    /**
     * Human readable labels for every editable column, used for the
     * "what changed" e-mail sent to the business after an admin update.
     * Keys MUST match the actual database column names.
     */
    private array $fieldLabels = [
        'business_name'                 => 'Business Name',
        'business_contact_person_name'  => 'Contact Person Name',
        'short_introduction'            => 'Short Introduction',
        'year_established'              => 'Year Established',
        'business_category_id'          => 'Business Category',
        'countries_of_operation'        => 'Countries of Operation',
        'business_address'              => 'Business Address',
        'email'                         => 'Email',
        'whatsapp_number'               => 'WhatsApp Number',
        'website'                       => 'Website',
        'facebook'                      => 'Facebook',
        'instagram'                     => 'Instagram',
        'linkedin'                      => 'LinkedIn',
        'youtube'                       => 'YouTube',
        'online_store'                  => 'Online Store',
        'founders'                      => 'Founders',
        'registration_status'           => 'Registration Status',
        'employee_count'                => 'Employee Count',
        'operational_scale'             => 'Operational Scale',
        'annual_revenue'                => 'Annual Revenue',
        'business_overview'             => 'Business Overview',
        'services_id'                   => 'Products / Services',
        'registration_document'         => 'Registration Document',
        'logo'                          => 'Logo',
        'cover_photo'                   => 'Cover Photo',
        'business_profile'              => 'Business Profile',
        'product_catalogue'             => 'Product Catalogue',
        'ethical_description'           => 'Ethical Description',
        'collaboration_open'            => 'Collaboration Open',
        'collaboration_types'           => 'Collaboration Types',
        'finance_practices'             => 'Finance & Business Practices',
        'product_practices'             => 'Product & Services Practices',
        'community_practices'           => 'Community & Responsibility Practices',
        'info_accuracy'                 => 'Info Accuracy',
        'allow_publish'                 => 'Allow Publish',
        'allow_contact'                 => 'Allow Contact',
        'digital_signature'             => 'Digital Signature',
        'is_verified'                   => 'GME Verified',
        'is_featured'                   => 'Featured Business',
        'status'                        => 'Business Status',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = GmeBusinessForm::select(
                'id',
                'business_name',
                'business_category_id',
                'status',
                'logo',
                'countries_of_operation',
                'created_at'
            )->with('category:id,name')
            ->where('status', '!=', 'draft');

            if ($request->status) {
                $query->where('status', $request->status);
            }

            return response()->json([
                'businesses' => $query->orderBy('id', 'desc')->get()
            ]);
        }

        return view('gme-business-admin.index');
    }

    public function edit($id)
    {
        $business = GmeBusinessForm::with('businessPhotos')->findOrFail($id);
        $countries = $this->getCountries();
        $categories = BusinessCategory::orderBy('name')->get();

        return view('gme-business-admin.edit', compact('business', 'countries', 'categories'));
    }

    // public function update(Request $request, $id)
    // {
    //     $business = GmeBusinessForm::findOrFail($id);

    //     // Snapshot of ALL current (casted) attribute values BEFORE anything
    //     // is changed. This is what lets us build an accurate "old value"
    //     // vs "new value" diff for the notification e-mail below.
    //     $originalData = $business->toArray();

    //     $validated = $request->validate([
    //         // Business Identity
    //         'business_name'                 => 'required|string|max:255',
    //         'business_contact_person_name'  => 'nullable|string|max:255',
    //         'short_introduction'             => 'nullable|string',
    //         'year_established'               => 'nullable|string|max:255',
    //         'business_category_id'           => 'nullable|exists:business_categories,id',
    //         'countries_of_operation'         => 'required|array',
    //         'business_address'               => 'nullable|string',
    //         'email'                          => 'nullable|email|max:255',
    //         'whatsapp_number'                => 'nullable|string|max:20',
    //         'website'                        => 'nullable|string|max:255',

    //         // Social
    //         'facebook'                       => 'nullable|string|max:255',
    //         'instagram'                      => 'nullable|string|max:255',
    //         'linkedin'                       => 'nullable|string|max:255',
    //         'youtube'                        => 'nullable|string|max:255',
    //         'online_store'                   => 'nullable|string|max:255',

    //         // Founders
    //         'founders'                       => 'nullable|array',
    //         'founders.*.name'                => 'required_with:founders|string|max:255',
    //         'founders.*.designation'         => 'nullable|string|max:255',
    //         'founders.*.whatsapp_number'     => 'nullable|string|max:20',
    //         'founders.*.linkedin'            => 'nullable|string|max:255',

    //         // Business Size
    //         'registration_status'            => 'nullable|string',
    //         'employee_count'                 => 'nullable|string',
    //         'operational_scale'              => 'nullable|string',
    //         'annual_revenue'                 => 'nullable|string',

    //         // Description
    //         'business_overview'              => 'nullable|string',
    //         'services_id'                    => 'nullable|array',

    //         // Ethics (JSON checkbox groups - match actual DB columns)
    //         'finance_practices'              => 'nullable|array',
    //         'product_practices'              => 'nullable|array',
    //         'community_practices'            => 'nullable|array',
    //         'ethical_description'            => 'nullable|string',

    //         // Collaboration
    //         'collaboration_open'             => 'required|in:yes,no,maybe',
    //         'collaboration_types'            => 'nullable|array',

    //         // Consent
    //         'info_accuracy'                  => 'nullable|boolean',
    //         'allow_publish'                  => 'nullable|boolean',
    //         'allow_contact'                  => 'nullable|boolean',
    //         'digital_signature'              => 'nullable|string|max:255',

    //         // Admin only
    //         'is_verified'                    => 'nullable|boolean',
    //         'is_featured'                    => 'nullable|boolean',
    //         'status'                         => 'required|in:draft,pending,approved,rejected,request_for_delete',

    //         // Files
    //         'logo'                           => 'nullable|image|max:2048',
    //         'cover_photo'                    => 'nullable|image|max:5120',
    //         'registration_document'          => 'nullable|file|max:5120',
    //         'business_profile'               => 'nullable|file|max:5120',
    //         'product_catalogue'              => 'nullable|file|max:5120',
    //         'photos.*'                       => 'nullable|image|max:2048',
    //         'existing_photos'                => 'nullable|array',
    //     ]);

    //     /*
    //     |--------------------------------------------------------------------------
    //     | FILE UPLOADS
    //     |--------------------------------------------------------------------------
    //     */

    //     // Handle LOGO upload
    //     if ($request->hasFile('logo')) {
    //         if ($business->logo && file_exists(public_path('assets/' . $business->logo))) {
    //             unlink(public_path('assets/' . $business->logo));
    //         }
    //         $business->logo = $request->file('logo')
    //             ->store('uploads/business/logos', 'public_folder');
    //     }

    //     // Handle COVER PHOTO upload
    //     if ($request->hasFile('cover_photo')) {
    //         if ($business->cover_photo && file_exists(public_path('assets/' . $business->cover_photo))) {
    //             unlink(public_path('assets/' . $business->cover_photo));
    //         }
    //         $business->cover_photo = $request->file('cover_photo')
    //             ->store('uploads/business/covers', 'public_folder');
    //     }

    //     $existingPhotoIds = $request->input('existing_photos', []);

    //     if (!empty($existingPhotoIds)) {
    //         $business->businessPhotos()
    //             ->whereNotIn('id', $existingPhotoIds)
    //             ->get()
    //             ->each(function ($photo) {
    //                 $path = public_path('assets/' . $photo->image_url);
    //                 if (file_exists($path)) {
    //                     unlink($path);
    //                 }
    //                 $photo->delete();
    //             });
    //     }

    //     if ($request->hasFile('photos')) {
    //         foreach ($request->file('photos') as $photo) {
    //             $path = $photo->store('uploads/business/gallery', 'public_folder');

    //             $business->businessPhotos()->create([
    //                 'image_url' => $path,
    //             ]);
    //         }
    //     }

    //     // Handle REGISTRATION DOCUMENT upload
    //     if ($request->hasFile('registration_document')) {
    //         if ($business->registration_document && file_exists(public_path('assets/' . $business->registration_document))) {
    //             unlink(public_path('assets/' . $business->registration_document));
    //         }
    //         $business->registration_document = $request->file('registration_document')
    //             ->store('uploads/business/documents', 'public_folder');
    //     }

    //     // Handle BUSINESS PROFILE upload
    //     if ($request->hasFile('business_profile')) {
    //         if ($business->business_profile && file_exists(public_path('assets/' . $business->business_profile))) {
    //             unlink(public_path('assets/' . $business->business_profile));
    //         }
    //         $business->business_profile = $request->file('business_profile')
    //             ->store('uploads/business/profiles', 'public_folder');
    //     }

    //     // Handle PRODUCT CATALOGUE upload
    //     if ($request->hasFile('product_catalogue')) {
    //         if ($business->product_catalogue && file_exists(public_path('assets/' . $business->product_catalogue))) {
    //             unlink(public_path('assets/' . $business->product_catalogue));
    //         }
    //         $business->product_catalogue = $request->file('product_catalogue')
    //             ->store('uploads/business/catalogues', 'public_folder');
    //     }

    //     $validated['is_verified']    = $request->boolean('is_verified');
    //     $validated['is_featured']    = $request->boolean('is_featured');
    //     $validated['info_accuracy']  = $request->boolean('info_accuracy');
    //     $validated['allow_publish']  = $request->boolean('allow_publish');
    //     $validated['allow_contact']  = $request->boolean('allow_contact');

    //     // Remove keys that are not real columns so update() doesn't choke
    //     unset($validated['existing_photos']);

    //     $business->update($validated);

    //     /*
    //     |--------------------------------------------------------------------------
    //     | BUILD "WHAT CHANGED" DIFF (old value vs new value) FOR EVERY FIELD
    //     |--------------------------------------------------------------------------
    //     */
    //     $changes = $business->getChanges(); // casted, new values only, since last save
    //     $changesForEmail = [];

    //     foreach ($changes as $key => $newValue) {
    //         if (!array_key_exists($key, $this->fieldLabels)) {
    //             continue; // skip timestamps, slug, updated_by, etc.
    //         }

    //         $oldValue = $originalData[$key] ?? null;

    //         $oldFormatted = $this->formatValueForEmail($oldValue);
    //         $newFormatted = $this->formatValueForEmail($newValue);

    //         if ($oldFormatted === $newFormatted) {
    //             continue;
    //         }

    //         $changesForEmail[] = [
    //             'field' => $this->fieldLabels[$key],
    //             'old'   => $oldFormatted,
    //             'new'   => $newFormatted,
    //         ];
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | SEND EMAILS (synchronous - request waits until this finishes,
    //     | so the loading overlay on the edit page stays visible the whole time)
    //     |--------------------------------------------------------------------------
    //     */
    //     $recipientEmail = null;
    //     if ($business->customer && $business->customer->email) {
    //         $recipientEmail = $business->customer->email;
    //     } elseif ($business->email) {
    //         $recipientEmail = $business->email;
    //     }

    //     // ---- 1) STATUS EMAIL --------------------------------------------
    //     // Completely independent trigger: fires ONLY when status actually
    //     // changed in this request. Does not care about any other field.
    //     $statusChangedInThisRequest = array_key_exists('status', $changes);

    //     if ($statusChangedInThisRequest && $recipientEmail) {
    //         $mailData = [
    //             'business_name' => $business->business_name,
    //             'status'        => $business->status,
    //             'slug'          => $business->slug,
    //         ];

    //         Mail::to($recipientEmail)->send(new BusinessStatusUpdated($mailData));
    //     }

    //     // ---- 2) EDIT / CHANGE-LOG EMAIL ----------------------------------
    //     // Completely independent trigger: fires ONLY when some other
    //     // editable field changed. Does not care whether status changed.
    //     // (status itself is excluded here so it isn't reported twice.)
    //     $changesForEmail = array_values(array_filter(
    //         $changesForEmail,
    //         fn ($change) => $change['field'] !== ($this->fieldLabels['status'] ?? 'Business Status')
    //     ));

    //     if (!empty($changesForEmail) && $recipientEmail) {
    //         Mail::to($recipientEmail)->send(
    //             new BusinessAdminUpdateNotification($business, $changesForEmail)
    //         );
    //     }

    //     return redirect()
    //         ->route('gme-business-admin.index')
    //         ->with('success', 'Business updated successfully!');
    // }
    public function update(Request $request, $id)
    {
        $business = GmeBusinessForm::findOrFail($id);

        // Snapshot of ALL current (casted) attribute values BEFORE anything
        // is changed. This is what lets us build an accurate "old value"
        // vs "new value" diff for the notification e-mail below.
        $originalData = $business->toArray();

        $validated = $request->validate([
            // Business Identity
            'business_name'                 => 'required|string|max:255',
            'business_contact_person_name'  => 'nullable|string|max:255',
            'short_introduction'             => 'nullable|string',
            'year_established'               => 'nullable|string|max:255',
            'business_category_id'           => 'nullable|exists:business_categories,id',
            'countries_of_operation'         => 'required|array',
            'business_address'               => 'nullable|string',
            'email'                          => 'nullable|email|max:255',
            'whatsapp_number'                => 'nullable|string|max:20',
            'website'                        => 'nullable|string|max:255',

            // Social
            'facebook'                       => 'nullable|string|max:255',
            'instagram'                      => 'nullable|string|max:255',
            'linkedin'                       => 'nullable|string|max:255',
            'youtube'                        => 'nullable|string|max:255',
            'online_store'                   => 'nullable|string|max:255',

            // Founders
            'founders'                       => 'nullable|array',
            'founders.*.name'                => 'required_with:founders|string|max:255',
            'founders.*.designation'         => 'nullable|string|max:255',
            'founders.*.whatsapp_number'     => 'nullable|string|max:20',
            'founders.*.linkedin'            => 'nullable|string|max:255',

            // Business Size
            'registration_status'            => 'nullable|string',
            'employee_count'                 => 'nullable|string',
            'operational_scale'              => 'nullable|string',
            'annual_revenue'                 => 'nullable|string',

            // Description
            'business_overview'              => 'nullable|string',
            'services_id'                    => 'nullable|array',

            // Ethics
            'finance_practices'              => 'nullable|array',
            'product_practices'              => 'nullable|array',
            'community_practices'            => 'nullable|array',
            'ethical_description'            => 'nullable|string',

            // Collaboration
            'collaboration_open'             => 'required|in:yes,no,maybe',
            'collaboration_types'            => 'nullable|array',

            // Consent
            'info_accuracy'                  => 'nullable|boolean',
            'allow_publish'                  => 'nullable|boolean',
            'allow_contact'                  => 'nullable|boolean',
            'digital_signature'              => 'nullable|string|max:255',

            // Admin only
            'is_verified'                    => 'nullable|boolean',
            'is_featured'                    => 'nullable|boolean',
            'status'                         => 'required|in:draft,pending,approved,rejected,request_for_delete',

            // Files
            'logo'                           => 'nullable|image|max:2048',
            'cover_photo'                    => 'nullable|image|max:5120',
            'registration_document'          => 'nullable|file|max:5120',
            'business_profile'               => 'nullable|file|max:5120',
            'product_catalogue'              => 'nullable|file|max:5120',
            'photos.*'                       => 'nullable|image|max:2048',
            'existing_photos'                => 'nullable|array',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILE UPLOADS
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {
            if ($business->logo && file_exists(public_path('assets/' . $business->logo))) {
                unlink(public_path('assets/' . $business->logo));
            }
            $business->logo = $request->file('logo')
                ->store('uploads/business/logos', 'public_folder');
        }

        if ($request->hasFile('cover_photo')) {
            if ($business->cover_photo && file_exists(public_path('assets/' . $business->cover_photo))) {
                unlink(public_path('assets/' . $business->cover_photo));
            }
            $business->cover_photo = $request->file('cover_photo')
                ->store('uploads/business/covers', 'public_folder');
        }

        $existingPhotoIds = $request->input('existing_photos', []);

        if (!empty($existingPhotoIds)) {
            $business->businessPhotos()
                ->whereNotIn('id', $existingPhotoIds)
                ->get()
                ->each(function ($photo) {
                    $path = public_path('assets/' . $photo->image_url);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $photo->delete();
                });
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('uploads/business/gallery', 'public_folder');

                $business->businessPhotos()->create([
                    'image_url' => $path,
                ]);
            }
        }

        if ($request->hasFile('registration_document')) {
            if ($business->registration_document && file_exists(public_path('assets/' . $business->registration_document))) {
                unlink(public_path('assets/' . $business->registration_document));
            }
            $business->registration_document = $request->file('registration_document')
                ->store('uploads/business/documents', 'public_folder');
        }

        if ($request->hasFile('business_profile')) {
            if ($business->business_profile && file_exists(public_path('assets/' . $business->business_profile))) {
                unlink(public_path('assets/' . $business->business_profile));
            }
            $business->business_profile = $request->file('business_profile')
                ->store('uploads/business/profiles', 'public_folder');
        }

        if ($request->hasFile('product_catalogue')) {
            if ($business->product_catalogue && file_exists(public_path('assets/' . $business->product_catalogue))) {
                unlink(public_path('assets/' . $business->product_catalogue));
            }
            $business->product_catalogue = $request->file('product_catalogue')
                ->store('uploads/business/catalogues', 'public_folder');
        }

        $validated['is_verified']    = $request->boolean('is_verified');
        $validated['is_featured']    = $request->boolean('is_featured');
        $validated['info_accuracy']  = $request->boolean('info_accuracy');
        $validated['allow_publish']  = $request->boolean('allow_publish');
        $validated['allow_contact']  = $request->boolean('allow_contact');

        unset($validated['existing_photos']);

        $business->update($validated);

        /*
        |--------------------------------------------------------------------------
        | BUILD "WHAT CHANGED" DIFF (old value vs new value) FOR EVERY FIELD
        |--------------------------------------------------------------------------
        | IMPORTANT: we do NOT use $business->getChanges() here, because that
        | returns RAW/uncast attribute values (e.g. JSON-encoded strings for
        | array-cast fields, or "0"/"1" for booleans). Comparing two toArray()
        | snapshots (before vs after) ensures both sides go through the same
        | casts, so booleans/arrays/JSON fields are formatted consistently on
        | both "old" and "new" sides of the e-mail.
        */
        $freshBusiness = $business->fresh();
        $newData = $freshBusiness->toArray();

        $imageFields = [
            'logo'                  => 'Logo',
            'cover_photo'           => 'Cover Photo',
            'registration_document' => 'Registration Document',
            'business_profile'      => 'Business Profile',
            'product_catalogue'     => 'Product Catalogue',
        ];

        $booleanFields = ['is_verified', 'is_featured', 'info_accuracy', 'allow_publish', 'allow_contact'];

        $changesForEmail = [];
        $imageChangesForEmail = [];

        foreach ($this->fieldLabels as $key => $label) {
            if ($key === 'status') {
                continue; // status has its own dedicated e-mail
            }

            if (!array_key_exists($key, $originalData) || !array_key_exists($key, $newData)) {
                continue;
            }

            $oldRaw = $originalData[$key];
            $newRaw = $newData[$key];

            if ($this->normalizeForCompare($oldRaw) === $this->normalizeForCompare($newRaw)) {
                continue; // nothing actually changed
            }

            // Image / file fields -> show as thumbnails, not text
            if (array_key_exists($key, $imageFields)) {
                $imageChangesForEmail[] = [
                    'field'   => $label,
                    'old_url' => $oldRaw ? asset('assets/' . $oldRaw) : null,
                    'new_url' => $newRaw ? asset('assets/' . $newRaw) : null,
                ];
                continue;
            }

            $changesForEmail[] = [
                'field' => $label,
                'old'   => $this->formatValueForEmail($oldRaw, $key, $booleanFields),
                'new'   => $this->formatValueForEmail($newRaw, $key, $booleanFields),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | SEND EMAILS (synchronous - request waits until this finishes,
        | so the loading overlay on the edit page stays visible the whole time)
        |--------------------------------------------------------------------------
        */
        $recipientEmail = null;
        if ($business->customer && $business->customer->email) {
            $recipientEmail = $business->customer->email;
        } elseif ($business->email) {
            $recipientEmail = $business->email;
        }

        // ---- 1) STATUS EMAIL --------------------------------------------
        // Completely independent trigger: fires ONLY when status actually
        // changed in this request. Does not care about any other field.
        $statusChangedInThisRequest = $originalData['status'] !== $newData['status'];

        if ($statusChangedInThisRequest && $recipientEmail) {
            $mailData = [
                'business_name' => $business->business_name,
                'status'        => $business->status,
                'slug'          => $business->slug,
            ];

            Mail::to($recipientEmail)->send(new BusinessStatusUpdated($mailData));
        }

        // ---- 2) EDIT / CHANGE-LOG EMAIL ----------------------------------
        // Completely independent trigger: fires ONLY when some other
        // editable field (text or image) changed. Does not care whether
        // status changed.
        if ((!empty($changesForEmail) || !empty($imageChangesForEmail)) && $recipientEmail) {
            Mail::to($recipientEmail)->send(
                new BusinessAdminUpdateNotification($business, $changesForEmail, $imageChangesForEmail)
            );
        }

        return redirect()
            ->route('gme-business-admin.index')
            ->with('success', 'Business updated successfully!');
    }

    /**
     * Turn any casted DB value into a readable string for the change-log e-mail.
     */
    private function formatValueForEmail($value, string $key, array $booleanFields): string
    {
        if (in_array($key, $booleanFields, true)) {
            return $this->toBool($value) ? 'Yes' : 'No';
        }

        if (is_null($value) || $value === '') {
            return '-';
        }

        if (is_bool($value)) {
            return $value ? 'Yes' : 'No';
        }

        if (is_array($value)) {
            if (empty($value)) {
                return '-';
            }

            // Founders is an array of associative arrays: [{name, designation, ...}, ...]
            if (isset($value[0]) && is_array($value[0])) {
                return collect($value)
                    ->map(function ($item) {
                        $name = $item['name'] ?? 'Unnamed';
                        $designation = $item['designation'] ?? null;
                        return $designation ? "{$name} ({$designation})" : $name;
                    })
                    ->implode(', ');
            }

            // Plain list of strings (countries, services, practices, etc.)
            return implode(', ', array_map(fn ($v) => (string) $v, $value));
        }

        // Defensive: if somehow still a raw JSON string, decode and retry
        if (is_string($value) && preg_match('/^[\[{]/', trim($value))) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $this->formatValueForEmail($decoded, $key, $booleanFields);
            }
        }

        return (string) $value;
    }

    private function toBool($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        return in_array($value, [1, '1', 'true', 'yes', 'Yes', 'on'], true);
    }

    /**
     * Normalize any value into a comparable scalar string, used purely to
     * detect whether old vs new actually differ (arrays/bools compared safely).
     */
    private function normalizeForCompare($value): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        return (string) $value;
    }
    /**
     * Turn any DB value (array/bool/scalar/null) into a readable string
     * for the change-log e-mail.
     */

    public function show($id)
    {
        $business = GmeBusinessForm::with('businessPhotos')->findOrFail($id);
        $countries = $this->getCountries();
        $categories = BusinessCategory::orderBy('name')->get();

        return view('gme-business-admin.show', compact('business', 'countries', 'categories'));
    }

    public function destroy($id)
    {
        $business = GmeBusinessForm::findOrFail($id);

        if ($business->logo && file_exists(public_path('assets/'.$business->logo))) {
            unlink(public_path('assets/'.$business->logo));
        }

        if ($business->photos) {
            foreach ($business->photos as $photo) {
                if (file_exists(public_path('assets/'.$photo))) {
                    unlink(public_path('assets/'.$photo));
                }
            }
        }

        if ($business->registration_document && file_exists(public_path('assets/'.$business->registration_document))) {
            unlink(public_path('assets/'.$business->registration_document));
        }

        $business->delete();

        return response()->json([
            'success' => true,
            'message' => 'Business deleted successfully!'
        ]);
    }

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

    public function print($id)
    {
        $business = GmeBusinessForm::with('businessPhotos')->findOrFail($id);

        $html = view('gme-business-admin.print', compact('business'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('business-profile.pdf', 'I');
    }

    //////////CONTACT REQUESTS//////////
    public function contactRequestsIndex()
    {
        $requests = ContactRequest::with('business')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contact-requests.index', compact('requests'));
    }

    public function contactRequestsShow($id)
    {
        $request = ContactRequest::with('business')->findOrFail($id);

        return view('admin.contact-requests.show', compact('request'));
    }

    public function contactRequestsApprove($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->status = 'approved';
        $contactRequest->save();

        Mail::to($contactRequest->requester_email)->send(new ContactRequestApproved($contactRequest));
        Mail::to($contactRequest->business->email)->send(new ContactRequestApprovedOwner($contactRequest));

        return redirect()->back()->with('success', 'Contact request approved successfully!');
    }

    public function contactRequestsReject($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->status = 'rejected';
        $contactRequest->save();
        Mail::to($contactRequest->requester_email)->send(new ContactRequestRejected($contactRequest));
        return redirect()->back()->with('success', 'Contact request rejected.');
    }
}