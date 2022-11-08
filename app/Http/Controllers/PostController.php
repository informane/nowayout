<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Cache::has('posts')) {
            $posts = Post::orderBy('created_at', 'DESC')->get();
            Cache::set('posts', $posts);
        }
        else {
            $posts = Cache::get('posts');
        }

        return response()->view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        return response()->view('edit', ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:10|max:65535',
        ]);

        if($validator->validated()){
            $post = new Post();
            $post->fill($request->all());
            $post->save();
            $posts = Post::orderBy('created_at', 'DESC')->get();
            Cache::set('posts', $posts);
            if(!$request->ajax()) {
                return redirect('/index');
            }
            else {
                return response()->json(['result'=>'success','post_id' => $post->id]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);


        return response()->view('view',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return response()->view('edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:10|max:65535',
        ]);
        //return response()->json($request);
        if($valid){
            $post = Post::find($request->id);
            $post->fill($request->all());
            $post->save();
            $posts = Post::orderBy('created_at', 'DESC')->get();
            Cache::set('posts', $posts);
            if(!$request->ajax()) {
                return redirect('/index');
            }
            else {
                return response()->json(['result'=>'success', 'post_id' => $post->id]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        $posts = Post::orderBy('created_at', 'DESC')->get();
        Cache::set('posts', $posts);
        if(!\request()->ajax()) {
            return redirect('/index');
        }
        else {
            return response()->json(['result'=>'success']);
        }
    }

}
