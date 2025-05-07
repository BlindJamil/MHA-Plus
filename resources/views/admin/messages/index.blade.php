@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-300">
                <h1 class="text-2xl font-semibold mb-6 text-white">Contact Form Messages</h1>

                @if(session('success'))
                    <div class="mb-4 p-3 rounded-md bg-green-500/20 text-green-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                 @if(session('error'))
                    <div class="mb-4 p-3 rounded-md bg-red-500/20 text-red-400 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($messages->isEmpty())
                    <p>No messages received yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">From</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subject</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Received</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @foreach($messages as $message)
                                <tr class="{{ is_null($message->read_at) ? 'bg-gray-900/50 font-bold' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ is_null($message->read_at) ? 'text-white' : 'text-gray-300' }}">
                                        {{ $message->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ is_null($message->read_at) ? 'text-white' : 'text-gray-300' }}">
                                        {{ Str::limit($message->subject, 40) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $message->created_at->diffForHumans() }}
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                        @if(is_null($message->read_at))
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-300">
                                              New
                                            </span>
                                        @else
                                             <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-600/30 text-gray-400">
                                              Read
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.messages.show', $message) }}" class="text-indigo-400 hover:text-indigo-300 mr-3">View</a>
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $messages->links() }} {{-- Pagination links --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection