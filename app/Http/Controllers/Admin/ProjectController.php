<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ], [
            'name.required' => 'Il campo nome é obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.min' => 'Lunghezza minima consentita 1 carattere',
            'name.max' => 'Lunghezza massima consentita 50 caratteri',
            'name.unique' => "Il progetto $request->name è gia presente",
            'description.required' => 'Il campo descrizione é obbligatorio',
            'description.string' => 'La descrizione deve essere una stringa',
            'image.image' => 'Il campo imagine deve essere un file',
            'image.mimes' => 'L\'immagine deve essere JPEG,PNG,JPG',
        ]);

        $data = $request->all();
        $project = new Project();

        if (Arr::exists($data, 'image')) {
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->github = "https://github.com/MarcoCalabretta1988";
        $project->linkedin = "www.linkedin.com/in/marco-calabretta-2b1b13195";
        $project->fill($data);
        $project->save();
        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('msg', 'Crezione avvenuta con successo');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ], [
            'name.required' => 'Il campo nome é obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.min' => 'Lunghezza minima consentita 1 carattere',
            'name.max' => 'Lunghezza massima consentita 50 caratteri',
            'name.unique' => "Il progetto $project->name è gia presente",
            'description.required' => 'Il campo descrizione é obbligatorio',
            'description.string' => 'La descrizione deve essere una stringa',
            'image.image' => 'Il file deve essere un Immagine',
            'image.mimes' => 'L\'immagine deve essere JPEG,PNG,JPG',
        ]);

        $data = $request->all();
        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }
        $project->github = "https://github.com/MarcoCalabretta1988";
        $project->linkedin = "www.linkedin.com/in/marco-calabretta-2b1b13195";
        $project->update($data);
        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('msg', 'Modifica avvenuta con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return to_route('admin.projects.index')->with('type', 'success')->with('msg', 'Progetto eliminato con successo');
    }
}
