@extends('layouts.frontend-master')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">{{ __('layouts.customer_dashboard') }}</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">



        <div class="bg-white shadow rounded-xl p-4 flex items-center">
            <!-- Left side: icon -->
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg shadow-lg mr-4">
                <i class="fa-solid fa-user text-white"></i>
            </div>
            <!-- Right side: title on top, count below -->
            <div class="flex flex-col justify-center">
                <span class="text-gray-500 font-medium">{{ __('layouts.customers') }}</span>
                {{-- <p class="text-2xl font-bold">{{ $totalUsers }}</p> --}}
            </div>
        </div>
        <div>


    </div>


</div>
@endsection

