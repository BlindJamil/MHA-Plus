@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input id="email" name="email" type="email" required 
                            class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:ring-teal-500 focus:border-teal-500">
                        
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input id="password" name="password" type="password" required 
                            class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:ring-teal-500 focus:border-teal-500">
                        
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="rounded bg-gray-700 border-gray-600 text-teal-600 focus:ring-teal-500">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">Remember me</label>
                    </div>
                    
                    <div>
                        <button type="submit" 
                            class="w-full py-2 px-4 btn-gradient text-white rounded-md hover:opacity-90 transition">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection