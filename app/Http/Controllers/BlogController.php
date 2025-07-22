<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Tags;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::all();
        return view("dashboard.blogs.main", compact("blogs"));
    }

    public function detail($id)
    {
        $blog = Blogs::find($id);
        $tags = Tags::where('blog_id', $id)->get();
        $section = Sections::where('blog_id', $id)->get();
        return view("blogs.main", compact("blog", "tags", "section"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');
        $author = auth()->user()->name;
        return view("dashboard.blogs.create", compact("today", "author"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tags = $request->input('tags');
        $sections = $request->input('sections');

        if (is_string($tags)) {
            $tags = json_decode($tags, true);
            $request->merge(['tags' => $tags]);
        }

        if (is_string($sections)) {
            $sections = json_decode($sections, true);
            $request->merge(['sections' => $sections]);
        }

        $request->validate([
            'image' => 'required|image|max:5120', // max 5MB
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'required|array',
            'tags.*' => 'string|max:255',
            'sections' => 'required|array',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.description' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName(); // or use Str::uuid().'.ext' for unique names
                $file->move(public_path('assets/img/blogs'), $fileName); // Move to public/assets/img/blog/
            } else {
                return response()->json(['error' => 'No image uploaded.'], 400);
            }

            // Insert into blogs
            $blogId = DB::table('blogs')->insertGetId([
                'user_id' => Auth::id() ?? '1',
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'picture' => $fileName, // Only the filename is stored
                'opening' => $request->input('description'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            // Insert tags
            $tags = $request->input('tags');
            $tagData = [];
            foreach ($tags as $tag) {
                $tagData[] = [
                    'blog_id' => $blogId,
                    'name_tag' => $tag,
                ];
            }
            DB::table('tags')->insert($tagData);

            // Insert sections
            $sections = $request->input('sections');
            $sectionData = [];
            foreach ($sections as $section) {
                $sectionData[] = [
                    'blog_id' => $blogId,
                    'title' => $section['title'],
                    'description' => $section['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('sections')->insert($sectionData);

            DB::commit();

            return response()->json(['message' => 'Blog created successfully'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::find($id);
        $tags = Tags::where('blog_id', $id)->get();
        $section = Sections::where('blog_id', $id)->get();
        return view("dashboard.blogs.edit", compact("blog", "tags", "section"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $blog = Blogs::find($request->id);
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->opening = $request->description;
        $blog->save();
        $tags = Tags::where('blog_id', $request->id)->get();
        $tagData = [];
        foreach ($tags as $tag) {
            $tagData[] = [
                'blog_id' => $request->id,
                'name_tag' => $request->tags,
            ];
        }
        DB::table('tags')->insert($tagData);
        $sections = Sections::where('blog_id', $request->id)->get();
        $sectionData = [];
        foreach ($sections as $section) {
            $sectionData[] = [
                'blog_id' => $request->id,
                'title' => $request->sections['title'],
                'description' => $request->sections['description'],
            ];
        }
        DB::table('sections')->insert($sectionData);
        return response()->json(['message' => 'Blog updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(blogs $blogs)
    {
        //
    }
}
