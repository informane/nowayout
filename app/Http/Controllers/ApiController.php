<?php


namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll()
    {
        $posts= Post::all();

        return response()->json($posts);
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }

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
            return response()->json(['result'=>'store success','post' => $post]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:10|max:65535',
        ]);

        if($validator->validated()){
            $post = Post::find($id);
            $post->fill($request->all());
            $post->save();
            $posts = Post::orderBy('created_at', 'DESC')->get();
            Cache::set('posts', $posts);
            return response()->json(['result'=>'update success','post' => $post]);
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

        return response()->json(['result'=>'deleting success']);
    }
}
