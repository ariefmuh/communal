<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Requests;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



        $file = $request->file('request_file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('dashboard/request'), $fileName);

        Requests::create([
            'nama' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            'request_file' => $fileName
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
}
