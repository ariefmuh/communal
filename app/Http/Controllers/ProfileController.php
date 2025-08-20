<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        return view('dashboard.profile.index');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nama_pic' => 'nullable|string|max:255',
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->nama_pic = $request->nama_pic;
        $user->no_wa = $request->no_wa;
        $user->alamat = $request->alamat;

        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($user->image) {
                Storage::delete('assets/img/profile/' . $user->image);
            }
            $imgName = $request->file('image');
            $originalName = $imgName->getClientOriginalName();
            $filename = $originalName . "-" . time() . '.' . $request->image->extension();
            $user->image = $filename;
            $request->image->move('assets/img/profile/', $filename);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
