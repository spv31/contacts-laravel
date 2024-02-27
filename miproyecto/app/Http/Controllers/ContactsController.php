<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class ContactsController extends Controller
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits:9',
        'age' => 'required|numeric|min:1|max:255',
        'profile_picture' => 'image|nullable'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()){
            return redirect()->route('home');
        }
        $contacts = auth()
            ->user()
            ->contacts()
            ->orderBy('name', 'desc')
            ->paginate(6); // Si que funciona correctamente

        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        // if (is_null($data['name'])) {
        //     //return redirect()->back()
        //     return back()->withErrors([
        //         'name' => 'This field is required',
        //     ]);
        //     // return FacadesResponse::redirectTo(route('contacts.create'))->withErrors([
        //     //     'name' => 'This field is required',
        //     // ]);
        // }
        $data = $request->validate($this->rules);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }
        //Contacts::create($data);
        //$data['user_id'] = auth()->id();
        // $contact = New Contacts($data);
        // $contact->save();
        
        $contact = auth()->user()->contacts()->create($data);

        session()->flash('alert', [
            'message' => "Contact $contact->name added successfully",
            'type' => "success"
        ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        //compact('contact') === ['contact' => $contacts]:
        // if (!Gate::allows('update-post', $contacts)) {
        //     abort(403);
        // }
        $this->authorize('view', $contacts);

        return view('contacts.show', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        $this->authorize('update', $contacts);

        return view('contacts.edit', compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        $this->authorize('update', $contacts);

        $data = $request->validate($this->rules);
        
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }
        $contacts->update($data);

        session()->flash('alert', [
            'message' => "Contact $contacts->name updated successfully",
            'type' => "success"
        ]);
        
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts)
    {
        $this->authorize('delete', $contacts);

        $contacts->delete();

        session()->flash('alert', [
            'message' => "Contact $contacts->name deleted successfully",
            'type' => "success"
        ]);

        return redirect()->route('home');
    }
}
