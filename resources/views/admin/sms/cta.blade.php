@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">SMS &raquo; "Bring Your Business to the Global Stage" Section</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sms.cta.update') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Title — light part</label>
                        <input type="text" name="cta_title_light" class="form-control"
                               value="{{ old('cta_title_light', $settings['cta_title_light']) }}" required>
                        <small class="text-muted">e.g. "Bring Your Business to the"</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Title — bold part</label>
                        <input type="text" name="cta_title_bold" class="form-control"
                               value="{{ old('cta_title_bold', $settings['cta_title_bold']) }}" required>
                        <small class="text-muted">e.g. "Global Stage" (rendered bold)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Subtitle</label>
                    <textarea name="cta_subtitle" class="form-control" rows="2">{{ old('cta_subtitle', $settings['cta_subtitle']) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Button Text</label>
                        <input type="text" name="cta_button_text" class="form-control"
                               value="{{ old('cta_button_text', $settings['cta_button_text']) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Button Link</label>
                        <input type="text" name="cta_button_link" class="form-control"
                               value="{{ old('cta_button_link', $settings['cta_button_link']) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn text-white" style="background-color:#9C7D2D;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
