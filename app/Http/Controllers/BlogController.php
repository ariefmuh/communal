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
        if (Auth::user()->role == 'superuser') {
            $blogs = Blogs::all();
        } else {
            $blogs = Blogs::where('user_id', Auth::id())->get();
        }
        return view("dashboard.blogs.main", compact("blogs"));
    }

    public function view()
    {
        $blogs = Blogs::all();
        return view("blogs.view", compact("blogs"));
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


            // Insert new tags
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

            return response()->json(['message' => 'Blog created successfully', 'redirect' => route('dashboard.blog')], 201);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

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
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tags' => 'required|array',
                'tags.*' => 'string|max:255',
                'sections' => 'required|array',
                'sections.*.title' => 'required|string|max:255',
                'sections.*.description' => 'required|string',
            ]);

            $blog = Blogs::findOrFail($id);

            // Handle image update if provided
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|max:5120', // max 5MB
                ]);

                // Delete old image if exists
                if ($blog->picture && file_exists(public_path('assets/img/blogs/' . $blog->picture))) {
                    unlink(public_path('assets/img/blogs/' . $blog->picture));
                }

                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('assets/img/blogs'), $fileName);
                $blog->picture = $fileName;
            }

            // Update blog
            $blog->update([
                'user_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'opening' => $request->input('description'),
            ]);

            // Delete existing tags and sections
            Tags::where('blog_id', $id)->delete();
            Sections::where('blog_id', $id)->delete();

            // Insert new tags
            $tagData = [];
            foreach ($tags as $tag) {
                $tagData[] = [
                    'blog_id' => $id,
                    'name_tag' => trim($tag),
                ];
            }
            DB::table('tags')->insert($tagData);

            // Insert new sections
            $sectionData = [];
            foreach ($sections as $section) {
                $sectionData[] = [
                    'blog_id' => $id,
                    'title' => $section['title'],
                    'description' => $section['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('sections')->insert($sectionData);

            DB::commit();
            return response()->json(['message' => 'Blog updated successfully', 'redirect' => route('dashboard.blog')], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $blog = Blogs::findOrFail($id);

            // Delete blog image if exists
            if ($blog->picture && file_exists(public_path('assets/img/blogs/' . $blog->picture))) {
                unlink(public_path('assets/img/blogs/' . $blog->picture));
            }

            // Delete related tags and sections
            Tags::where('blog_id', $id)->delete();
            Sections::where('blog_id', $id)->delete();

            // Delete the blog
            $blog->delete();

            return redirect()->route('dashboard.blog')->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.blog')->with('error', 'Failed to delete blog: ' . $e->getMessage());
        }
    }
}
