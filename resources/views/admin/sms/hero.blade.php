@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">SMS &raquo; Hero Section</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sms.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="hero_title" class="form-control"
                           value="{{ old('hero_title', $settings['hero_title']) }}" required>
                    @error('hero_title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Subtitle</label>
                    <textarea name="hero_subtitle" class="form-control" rows="2">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Background Image</label>
                        @if ($settings['hero_bg_image'])
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings['hero_bg_image']) }}" style="max-height:100px" class="rounded">
                            </div>
                        @endif
                        <input type="file" name="hero_bg_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Animation / Pattern Image</label>
                        @if ($settings['hero_animation_image'])
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings['hero_animation_image']) }}" style="max-height:100px" class="rounded">
                            </div>
                        @endif
                        <input type="file" name="hero_animation_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Button Text</label>
                        <input type="text" name="hero_button_text" class="form-control"
                               value="{{ old('hero_button_text', $settings['hero_button_text']) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Button Link</label>
                        <input type="text" name="hero_button_link" class="form-control"
                               value="{{ old('hero_button_link', $settings['hero_button_link']) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Search Box Placeholder</label>
                        <input type="text" name="hero_search_placeholder" class="form-control"
                               value="{{ old('hero_search_placeholder', $settings['hero_search_placeholder']) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Search Button Text</label>
                        <input type="text" name="hero_search_button_text" class="form-control"
                               value="{{ old('hero_search_button_text', $settings['hero_search_button_text']) }}">
                    </div>
                </div>

                <button type="submit" class="btn text-white" style="background-color:#9C7D2D;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
