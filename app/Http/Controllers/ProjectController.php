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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Made thumbnail required for new projects
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'url' => ($request->input('status') === 'online' ? 'required|url' : 'nullable|url'),
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_screenshots' => 'nullable|array',
            'delete_screenshots.*' => 'integer', // Validates that each item is an integer (index)
        ]);

        // Prepare data for project update
        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'technologies' => json_encode(explode(',', $validated['technologies'])),
            'status' => $validated['status'],
            'url' => $validated['status'] === 'online' ? $validated['url'] : null,
        ];

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        // Handle screenshots
        $currentScreenshots = json_decode($project->screenshots ?? '[]', true);
        $finalScreenshots = [];

        // Process existing screenshots, keeping those not marked for deletion
        if (!empty($currentScreenshots)) {
            foreach ($currentScreenshots as $index => $screenshotPath) {
                if (!(isset($validated['delete_screenshots']) && in_array($index, $validated['delete_screenshots']))) {
                    $finalScreenshots[] = $screenshotPath; // Keep it
                } else {
                    Storage::disk('public')->delete($screenshotPath); // Delete marked screenshot
                }
            }
        }

        // Handle new screenshots upload
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                if ($file) { // Check if file is not null
                    $finalScreenshots[] = $file->store('projects/screenshots/' . $project->id, 'public');
                }
            }
        }
        
        // Only assign to updateData if there were actual changes to screenshots
        // This prevents overwriting with an empty array if no new files and no deletions.
        if ($request->hasFile('screenshots') || isset($validated['delete_screenshots']) || $project->screenshots !== json_encode(array_values($finalScreenshots))) {
            $updateData['screenshots'] = json_encode(array_values($finalScreenshots));
        }

        $project->update($updateData);
        
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
            if (is_array($screenshots)) {
                foreach ($screenshots as $screenshot) {
                    Storage::disk('public')->delete($screenshot);
                }
            }
        }
        
        $project->delete();
        
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}