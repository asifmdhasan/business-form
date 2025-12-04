@extends('layouts.master')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">GME Business Directory</h2>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Business Name</th>
                <th class="p-2 border">Founder</th>
                <th class="p-2 border">Country</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($businesses as $b)
            <tr>
                <td class="p-2 border">{{ $b->business_name }}</td>
                <td class="p-2 border">{{ $b->founder_name }}</td>
                <td class="p-2 border">{{ $b->country }}</td>
                <td class="p-2 border">
                    <span class="px-2 py-1 rounded bg-yellow-200">{{ ucfirst($b->status) }}</span>
                </td>
                <td class="p-2 border">{{ $b->created_at->format('d M, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $businesses->links() }}
    </div>
</div>
@endsection
