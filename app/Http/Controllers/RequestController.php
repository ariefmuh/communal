<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\User;
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
            // Guest can only see their own requests
            $requests = Requests::join('users', 'users.id', '=', 'requests.user_id')
                ->select('requests.*', 'users.name', 'users.alamat', 'users.no_wa', 'users.email')
                ->where('requests.user_id', auth()->user()->id)
                ->get();
        } else {
            // Superuser can see all requests with user information
            $requests = Requests::join('users', 'users.id', '=', 'requests.user_id')
                ->select('requests.*', 'users.name', 'users.alamat', 'users.no_wa', 'users.email')
                ->get();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $request = Requests::find($id);

        if (!$request) {
            return redirect()->route('dashboard.request')->with('error', 'Request not found');
        }

        // Check if user is authorized to edit this request
        if (auth()->user()->role == "guest" && $request->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.request')->with('error', 'Unauthorized action');
        }

        // Check if request has been accepted, if so, cannot edit
        if ($request->progress == 1) {
            return redirect()->route('dashboard.request')->with('error', 'Cannot edit accepted request');
        }

        return view('dashboard.request.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRequest(Request $request, int $id)
    {
        $data = Requests::find($id);

        if (!$data) {
            return redirect()->route('dashboard.request')->with('error', 'Request not found');
        }

        // Check if user is authorized to update this request
        if (auth()->user()->role == "guest" && $data->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.request')->with('error', 'Unauthorized action');
        }

        // Check if request has been accepted, if so, cannot update
        if ($data->progress == 1) {
            return redirect()->route('dashboard.request')->with('error', 'Cannot edit accepted request');
        }

        $request->validate([
            'kategori' => 'required|string|max:255',
            'proposal' => 'nullable|file|mimes:pdf|max:32768',
        ]);

        $data->category = $request->kategori;

        // Handle file upload if new file is provided
        if ($request->hasFile('proposal')) {
            // Delete old file
            $oldFilePath = public_path('assets/pdf/requests/' . $data->proposal);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Upload new file
            $fileName = $request->proposal->getClientOriginalName() . "-" . time() . '.' . $request->proposal->extension();
            $request->proposal->move('assets/pdf/requests', $fileName);
            $data->proposal = $fileName;
        }

        $data->save();
        return redirect()->route('dashboard.request')->with('success', 'Request updated successfully');
    }

    /**
     * Accept the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(int $id)
    {
        $request = Requests::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Request not found');
        }

        $request->update(['progress' => 1]);

        $user = User::find($request->user_id);
        if ($user) {
            $user->update(['category' => $request->category]);
            $user->update(['role' => 'Team Leader']);
        }

        return redirect()->back()->with('success', 'Request accepted successfully and user promoted to Team Leader');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $request = Requests::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Request not found');
        }

        // Check if user is authorized to delete this request
        if (auth()->user()->role == "guest" && $request->user_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        // Check if request has been accepted (progress = 1), if so, guest cannot delete
        if (auth()->user()->role == "guest" && $request->progress == 1) {
            return redirect()->back()->with('error', 'Cannot delete accepted request');
        }

        // Delete the PDF file if it exists
        $filePath = public_path('assets/pdf/requests/' . $request->proposal);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $request->delete();
        return redirect()->back()->with('success', 'Request deleted successfully');
    }
}
