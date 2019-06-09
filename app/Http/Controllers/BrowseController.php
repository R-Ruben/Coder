<?php

namespace App\Http\Controllers;

use App\Post;
use App\ProgrammingLanguage;
use App\Project;

class BrowseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::sortable(['created_at' => 'desc'])->paginate(20);
        // $programmingLanguages = ProgrammingLanguage::orderBy('id', 'desc')->get();
        // // $projects = Project::orderBy('created_at', 'desc')->get();
        // $projects = Project::sortable(['created_at' => 'desc'])->paginate(20);

        // $data = [
        //     'posts' => $posts,
        //     'pLanguages' => $programmingLanguages,
        //     'projects' => $projects
        // ];

        // return view('browse.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postsIndex()
    {
        $posts = Post::sortable(['created_at' => 'desc'])->paginate(20);
        $programmingLanguages = ProgrammingLanguage::orderBy('id', 'desc')->get();

        $data = [
            'posts' => $posts,
            'pLanguages' => $programmingLanguages,
        ];

        return view('browse.posts')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectsIndex()
    {
        $projects = Project::sortable(['created_at' => 'desc'])->paginate(20);
        $programmingLanguages = ProgrammingLanguage::orderBy('id', 'desc')->get();

        $data = [
            'projects' => $projects,
            'pLanguages' => $programmingLanguages,
        ];

        return view('browse.projects')->with($data);
    }

}
