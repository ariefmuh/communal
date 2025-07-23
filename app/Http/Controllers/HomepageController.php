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
}
