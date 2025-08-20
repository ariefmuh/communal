<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Team Leader') {
            $galleries = Gallery::where('team_leader_id', auth()->user()->id)->get();
        } else {
            // if the user is an admin or superuser get all team_leaders
            $galleries = User::where('role', 'Team Leader')->get();
        }

        return view('dashboard.gallery.index', compact('galleries'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can add gallery photos');
        }

        return view('dashboard.gallery.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can add gallery photos');
        }

        $request->validate([
            'galleries' => 'required|array|min:1',
            'galleries.*.photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galleries.*.caption' => 'required|string|max:255'
        ], [
            'galleries.min' => 'You must submit at least 1 photo',
            'galleries.*.photo.required' => 'Photo is required',
            'galleries.*.photo.image' => 'File must be an image',
            'galleries.*.caption.required' => 'Caption is required'
        ]);

        foreach ($request->galleries as $index => $galleryData) {
            if (isset($request->file('galleries')[$index]['photo'])) {
                $photo = $request->file('galleries')[$index]['photo'];
                $photoName = time() . '_' . $index . '.' . $photo->getClientOriginalExtension();
                $photoPath = $photo->storeAs('galleries', $photoName, 'public');

                Gallery::create([
                    'team_leader_id' => auth()->user()->id,
                    'photo_path' => $photoPath,
                    'caption' => $galleryData['caption']
                ]);
            }
        }

        return redirect()->route('dashboard.gallery')->with('success', 'Gallery photos submitted successfully');
    }

    public function show($id)
    {
        $teamLeader = User::where('role', 'Team Leader')->findOrFail($id);
        $galleries = Gallery::where('team_leader_id', $id)->get();

        return view('dashboard.gallery.show', compact('teamLeader', 'galleries'));
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Team leaders can only delete their own photos
        if (auth()->user()->role == 'Team Leader' && $gallery->team_leader_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        // Delete the photo file
        if (Storage::disk('public')->exists($gallery->photo_path)) {
            Storage::disk('public')->delete($gallery->photo_path);
        }

        $gallery->delete();
        return redirect()->back()->with('success', 'Gallery photo removed successfully');
    }
}
