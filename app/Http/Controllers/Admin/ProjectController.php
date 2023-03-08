<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string| unique:projects| min:1| max:50',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ], [
            'name.required' => 'Il campo nome é obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.min' => 'Lunghezza minima consentita 1 carattere',
            'name.max' => 'Lunghezza massima consentita 50 caratteri',
            'name.unique' => "Il progetto $request->name è gia presente",
            'description.required' => 'Il campo descrizione é obbligatorio',
            'description.string' => 'La descrizione deve essere una stringa',
            'image.url' => 'Il campo imagine deve essere un URL',
        ]);

        $data = $request->all();
        $project = new Project();
        $project->github = "https://github.com/MarcoCalabretta1988";
        $project->linkedin = "www.linkedin.com/in/marco-calabretta-2b1b13195";
        $project->fill($data);
        $project->save();
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact(('project')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $request->validate([
            'name' => ['required', 'string', Rule::unique('projects')->ignore($project->id), 'min:1', 'max:50'],
            'description' => 'required|string',
            'image' => 'nullable|url',
        ], [
            'name.required' => 'Il campo nome é obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.min' => 'Lunghezza minima consentita 1 carattere',
            'name.max' => 'Lunghezza massima consentita 50 caratteri',
            'name.unique' => "Il progetto $project->name è gia presente",
            'description.required' => 'Il campo descrizione é obbligatorio',
            'description.string' => 'La descrizione deve essere una stringa',
            'image.url' => 'Il campo imagine deve essere un URL',
        ]);

        $data = $request->all();
        $project->github = "https://github.com/MarcoCalabretta1988";
        $project->linkedin = "www.linkedin.com/in/marco-calabretta-2b1b13195";
        $project->update($data);
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('type', 'success')->with('msg', 'Progetto eliminato con successo');
    }
}
