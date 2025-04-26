@extends('layouts.main') @section('title', 'Point Of Sale')
@section('content')
<div class="flex-1 overflow-auto p-4">
    <div class="mb-6 flex justify-between items-center animate-fadeIn">
        <h1 class="text-2xl font-bold">Statistic Overview</h1>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.1s;">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary-blue/10 text-primary-blue">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Product</p>
                    <p class="text-2xl font-semibold">1,254 <span class="text-sm text-green-500">↑ 12%</span></p>
                </div>
            </div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-2 bg-primary-blue rounded-full" style="width: 72%"></div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.1s;">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary-blue/10 text-primary-blue">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                    <p class="text-2xl font-semibold">1,254 <span class="text-sm text-green-500">↑ 12%</span></p>
                </div>
            </div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-2 bg-primary-blue rounded-full" style="width: 72%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.2s;">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary-green/10 text-primary-green">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Sales</p>
                    <p class="text-2xl font-semibold">$12,345 <span class="text-sm text-green-500">↑ 5.2%</span></p>
                </div>
            </div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-2 bg-primary-green rounded-full" style="width: 58%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 card-hover animate-fadeIn" style="animation-delay: 0.4s;">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Issues</p>
                    <p class="text-2xl font-semibold">12 <span class="text-sm text-green-500">↓ 3</span></p>
                </div>
            </div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-2 bg-red-500 rounded-full" style="width: 24%"></div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Line Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 animate-fadeIn" style="animation-delay: 0.5s;">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Sales Overview</h2>
                <div class="flex space-x-2">
                    <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Day</button>
                    <button class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">Week</button>
                    <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Month</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
        
        <!-- Pie Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 animate-fadeIn" style="animation-delay: 0.6s;">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Product Categories</h2>
                <button class="px-2 py-1 text-xs border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-download mr-1"></i> Export
                </button>
            </div>
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order code</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>

                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @php $no=1; @endphp
                @foreach ($datas as $data)
                    <tr class="table-row">
                        @php
                            $color = "bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200";
                            // $status = "Active";

                            if (!$data->order_status) {
                                $color = "bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200";
                                // $status = "Deactive";
                            }
                        @endphp
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{$no++}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->order_code}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->order_date}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $data->order_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">{{ $data->order_status ? 'Paid' : 'Unpaid' }}</span>
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button class="text-primary-blue hover:text-primary-blue/80 mr-3 transition-colors"><i class="fas fa-trash"></i></button>
                            <button class="text-primary-green hover:text-primary-green/80 transition-colors"><i class="fas fa-edit"></i></button>
                        </td> --}}
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