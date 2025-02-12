@extends('layouts.layout')


@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">User Profile</h1>
    @if(session('success'))
        <div class="alert alert-success bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow-lg rounded-lg p-8 mb-6">
        <div class="mb-6 flex items-center justify-center">
            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" class="rounded-full w-32 h-32 border-4 border-blue-500">
            <a href="{{ route('profile.edit') }}" class="ml-4 text-gray-600 hover:text-blue-500">
                <i class="fas fa-pencil-alt text-xl"></i>
            </a>
        </div>
        <div class="text-center">
            <p class="text-gray-800 text-lg font-semibold mb-2">Name: <span class="text-gray-600">{{ $user->name }}</span></p>
            <p class="text-gray-800 text-lg font-semibold mb-2">Email: <span class="text-gray-600">{{ $user->email }}</span></p>
            <p class="text-gray-800 text-lg font-semibold mb-2">Created At: <span class="text-gray-600">{{ $user->created_at }}</span></p>
            <p class="text-gray-800 text-lg font-semibold mb-2">Updated At: <span class="text-gray-600">{{ $user->updated_at }}</span></p>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Update Profile</a>
        </div>
    </div>
</div>
@endsection
