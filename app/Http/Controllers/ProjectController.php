<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Import Str for Str::limit if not already

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

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
            'url' => 'nullable|url|max:2048',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $updateData = $validated;
        
        // Prepare technologies
        $techArray = array_map('trim', explode(',', $validated['technologies']));
        $updateData['technologies'] = json_encode(array_values($techArray)); // Ensure it's a JSON array

        if ($request->hasFile('thumbnail')) {
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        if ($validated['status'] !== 'online' || empty($validated['url'])) {
            $updateData['url'] = null;
        } else {
            $updateData['url'] = $validated['url'];
        }
        
        // Remove screenshots from $updateData before Project::create if it's processed later
        // (it is, so we can unset it here or just ensure it's not an array)
        if (isset($updateData['screenshots'])) {
            unset($updateData['screenshots']); // Screenshots are handled after project creation
        }


        $project = Project::create($updateData);

        if ($request->hasFile('screenshots')) {
            $paths = [];
            foreach ($request->file('screenshots') as $file) {
                if ($file && $file->isValid()) {
                    $paths[] = $file->store('projects/screenshots/' . $project->id, 'public');
                }
            }
            if (!empty($paths)) {
                $project->screenshots = json_encode(array_values($paths)); // Ensure JSON array
                $project->save();
            }
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
            'url' => 'nullable|url|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_screenshots' => 'nullable|array',
            'delete_screenshots.*' => 'integer',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            // Prepare technologies
            'technologies' => json_encode(array_values(array_map('trim', explode(',', $validated['technologies'])))), // Ensure JSON array
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'online' && !empty($validated['url'])) {
            $updateData['url'] = $validated['url'];
        } else {
            $updateData['url'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        // Handle screenshots
        $currentScreenshots = $project->screenshots_array ?? [];
        $finalScreenshots = [];

        if (!empty($currentScreenshots)) {
            foreach ($currentScreenshots as $index => $screenshotPath) {
                if (!(isset($validated['delete_screenshots']) && in_array((string)$index, $validated['delete_screenshots'], true))) {
                    $finalScreenshots[] = $screenshotPath;
                } else {
                    Storage::disk('public')->delete($screenshotPath);
                }
            }
        }

        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                if ($file && $file->isValid()) {
                    $finalScreenshots[] = $file->store('projects/screenshots/' . $project->id, 'public');
                }
            }
        }
        
        // Only assign screenshots to updateData if there were actual changes.
        // And ensure it's a JSON array string.
        $newScreenshotsJson = json_encode(array_values($finalScreenshots));
        if ($project->screenshots !== $newScreenshotsJson) {
             $updateData['screenshots'] = $newScreenshotsJson;
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
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        if ($project->screenshots) {
            $screenshotsArray = json_decode($project->screenshots, true);
            if (is_array($screenshotsArray)) {
                foreach ($screenshotsArray as $screenshot) {
                    Storage::disk('public')->delete($screenshot);
                }
            }
        }
        Storage::disk('public')->deleteDirectory('projects/screenshots/' . $project->id);

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}