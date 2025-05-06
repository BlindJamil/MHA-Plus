<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        
        if (request()->is('admin*')) {
            return view('admin.projects.index', compact('projects'));
        }
        
        return view('welcome', compact('projects'));
    }
    
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('project', compact('project'));
    }
    
    public function create()
    {
        return view('admin.projects.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'technologies' => 'required|string',
            'status' => 'required|string|in:online,offline,template',
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle technologies
        $validated['technologies'] = json_encode(explode(',', $validated['technologies']));
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }
        
        // Create the project
        $project = Project::create($validated);
        
        // Handle screenshots upload
        if ($request->hasFile('screenshots')) {
            $paths = [];
            foreach ($request->file('screenshots') as $file) {
                $paths[] = $file->store('projects/screenshots/' . $project->id, 'public');
            }
            $project->screenshots = json_encode($paths);
            $project->save();
        }
        
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }
    
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }
    
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'technologies' => 'required|string',
            'status' => 'required|string|in:online,offline,template',
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle technologies
        $validated['technologies'] = json_encode(explode(',', $validated['technologies']));
        
        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }
        
        // Update the project
        $project->update($validated);
        
        // Handle screenshots upload
        if ($request->hasFile('screenshots')) {
            $existing = json_decode($project->screenshots ?? '[]', true);
            $paths = $existing;
            
            foreach ($request->file('screenshots') as $file) {
                $paths[] = $file->store('projects/screenshots/' . $project->id, 'public');
            }
            
            $project->screenshots = json_encode($paths);
            $project->save();
        }
        
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function preview($id)
{
    $project = Project::findOrFail($id);
    
    if (!$project->has_preview) {
        return redirect()->route('projects.show', $project->id)
            ->with('error', 'No preview available for this project.');
    }
    
    return view('previews.show', compact('project'));
}
    
    public function destroy(Project $project)
    {
        // Delete associated files
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        
        if ($project->screenshots) {
            $screenshots = json_decode($project->screenshots, true);
            foreach ($screenshots as $screenshot) {
                Storage::disk('public')->delete($screenshot);
            }
        }
        
        $project->delete();

        
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}