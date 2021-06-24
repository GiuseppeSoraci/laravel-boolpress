<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('posts', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|unique:posts|min:5',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'required' => 'The :attribute is required',
            'unique' => 'The :attribute is already in use for another post',
        ]);


        $data = $request->all();

        // gen slug
        $data['slug'] = Str::slug($data['title'], '-');

        // create and save record on db
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        // save relation with tags in pivot tab
        if (array_key_exists('tags', $data)) {
            // post_tag
            $new_post->tags()->attach($data['tags']); // add new records to pivot tab
        }

        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if ($post) {
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }

        abort(404);
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
        // Validation
        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
                'min: 5'
            ],
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'required' => 'The :attribute is required',
            'unique' => 'The :attribute is already in use for another post',
        ]);


        $data = $request->all();

        $post = Post::find($id);

        // gen slug
        if ($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data);

        // update relation pivot tab
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach(); // remove all records pivot tab
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // remove tags
        $post->tags()->detach();

        // remove
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
