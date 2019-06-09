<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('applications.index')->with('applications', $applications);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'motivation' => 'required',
            'price' => 'numeric|nullable',
        ]);

        //Check if already applied for this project
        $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $alreadyApplied = false;

        foreach ($applications as $app) {
            if ($app->project->id == $request->input('project_id')) {
                $alreadyApplied = true;
            }
        }
        // Create Application
        $application = new Application;

        $application->motivation = $request->input('motivation');
        $application->price = $request->input('price');
        $application->project_id = $request->input('project_id');
        $application->user_id = auth()->user()->id;

        if ($alreadyApplied) {
            return redirect('/projects/' . $application->project_id)->with('error', 'You already applied for this project.');
        } else {
            $application->save();
            return redirect('/projects/' . $application->project_id)->with('success', 'Succesfully applied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = Application::find($id);

        // Check user authorization
        if (auth()->user()->id !== $application->user_id) {
            return redirect('/applications')->with('error', 'Unauthorized page');
        }

        //Check if application is accepted or denied and save it
        if ($request->input('accepted') != null) {
            $application->accepted = $request->input('accepted');
            $application->save();

            if ($application->accepted > 0) {
                return redirect('/profiles/' . $application->project->user_id . '/projects')->with('success', 'Application accepted.');
            } else {
                return redirect('/profiles/' . $application->project->user_id . '/projects')->with('success', 'Application declined.');
            }
            return redirect('/profiles/' . $application->project->user_id . '/projects')->with('success', 'Application updated.');
        }

        //Check if motivation/price is being edited
        if ($request->input('motivation') != null) {
            $application->motivation = $request->input('motivation');

            if ($request->input('price') != null) {
                $application->price = $request->input('price');
            }

            $application->save();

            return redirect('/applications')->with('success', 'Application updated.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);

        // Check user authorization
        if (auth()->user()->id !== $application->user_id) {
            return redirect('/applications')->with('error', 'Unauthorized page');
        }

        $application->delete();
        return redirect('/applications')->with('success', 'Application removed.');
    }

}
