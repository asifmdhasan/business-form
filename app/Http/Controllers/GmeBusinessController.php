<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmeBusinesses;

class GmeBusinessController extends Controller
{
    public function create()
    {
        return view('gme-business.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        
        $data['info_accuracy'] = $request->has('info_accuracy'); // true/false
        $data['allow_publish'] = $request->has('allow_publish');
        $data['allow_contact'] = $request->has('allow_contact');

        // Handle Uploads
        if ($request->hasFile('registration_document')) {
            $data['registration_document'] = $request->file('registration_document')->store('gme/docs', 'public');
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('gme/logo', 'public');
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('gme/photos', 'public');
            }
            $data['photos'] = $photos;
        }

        GmeBusinesses::create($data);

        return redirect()->route('gme-business.index')->with('success','Submission successful!');
    }

    public function index()
    {
        $businesses = GmeBusinesses::latest()->paginate(20);
        return view('gme-business.index', compact('businesses'));
    }
}
