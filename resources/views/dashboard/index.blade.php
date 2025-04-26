@extends('layouts.main') @section('title', 'Point Of Sale')
@section('content')
<div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-primary-blue/100 to-primary-blue/90 p-6 shadow-md mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-1">Selamat Datang, Admin! 🎉</h2>
            <p class="text-sm opacity-90">Welcome To Pos Application</p>
        </div>
        <div class="hidden sm:block">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Icon" class="w-16 h-16 opacity-90">
        </div>
    </div>
</div>
@endsection