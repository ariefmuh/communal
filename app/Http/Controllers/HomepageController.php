<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepages;

class HomepageController extends Controller
{
    public function index()
    {
        $homepages = Homepages::all();
        return view('dashboard.homepage.index', compact('homepages'));
    }

    public function update(Request $request)
    {
        return response()->json(['message' => 'Homepage updated successfully'], 200);
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
