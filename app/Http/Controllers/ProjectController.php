<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\ProgrammingLanguage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);
        $projects = Project::where('user_id', $id)->orderBy('id', 'DESC')->get();

        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programmingLanguages = ProgrammingLanguage::orderBy('id', 'asc')->get();

        $data = [
            'pLanguages' => $programmingLanguages
        ];

        return view('projects.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'project-title' => 'required',
            'project-description' => 'required',
            'payment-type' => 'required',
            'payment-price' => 'numeric|nullable',
            'deadline' => 'nullable',
        ]);


        // Create project
        $project = new Project;

        $project->title = $request->input('project-title');
        $project->description = $request->input('project-description');
        $project->price_type = $request->input('payment-type');
        $project->price = $request->input('payment-price');
        $project->deadline = $request->input('deadline');
        $project->user_id = auth()->user()->id;

        
        $project->save();

        //Assign programming language(s)
        if($request->input('css') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'css')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('js') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'js')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('html') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'html')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('php') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'php')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('ruby') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'ruby')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('python') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'python')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('java') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'java')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('c') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'c')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('csharp') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'csharp')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('cpp') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'cpp')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
        if($request->input('other') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'other')->first();
            $project->programming_languages()->attach($programmingLanguage);
        } 
    

        return redirect('/profiles/'.auth()->user()->id.'/projects')->with('success', 'Project created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
