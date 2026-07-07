@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">SMS &raquo; Footer</h4>

    <p class="text-muted">Note: footer menu links (Explore / Legal / Connect Us) stay hardcoded. Only the logo and tagline are editable here.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sms.footer.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Footer Logo</label>
                    @if ($settings['footer_logo'])
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['footer_logo']) }}" style="max-height:80px">
                        </div>
                    @endif
                    <input type="file" name="footer_logo" class="form-control" accept="image/*">
                    <small class="text-muted">Leave empty to keep current logo.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tagline</label>
                    <input type="text" name="footer_tagline" class="form-control"
                           value="{{ old('footer_tagline', $settings['footer_tagline']) }}">
                </div>

                <button type="submit" class="btn text-white" style="background-color:#9C7D2D;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
