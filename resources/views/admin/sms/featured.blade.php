@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">SMS &raquo; Featured Businesses Section</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sms.featured.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="featured_title" class="form-control"
                           value="{{ old('featured_title', $settings['featured_title']) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Subtitle</label>
                    <textarea name="featured_subtitle" class="form-control" rows="2">{{ old('featured_subtitle', $settings['featured_subtitle']) }}</textarea>
                </div>

                <button type="submit" class="btn text-white" style="background-color:#9C7D2D;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
