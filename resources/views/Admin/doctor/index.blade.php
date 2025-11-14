@extends('layouts.admin')

@section('content')

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <!-- Your content here -->
        <h3 class="text-xl font-semibold mb-4">👨‍⚕️ Doctor Information</h3>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Rest of your content -->
    </div>
</div>

@endsection