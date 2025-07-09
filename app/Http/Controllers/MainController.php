<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Homepages;

class MainController extends Controller
{

    function translateText($text, $targetLang = 'en')
    {
        $apiKey = env('GOOGLE_TRANSLATE_API_KEY');

        $response = Http::post("https://translation.googleapis.com/language/translate/v2", [
            'q' => $text,
            'target' => $targetLang,
            'format' => 'text',
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            return $response->json()['data']['translations'][0]['translatedText'];
        }

        return 'Translation failed';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = Homepages::where("name", "about")->first();
        $about_extra = Homepages::where("name", "about_extra")->get();
        $portofolio_extra = Homepages::where("name", "portofolio_extra")->get();
        $brand_affiliation_extra = Homepages::where("name", "brand_affiliation_extra")->get();
        return view("main.main", compact("about", "about_extra", "portofolio_extra", "brand_affiliation_extra"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
