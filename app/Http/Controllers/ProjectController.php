<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Make sure to import Log

class ProjectController extends Controller
{
    // ... (your existing index, showAllProjectsPage, and other admin methods) ...

    public function index()
    {
        $allProjects = Project::latest()->get();

        if (request()->is('admin*')) {
            return view('admin.projects.index', ['projects' => $allProjects]);
        }

        // For public welcome page
        $projectsForWelcomePage = $allProjects->take(6);
        $totalProjectsCount = $allProjects->count();

        return view('welcome', [
            'projects' => $projectsForWelcomePage,
            'totalProjects' => $totalProjectsCount
        ]);
    }

    /**
     * Fetch filtered projects for the welcome page via AJAX.
     */
    public function getWelcomePageFilteredProjects(Request $request)
    {
        $categoryInput = $request->query('category');
        Log::info('[ProjectController] Welcome Page Filter: Received category parameter: \'' . $categoryInput . '\'');

        $query = Project::query();

        if ($categoryInput && $categoryInput !== 'all') {
            Log::info('[ProjectController] Welcome Page Filter: Applying WHERE clause for category: \'' . $categoryInput . '\'');
            $query->where('category', $categoryInput);
        } else {
            Log::info('[ProjectController] Welcome Page Filter: Category is "all" or empty, fetching latest 6 from all projects.');
        }

        $projects = $query->latest()->take(6)->get();
        
        Log::info('[ProjectController] Welcome Page Filter: Found ' . $projects->count() . ' projects after query.');
        if ($projects->isNotEmpty()) {
            $returnedCategories = $projects->pluck('category')->unique()->implode(', ');
            Log::info('[ProjectController] Welcome Page Filter: Categories of projects being returned: [' . $returnedCategories . ']');
        }


        $mappedProjects = $projects->map(function($project, $index) {
            // Prepare data for JSON response
            return [
                'id' => $project->id,
                'title' => $project->title,
                'category' => $project->category, // Crucial for debugging on the frontend if needed
                'description_limited' => Str::limit($project->description, 80),
                'thumbnail_url' => $project->thumbnail ? asset('storage/' . $project->thumbnail) : null,
                'screenshots_array' => $project->screenshots_array ? collect($project->screenshots_array)->map(function($path) {
                    // Ensure the path from DB is correctly formed for asset() if it's not already full
                    // If screenshots_array already contains full URLs or is handled differently, adjust here.
                    // Assuming $path is relative to 'storage/' like 'projects/screenshots/ID/filename.jpg'
                    return asset('storage/' . $path);
                })->all() : [],
                'technologies_array' => $project->technologies_array ?? [],
                'project_details_url' => route('projects.show', $project->id),
                'is_online' => $project->is_online,
                'is_offline' => $project->is_offline,
                'aos_delay' => ($index % 3) * 100,
                'status_text' => $project->category === 'web' ? ($project->is_online ? 'Online' : ($project->is_offline ? 'Offline' : 'Template')) : null,
                'status_classes' => $project->category === 'web' ? ($project->is_online ? 'bg-green-500/90 text-white' : ($project->is_offline ? 'bg-amber-500/90 text-white' : 'bg-purple-500/90 text-white')) : null,
            ];
        });

        return response()->json($mappedProjects);
    }

    // Make sure your other methods like show, create, store, edit, update, destroy are still here.
    // For example:
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('project', compact('project'));
    }
    
    public function showAllProjectsPage()
    {
        $projectsPerPage = 12;
        $projects = Project::latest()->paginate($projectsPerPage);
        return view('portfolio.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'technologies' => 'nullable|string',
            'status' => 'nullable|string|in:online,offline,template',
            'url' => 'nullable|url|max:2048',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        if ($request->input('category') === 'web') {
            $rules['technologies'] = 'required|string';
            $rules['status'] = 'required|string|in:online,offline,template';
        }

        $validated = $request->validate($rules);
        $updateData = $validated;
        $updateData['technologies'] = !empty($validated['technologies']) ? json_encode(array_values(array_map('trim', explode(',', $validated['technologies'])))) : json_encode([]);
        if ($validated['category'] === 'web') {
            if (!($validated['status'] === 'online' && !empty($validated['url']))) {
                $updateData['url'] = null;
            }
        } else {
            $updateData['status'] = $validated['status'] ?? 'offline';
            $updateData['url'] = null;
        }
        if (isset($updateData['screenshots'])) unset($updateData['screenshots']);
        if ($request->hasFile('thumbnail')) $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        $project = Project::create($updateData);
        if ($request->hasFile('screenshots')) {
            $paths = [];
            foreach ($request->file('screenshots') as $file) {
                if ($file && $file->isValid()) $paths[] = $file->store('projects/screenshots/' . $project->id, 'public');
            }
            if (!empty($paths)) {
                $project->screenshots = json_encode(array_values($paths));
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
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'technologies' => 'nullable|string',
            'status' => 'nullable|string|in:online,offline,template',
            'url' => 'nullable|url|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_screenshots' => 'nullable|array',
            'delete_screenshots.*' => 'integer',
        ];
        if ($request->input('category') === 'web') {
            $rules['technologies'] = 'required|string';
            $rules['status'] = 'required|string|in:online,offline,template';
        }
        $validated = $request->validate($rules);
        $updateData = $validated;
        $updateData['technologies'] = !empty($validated['technologies']) ? json_encode(array_values(array_map('trim', explode(',', $validated['technologies'])))) : json_encode([]);
        if ($validated['category'] === 'web') {
            if (!($validated['status'] === 'online' && !empty($validated['url']))) $updateData['url'] = null;
        } else {
            $updateData['status'] = $validated['status'] ?? (($project->category === 'web' && $validated['category'] !== 'web') ? 'offline' : $project->status);
            $updateData['url'] = null;
        }
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        } elseif (array_key_exists('thumbnail', $updateData)) {
            unset($updateData['thumbnail']);
        }
        $deleteScreenshotsInputForUpdate = $updateData['delete_screenshots'] ?? null;
        unset($updateData['screenshots'], $updateData['delete_screenshots']);
        $project->update($updateData);
        $currentScreenshots = $project->screenshots_array ?? [];
        $finalScreenshots = [];
        if (!empty($currentScreenshots)) {
            foreach ($currentScreenshots as $index => $screenshotPath) {
                if (!($deleteScreenshotsInputForUpdate && in_array((string)$index, $deleteScreenshotsInputForUpdate, true))) {
                    $finalScreenshots[] = $screenshotPath;
                } else {
                    Storage::disk('public')->delete($screenshotPath);
                }
            }
        }
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                if ($file && $file->isValid()) $finalScreenshots[] = $file->store('projects/screenshots/' . $project->id, 'public');
            }
        }
        $newScreenshotsJson = json_encode(array_values($finalScreenshots));
        if ($project->screenshots !== $newScreenshotsJson) {
            $project->screenshots = $newScreenshotsJson;
            $project->save();
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }
    
    public function preview($id)
    {
        $project = Project::findOrFail($id);
        if (!$project->has_preview) {
            return redirect()->route('projects.show', $project->id)->with('error', 'No preview available for this project.');
        }
        return view('previews.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
        if ($project->screenshots) {
            $screenshotsArray = json_decode($project->screenshots, true);
            if (is_array($screenshotsArray)) {
                foreach ($screenshotsArray as $screenshot) Storage::disk('public')->delete($screenshot);
            }
        }
        Storage::disk('public')->deleteDirectory('projects/screenshots/' . $project->id);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}