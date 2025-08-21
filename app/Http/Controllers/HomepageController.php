<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepages;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $homepages = Homepages::all();
        return view('dashboard.homepage.index', compact('homepages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:homepages,id',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'picture' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf|max:4096',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $homepage = Homepages::findOrFail($request->id);

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ];

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '_' . uniqid() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('assets/img'), $pictureName);

            // Delete old file if exists
            if ($homepage->picture && file_exists(public_path('assets/img/' . $homepage->picture))) {
                @unlink(public_path('assets/img/' . $homepage->picture));
            }
            $data['picture'] = $pictureName;
        }

        $homepage->update($data);

        return redirect()->route('dashboard.homepage')->with('success', 'Homepage updated successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pictureName = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('assets/img'), $pictureName);
        }

        Homepages::create([
            'name' => $request->name,
            'title' => $request->title,
            'picture' => $pictureName,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.homepage')->with('success', 'Homepage created successfully');
    }
}
