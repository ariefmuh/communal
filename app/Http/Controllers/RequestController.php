<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == "guest") {
            $requests = Requests::join('users', 'users.id', '=', 'requests.user_id')
                ->select('requests.*', 'users.name', 'users.alamat', 'users.no_wa')
                ->get();
        } else {
            $requests = Requests::all();
        }

        return view("dashboard.request.main", compact("requests"));
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
        $request->validate([
            'kategori' => 'required|string|max:255',
            'proposal' => 'required|file|mimes:pdf|max:32768',
        ]);

        $data = new Requests();
        $data->user_id = auth()->user()->id;
        $data->category = $request->kategori;
        $fileName = $request->proposal->getClientOriginalName() . "-" . time() . '.' . $request->proposal->extension();
        $request->proposal->move('assets/pdf/requests', $fileName);
        $data->proposal = $fileName;
        $data->progress = 0;

        $data->save();
        return redirect()->route('dashboard.request');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        $data = Requests::find($id)->update(['progress' => 1]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
}
