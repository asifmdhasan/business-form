{{-- resources/views/gme/business/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Business Registration</h1>
        
        {{-- Progress Steps --}}
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto rounded-full {{ $step >= 1 ? 'bg-blue-600' : 'bg-gray-300' }} text-white flex items-center justify-center font-bold">1</div>
                    <p class="text-xs mt-2">Business & Founder</p>
                </div>
                <div class="flex-1 border-t-2 {{ $step >= 2 ? 'border-blue-600' : 'border-gray-300' }}"></div>
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto rounded-full {{ $step >= 2 ? 'bg-blue-600' : 'bg-gray-300' }} text-white flex items-center justify-center font-bold">2</div>
                    <p class="text-xs mt-2">Size & Structure</p>
                </div>
                <div class="flex-1 border-t-2 {{ $step >= 3 ? 'border-blue-600' : 'border-gray-300' }}"></div>
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto rounded-full {{ $step >= 3 ? 'bg-blue-600' : 'bg-gray-300' }} text-white flex items-center justify-center font-bold">3</div>
                    <p class="text-xs mt-2">Ethics & Collaboration</p>
                </div>
                <div class="flex-1 border-t-2 {{ $step >= 4 ? 'border-blue-600' : 'border-gray-300' }}"></div>
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto rounded-full {{ $step >= 4 ? 'bg-blue-600' : 'bg-gray-300' }} text-white flex items-center justify-center font-bold">4</div>
                    <p class="text-xs mt-2">Consent</p>
                </div>
            </div>
        </div>

        <form action="{{ route('gme.business.save-step') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="step" value="{{ $step }}">
            <input type="hidden" name="business_id" value="{{ $business->id ?? '' }}">

            {{-- STEP 1: Business & Founder Identity --}}
            @if($step == 1)
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Business & Founder Identity</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name *</label>
                    <input type="text" name="business_name" value="{{ old('business_name', $business->business_name ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('business_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Short Introduction</label>
                    <textarea name="short_introduction" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('short_introduction', $business->short_introduction ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year Established</label>
                        <input type="text" name="year_established" value="{{ old('year_established', $business->year_established ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Business Category *</label>
                        <select name="business_category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('business_category_id', $business->business_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country of Operation (Multi-select) *</label>
                    <select name="countries_of_operation[]" multiple required class="w-full px-4 py-2 border border-gray-300 rounded-lg" style="height: 120px;">
                        @foreach($countries as $country)
                            <option value="{{ $country }}" {{ in_array($country, old('countries_of_operation', json_decode($business->countries_of_operation ?? '[]', true))) ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple countries</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Address</label>
                    <textarea name="business_address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('business_address', $business->business_address ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email', $business->email ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number *</label>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $business->whatsapp_number ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                    <input type="url" name="website" value="{{ old('website', $business->website ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Social Links (Optional)</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                            <input type="url" name="facebook" value="{{ old('facebook', $business->facebook ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                            <input type="url" name="instagram" value="{{ old('instagram', $business->instagram ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                            <input type="url" name="linkedin" value="{{ old('linkedin', $business->linkedin ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                            <input type="url" name="youtube" value="{{ old('youtube', $business->youtube ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Online Store</label>
                            <input type="url" name="online_store" value="{{ old('online_store', $business->online_store ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Founder Information *</h3>
                    <div id="founders-container">
                        @php
                            $founders = old('founders', json_decode($business->founders ?? '[]', true)) ?: [['name' => '', 'designation' => '', 'whatsapp' => '', 'linkedin' => '']];
                        @endphp
                        @foreach($founders as $index => $founder)
                        <div class="founder-item bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-semibold text-gray-700">Founder {{ $index + 1 }}</h4>
                                @if($index > 0)
                                <button type="button" onclick="removeFounder(this)" class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                                @endif
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="founders[{{ $index }}][name]" value="{{ $founder['name'] ?? '' }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Designation *</label>
                                    <input type="text" name="founders[{{ $index }}][designation]" value="{{ $founder['designation'] ?? '' }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                                    <input type="text" name="founders[{{ $index }}][whatsapp]" value="{{ $founder['whatsapp'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                                    <input type="url" name="founders[{{ $index }}][linkedin]" value="{{ $founder['linkedin'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addFounder()" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">+ Add More Founder</button>
                </div>
            </div>
            @endif

            {{-- STEP 2: Business Size & Structure --}}
            @if($step == 2)
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Business Size & Structure</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Registration Status</label>
                    <select name="registration_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Status</option>
                        <option value="registered_company" {{ old('registration_status', $business->registration_status ?? '') == 'registered_company' ? 'selected' : '' }}>Registered Company</option>
                        <option value="sole_proprietorship" {{ old('registration_status', $business->registration_status ?? '') == 'sole_proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                        <option value="partnership" {{ old('registration_status', $business->registration_status ?? '') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="startup_early_stage" {{ old('registration_status', $business->registration_status ?? '') == 'startup_early_stage' ? 'selected' : '' }}>Startup (Early Stage)</option>
                        <option value="home_based" {{ old('registration_status', $business->registration_status ?? '') == 'home_based' ? 'selected' : '' }}>Home-Based</option>
                        <option value="not_registered_yet" {{ old('registration_status', $business->registration_status ?? '') == 'not_registered_yet' ? 'selected' : '' }}>Not Registered Yet</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Employees</label>
                        <select name="employee_count" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Range</option>
                            <option value="1-3" {{ old('employee_count', $business->employee_count ?? '') == '1-3' ? 'selected' : '' }}>1–3</option>
                            <option value="4-10" {{ old('employee_count', $business->employee_count ?? '') == '4-10' ? 'selected' : '' }}>4–10</option>
                            <option value="11-25" {{ old('employee_count', $business->employee_count ?? '') == '11-25' ? 'selected' : '' }}>11–25</option>
                            <option value="26-50" {{ old('employee_count', $business->employee_count ?? '') == '26-50' ? 'selected' : '' }}>26–50</option>
                            <option value="51+" {{ old('employee_count', $business->employee_count ?? '') == '51+' ? 'selected' : '' }}>51+</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Operational Scale</label>
                        <select name="operational_scale" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Scale</option>
                            <option value="local" {{ old('operational_scale', $business->operational_scale ?? '') == 'local' ? 'selected' : '' }}>Local</option>
                            <option value="nationwide" {{ old('operational_scale', $business->operational_scale ?? '') == 'nationwide' ? 'selected' : '' }}>Nationwide</option>
                            <option value="international" {{ old('operational_scale', $business->operational_scale ?? '') == 'international' ? 'selected' : '' }}>International</option>
                            <option value="online_only" {{ old('operational_scale', $business->operational_scale ?? '') == 'online_only' ? 'selected' : '' }}>Online Only</option>
                            <option value="hybrid" {{ old('operational_scale', $business->operational_scale ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Annual Revenue Range (Optional)</label>
                    <select name="annual_revenue" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Range</option>
                        <option value="under_10k" {{ old('annual_revenue', $business->annual_revenue ?? '') == 'under_10k' ? 'selected' : '' }}>Under $10K</option>
                        <option value="10k-50k" {{ old('annual_revenue', $business->annual_revenue ?? '') == '10k-50k' ? 'selected' : '' }}>$10K–$50K</option>
                        <option value="50k-200k" {{ old('annual_revenue', $business->annual_revenue ?? '') == '50k-200k' ? 'selected' : '' }}>$50K–$200K</option>
                        <option value="200k-1m" {{ old('annual_revenue', $business->annual_revenue ?? '') == '200k-1m' ? 'selected' : '' }}>$200K–$1M</option>
                        <option value="above_1m" {{ old('annual_revenue', $business->annual_revenue ?? '') == 'above_1m' ? 'selected' : '' }}>Above $1M</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Detailed Business Overview (max 300 words)</label>
                    <textarea name="business_overview" rows="5" maxlength="1800" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('business_overview', $business->business_overview ?? '') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Explain what you do, who you serve, and what makes your business unique.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">List of Products / Services (up to 10)</label>
                    <select name="services_id[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg" style="height: 150px;">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ in_array($service->id, old('services_id', json_decode($business->services_id ?? '[]', true))) ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple services (max 10)</p>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">File Uploads</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Registration / License Documents (Optional)</label>
                            <input type="file" name="registration_document" accept=".pdf,.doc,.docx" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->registration_document))
                                <p class="text-sm text-green-600 mt-1">Current file: {{ basename($business->registration_document) }}</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Business Logo (PNG preferred)</label>
                            <input type="file" name="logo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->logo))
                                <img src="{{ asset('storage/' . $business->logo) }}" alt="Logo" class="mt-2 h-20">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Cover Photo (Optional)</label>
                            <input type="file" name="cover_photo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->cover_photo))
                                <img src="{{ asset('storage/' . $business->cover_photo) }}" alt="Cover" class="mt-2 h-32">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload 3–6 Photos (products, service, office, team)</label>
                            <input type="file" name="photos[]" accept="image/*" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->photos))
                                <div class="mt-2 flex gap-2">
                                    @foreach(json_decode($business->photos, true) as $photo)
                                        <img src="{{ asset('storage/' . $photo) }}" alt="Photo" class="h-20">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Business Profile (Optional)</label>
                            <input type="file" name="business_profile" accept=".pdf,.doc,.docx" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->business_profile))
                                <p class="text-sm text-green-600 mt-1">Current file: {{ basename($business->business_profile) }}</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Product Catalogue (Optional)</label>
                            <input type="file" name="product_catalogue" accept=".pdf,.doc,.docx" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @if(isset($business->product_catalogue))
                                <p class="text-sm text-green-600 mt-1">Current file: {{ basename($business->product_catalogue) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- STEP 3: Islamic Ethical Alignment, Collaboration & Community --}}
            @if($step == 3)
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Islamic Ethical Alignment, Collaboration & Community</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Do you avoid interest-based (riba) financing? *</label>
                    <select name="avoid_riba" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Option</option>
                        <option value="yes" {{ old('avoid_riba', $business->avoid_riba ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="partially_transitioning" {{ old('avoid_riba', $business->avoid_riba ?? '') == 'partially_transitioning' ? 'selected' : '' }}>Partially (transitioning)</option>
                        <option value="no" {{ old('avoid_riba', $business->avoid_riba ?? '') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="prefer_not_to_say" {{ old('avoid_riba', $business->avoid_riba ?? '') == 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Does your business avoid prohibited products or services? *</label>
                    <select name="avoid_haram_products" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Option</option>
                        <option value="yes" {{ old('avoid_haram_products', $business->avoid_haram_products ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="partially_compliant" {{ old('avoid_haram_products', $business->avoid_haram_products ?? '') == 'partially_compliant' ? 'selected' : '' }}>Partially compliant</option>
                        <option value="no" {{ old('avoid_haram_products', $business->avoid_haram_products ?? '') == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">e.g., alcohol, gambling, adult content</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Do you practice fair pricing, honest marketing & ethical sourcing? *</label>
                    <select name="fair_pricing" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Option</option>
                        <option value="yes" {{ old('fair_pricing', $business->fair_pricing ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="mostly" {{ old('fair_pricing', $business->fair_pricing ?? '') == 'mostly' ? 'selected' : '' }}>Mostly</option>
                        <option value="needs_improvement" {{ old('fair_pricing', $business->fair_pricing ?? '') == 'needs_improvement' ? 'selected' : '' }}>Needs improvement</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Please describe how your business follows Islamic ethical values. (100–200 words)</label>
                    <textarea name="ethical_description" rows="5" minlength="100" maxlength="1200" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('ethical_description', $business->ethical_description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Are you open to receiving guidance from GME to strengthen ethical practices if needed? *</label>
                    <select name="open_for_guidance" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Select Option</option>
                        <option value="yes" {{ old('open_for_guidance', $business->open_for_guidance ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ old('open_for_guidance', $business->open_for_guidance ?? '') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="maybe" {{ old('open_for_guidance', $business->open_for_guidance ?? '') == 'maybe' ? 'selected' : '' }}>Maybe</option>
                    </select>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Collaboration & Community</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Are you open for collaborations within the GME Network? *</label>
                        <select name="collaboration_open" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Option</option>
                            <option value="yes" {{ old('collaboration_open', $business->collaboration_open ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('collaboration_open', $business->collaboration_open ?? '') == 'no' ? 'selected' : '' }}>No</option>
                            <option value="maybe" {{ old('collaboration_open', $business->collaboration_open ?? '') == 'maybe' ? 'selected' : '' }}>Maybe</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Types of collaboration you are interested in:</label>
                        @php
                            $collabTypes = old('collaboration_types', json_decode($business->collaboration_types ?? '[]', true));
                        @endphp
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="partnerships" {{ in_array('partnerships', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Partnerships</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="investment_opportunities" {{ in_array('investment_opportunities', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Investment Opportunities</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="vendor_supply_chain" {{ in_array('vendor_supply_chain', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Vendor/Supply Chain</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="marketing_promotion" {{ in_array('marketing_promotion', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Marketing/Promotion</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="networking" {{ in_array('networking', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Networking</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="training_workshops" {{ in_array('training_workshops', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Training/Workshops</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="community_charity_projects" {{ in_array('community_charity_projects', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Community/Charity Projects</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="collaboration_types[]" value="not_sure_yet" {{ in_array('not_sure_yet', $collabTypes) ? 'checked' : '' }} class="mr-2">
                                <span>Not Sure Yet</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- STEP 4: Consent & Approval --}}
            @if($step == 4)
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Consent & Approval</h2>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 space-y-4">
                    <div class="flex items-start">
                        <input type="checkbox" name="info_accuracy" value="1" {{ old('info_accuracy', $business->info_accuracy ?? false) ? 'checked' : '' }} required class="mt-1 mr-3 h-5 w-5">
                        <label class="text-gray-700">
                            <strong>I confirm that all information provided is accurate.</strong> *
                        </label>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" name="allow_publish" value="1" {{ old('allow_publish', $business->allow_publish ?? false) ? 'checked' : '' }} class="mt-1 mr-3 h-5 w-5">
                        <label class="text-gray-700">
                            <strong>I authorize GME to publish my business profile on the GME website.</strong>
                        </label>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" name="allow_contact" value="1" {{ old('allow_contact', $business->allow_contact ?? false) ? 'checked' : '' }} required class="mt-1 mr-3 h-5 w-5">
                        <label class="text-gray-700">
                            <strong>I agree that GME may contact me for further verification if required.</strong> *
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Digital Signature (Full Name + Date) *</label>
                    <input type="text" name="digital_signature" value="{{ old('digital_signature', $business->digital_signature ?? '') }}" required placeholder="e.g., John Doe - 2025-01-15" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Please enter your full name and today's date</p>
                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-6">
                    <p class="text-green-800 font-semibold">✓ Review your information before submitting</p>
                    <p class="text-sm text-green-700 mt-1">Your application will be reviewed by our team. You will be notified once approved.</p>
                </div>
            </div>
            @endif

            {{-- Navigation Buttons --}}
            <div class="flex justify-between mt-8 pt-6 border-t">
                @if($step > 1)
                    <a href="{{ route('gme.business.register', ['step' => $step - 1, 'business_id' => $business->id ?? '']) }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        ← Previous
                    </a>
                @else
                    <div></div>
                @endif

                @if($step < 4)
                    <button type="submit" name="action" value="next" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Save & Next →
                    </button>
                @else
                    <button type="submit" name="action" value="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Submit Application
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
let founderIndex = {{ count($founders ?? [1]) }};

function addFounder() {
    const container = document.getElementById('founders-container');
    const founderDiv = document.createElement('div');
    founderDiv.className = 'founder-item bg-gray-50 p-4 rounded-lg mb-4';
    founderDiv.innerHTML = `
        <div class="flex justify-between items-center mb-3">
            <h4 class="font-semibold text-gray-700">Founder ${founderIndex + 1}</h4>
            <button type="button" onclick="removeFounder(this)" class="text-red-600 hover:text-red-800 text-sm">Remove</button>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" name="founders[${founderIndex}][name]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Designation *</label>
                <input type="text" name="founders[${founderIndex}][designation]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                <input type="text" name="founders[${founderIndex}][whatsapp]" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                <input type="url" name="founders[${founderIndex}][linkedin]" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>
    `;
    container.appendChild(founderDiv);
    founderIndex++;
}

function removeFounder(button) {
    button.closest('.founder-item').remove();
}
</script>
@endsection