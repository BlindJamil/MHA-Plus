<?php
// app/Http/Controllers/ProjectController.php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
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

    public function showAllProjectsPage()
    {
        $projectsPerPage = 12;
        // Eager load screenshots and technologies if they are frequently accessed in the loop
        // to avoid N+1 query issues, though with simple attributes it might not be an issue.
        // For now, standard pagination is fine.
        $projects = Project::latest()->paginate($projectsPerPage);
        return view('portfolio.index', compact('projects'));
    }

    // ... other methods (show, create, store, edit, update, destroy, preview) remain the same as previously updated ...
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

        $updateData['technologies'] = !empty($validated['technologies']) ?
            json_encode(array_values(array_map('trim', explode(',', $validated['technologies'])))) :
            json_encode([]);

        if ($validated['category'] === 'web') {
            if ($validated['status'] === 'online' && !empty($validated['url'])) {
                // URL is already in $updateData from $validated
            } else {
                $updateData['url'] = null;
            }
        } else {
            $updateData['status'] = $validated['status'] ?? 'offline';
            $updateData['url'] = null;
        }
        
        if (isset($updateData['screenshots'])) {
            unset($updateData['screenshots']);
        }

        if ($request->hasFile('thumbnail')) {
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
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

        $updateData['technologies'] = !empty($validated['technologies']) ?
            json_encode(array_values(array_map('trim', explode(',', $validated['technologies'])))) :
            json_encode([]);

        if ($validated['category'] === 'web') {
            if ($validated['status'] === 'online' && !empty($validated['url'])) {
                // URL already in $updateData
            } else {
                $updateData['url'] = null;
            }
        } else { 
            if (is_null($validated['status'])) {
                $updateData['status'] = ($project->category === 'web' && $validated['category'] !== 'web') ? 'offline' : $project->status;
            } else {
                $updateData['status'] = $validated['status'];
            }
            $updateData['url'] = null;
        }
        
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $updateData['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        } else {
             if (array_key_exists('thumbnail', $updateData)){ // if thumbnail was part of validated data (e.g. cleared from form but not a file upload)
                unset($updateData['thumbnail']); // Prevent overwriting existing thumbnail with null if no new file is uploaded
            }
        }

        $newScreenshotsInputForUpdate = $updateData['screenshots'] ?? null; 
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
                if ($file && $file->isValid()) {
                    $finalScreenshots[] = $file->store('projects/screenshots/' . $project->id, 'public');
                }
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