<?php

namespace App\Http\Controllers;

use App\ProgrammingLanguage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
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
     * Show the profile dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $user = User::find($id);
        $data = [
            'posts' => $user->posts,
            'name' => $user->name,
            'id' => $id,
            'created_at' => $user->created_at,
        ];

        return view('profiles.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $p_languages = ProgrammingLanguage::orderBy('id', 'asc')->get();

        // Authenticate user
        if (auth()->user()->id !== $user->id) {
            return redirect('profiles/' . $id)->with('error', 'Unauthorized page');
        }

        $data = [
            'user' => $user,
            'pLanguages' => $p_languages,
        ];

        return view('profiles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'profile_picture' => 'image|nullable|max:1999',
            'birthDate' => 'nullable',
            'country' => 'nullable',
            'website' => 'nullable',
            'company_name' => 'nullable',
            'company_vat' => 'nullable',
            'company_logo' => 'image|nullable|max:1999',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:1999',
        ]);

        //Find user
        $user = User::find($id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('profile_picture')->storeAs('public/profile-pictures', $fileNameToStore);
        } else if ($user->profile_picture != null) {
            $fileNameToStore = $user->profile_picture;
        } else {
            $fileNameToStore = 'no_profile_picture.jpg';
        }
        $user->profile_picture = $fileNameToStore;

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('company_logo')->getClientOriginalName();
            // Get filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('company_logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('company_logo')->storeAs('public/company-logos', $fileNameToStore);
        } else if ($user->profile_picture != null) {
            $fileNameToStore = $user->company_logo;
        } else {
            $fileNameToStore = 'no_company_logo.jpg';
        }
        $user->company_logo = $fileNameToStore;

        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('cv')->getClientOriginalName();
            // Get filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('cv')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('cv')->storeAs('public/cv', $fileNameToStore);
        } else if ($user->cv != null) {
            $fileNameToStore = $user->cv;
        } else {
            $fileNameToStore = null;
        }
        $user->cv = $fileNameToStore;

        //Update user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthDate = $request->input('birthDate');
        if ($request->input('country') != 'Select a Country') {
            $user->country = $request->input('country');
        } else {
            $user->country = null;
        }

        $user->website = $request->input('website');
        $user->company_name = $request->input('company_name');
        $user->company_vat = $request->input('company_vat');
        $user->rep = $user->rep;

        $user->save();

        //Assign programming language(s)
        if ($request->input('css') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'css')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('js') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'js')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('html') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'html')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('php') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'php')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('ruby') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'ruby')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('python') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'python')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('java') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'java')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('c') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'c')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('csharp') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'csharp')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('cpp') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'cpp')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }
        if ($request->input('other') == 1) {
            $programmingLanguage = ProgrammingLanguage::where('cname', 'other')->first();
            $user->programming_languages()->attach($programmingLanguage);
        }

        return redirect('profiles/' . $id)->with('success', 'Profile updated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data = [
            'posts' => $user->posts,
            'name' => $user->name,
            'id' => $id,
            'created_at' => $user->created_at,
            'profile_picture' => $user->profile_picture,
            'birthDate' => $user->birthDate,
            'country' => $user->country,
            'website' => $user->website,
            'rep' => $user->rep,
        ];
        return view('profiles.index')->with($data);
    }

}
