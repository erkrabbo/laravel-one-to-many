<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public $validators = [
        'title'     => 'required|max:100',
        'content'   => 'required'
    ];

    private function getValidators(Post $post) {
        return [
            'title'     => 'required|max:100',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($post),
                'max:100'
            ],
            'content'   => 'required'
        ];
    }

    public function slugger(Request $request) {
        return response()->json([
            'slug' => Post::generateSlug($request->all()['originalStr'])
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::paginate(20);

        return view('index', compact('posts'));
    }

    /**
     * Display a listing of the resource for the logged user.
     *
     * @return \Illuminate\Http\Response
     */

    public function myindex() {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(20);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPost = new Post($request->all());
        $request->validate($this->getValidators($newPost));

        $post = Post::create($request->all());

        return redirect()->route('post.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $post->update($request->all());

        return redirect()->route('post.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->delete();

       return url()->previous() === route('post.show', $post) ? redirect()->route('myindex') : redirect()->back();
    }
}
