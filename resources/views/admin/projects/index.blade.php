{{-- resources/views/admin/projects/index.blade.php --}}
{{-- Minor change to display status for non-web projects --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHA Plus Admin - Projects</title>
    
    @vite('resources/css/app.css')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-gray-300">
    @extends('layouts.admin') {{-- Assuming you want to use the admin layout --}}
    
    @section('title', 'Admin - Projects')
    
    @section('content')
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Projects</h2>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">Add New Project</a>
        </div>
        
        {{-- Session messages are handled by layouts.admin --}}
        
        @if($projects->isEmpty())
            <div class="bg-gray-800 p-6 rounded-md">
                <p>No projects found. Create your first project by clicking the "Add New Project" button.</p>
            </div>
        @else
            <div class="bg-gray-800 rounded-md overflow-x-auto shadow-lg">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($projects as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($project->thumbnail)
                                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="h-10 w-10 rounded-md object-cover mr-3">
                                        @else
                                            <div class="h-10 w-10 rounded-md bg-gray-700 flex items-center justify-center mr-3 text-gray-500">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <span class="font-medium text-white">{{ $project->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-400">{{ ucfirst($project->category) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($project->category === 'web')
                                        @if($project->is_online)
                                            <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Online</span>
                                        @elseif($project->is_offline)
                                            <span class="px-2 py-1 bg-amber-500/20 text-amber-400 rounded-full text-xs">Offline</span>
                                        @else {{-- Template --}}
                                            <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded-full text-xs">Template</span>
                                        @endif
                                    @else
                                         <span class="text-gray-500 text-xs">—</span> {{-- Indicate N/A or different handling for non-web --}}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('projects.show', $project->id) }}" target="_blank" class="text-blue-400 hover:text-blue-300 mx-1" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-yellow-400 hover:text-yellow-300 mx-1" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 mx-1" title="Delete" onclick="return confirm('Are you sure you want to delete this project?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
    @endsection
</body>
</html>