@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 text-gray-300">
                 <div class="flex justify-between items-start mb-6">
                    <h1 class="text-2xl font-semibold text-white break-words">Subject: {{ $message->subject }}</h1>
                     <a href="{{ route('admin.messages.index') }}" class="ml-4 flex-shrink-0 px-3 py-1 bg-gray-700 rounded-md text-white hover:bg-gray-600 transition text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                 </div>

                <div class="mb-4 pb-4 border-b border-gray-700">
                    <p><strong class="font-medium text-white">From:</strong> {{ $message->name }}</p>
                    <p><strong class="font-medium text-white">Email:</strong> <a href="mailto:{{ $message->email }}" class="text-teal-400 hover:text-teal-300">{{ $message->email }}</a></p>
                    <p><strong class="font-medium text-white">Received:</strong> {{ $message->created_at->format('M d, Y \a\t H:i') }} ({{ $message->created_at->diffForHumans() }})</p>
                    <p><strong class="font-medium text-white">Status:</strong> {{ is_null($message->read_at) ? 'Unread' : 'Read on ' . $message->read_at->format('M d, Y') }}</p>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-2 text-white">Message:</h2>
                    <div class="bg-gray-900/50 p-4 rounded-md whitespace-pre-wrap break-words"> {{-- Preserve whitespace and wrap text --}}
                        {{ $message->message }}
                    </div>
                </div>

                <div class="mt-8 text-right">
                     <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-sm">
                            <i class="fas fa-trash mr-1"></i> Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection