@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">SMS &raquo; Filter Businesses Section</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sms.filter.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Header Title</label>
                    <input type="text" name="filter_title" class="form-control"
                           value="{{ old('filter_title', $settings['filter_title']) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">"Apply Filters" Button Text</label>
                        <input type="text" name="filter_apply_button_text" class="form-control"
                               value="{{ old('filter_apply_button_text', $settings['filter_apply_button_text']) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">"Reset" Button Text</label>
                        <input type="text" name="filter_reset_button_text" class="form-control"
                               value="{{ old('filter_reset_button_text', $settings['filter_reset_button_text']) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn text-white" style="background-color:#9C7D2D;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
