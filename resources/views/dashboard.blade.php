@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-semibold mb-4">Milk Collection System Dashboard</h3>
                <p class="mb-6">Welcome to your milk collection management system. Choose an action below:</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('farmers.index') }}" class="block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200">
                        <h4 class="font-semibold text-blue-800">Manage Farmers</h4>
                        <p class="text-blue-600 text-sm">Add, edit, and view farmer information</p>
                    </a>

                    <a href="{{ route('collections.index') }}" class="block p-4 bg-green-50 hover:bg-green-100 rounded-lg border border-green-200">
                        <h4 class="font-semibold text-green-800">Milk Collections</h4>
                        <p class="text-green-600 text-sm">Record and manage milk deliveries</p>
                    </a>

                    <a href="{{ route('advances.index') }}" class="block p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg border border-yellow-200">
                        <h4 class="font-semibold text-yellow-800">Advances</h4>
                        <p class="text-yellow-600 text-sm">Manage farmer advances</p>
                    </a>

                    <a href="{{ route('reports.monthly') }}" class="block p-4 bg-purple-50 hover:bg-purple-100 rounded-lg border border-purple-200">
                        <h4 class="font-semibold text-purple-800">Monthly Reports</h4>
                        <p class="text-purple-600 text-sm">Generate and export reports</p>
                    </a>

                    <a href="{{ route('farmers.index') }}" class="block p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg border border-indigo-200">
                        <h4 class="font-semibold text-indigo-800">Farmer Statements</h4>
                        <p class="text-indigo-600 text-sm">View individual farmer statements</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
