@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

@include('user.modal')
@include('user.action')

<div class="mb-6 flex justify-between items-center animate-fadeIn">
    <h1 class="text-2xl font-bold">User Overview</h1>
    @if ($privilage[0]['create'])
    <button id="open-modal" class="px-4 py-2 bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-all duration-200 transform hover:scale-105 shadow-md eg-modal-toogle" data-id="createUserModal">
        <i class="fas fa-plus mr-2"></i> Add Users
    </button>
    @endif
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mb-6 animate-fadeIn" style="animation-delay: 0.5s;">
    {{-- @if ($privilage[0]['create']) --}}
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-semibold">Add Users</h2>
        {{-- <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-download mr-1"></i> Export
            </button>
            <button class="px-3 py-1 text-sm bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </div> --}}
    </div>
    {{-- @endif --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    @if ($privilage[0]['update'] || $privilage[0]['delete'])
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @php $no=1; @endphp
                @foreach ($datas as $data)
                    <tr class="table-row">
                        @php
                            $color = "bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200";
                            // $status = "Active";

                            if (!$data->is_active) {
                                $color = "bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200";
                                // $status = "Deactive";
                            }
                        @endphp
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{$no++}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->roles[0]->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">{{ $data->is_active ? 'publish' : 'Draft' }}</span>
                        </td>
                        @if ($privilage[0]['update'] || $privilage[0]['delete'])
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if ($privilage[0]['delete'])
                            <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-trash eg-modal-toogle" data-id="deleteUserModal{{$data->id}}"></i></button>
                            @endif
                            @if ($privilage[0]['update'])
                            <button id="open-modal" class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit eg-modal-toogle" data-id="createUserModal{{$data->id}}"></i></button>
                            @endif
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 transition-colors" disabled>Previous</button>
            <button class="px-3 py-1 text-sm bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-colors">1</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">2</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">3</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Next</button>
        </div>
    </div>
</div>
@endsection