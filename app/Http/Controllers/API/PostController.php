<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PostController
 *
 * @package App\Http\Controllers\API
 */
class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = post::all();

        return response()->json([
            'error' => false,
            'posts' => $posts
        ], 200);
    }

    /**
     * Create a specified post
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json([
            'error' => false,
            'post'  => $post,
        ], 200);
    }

    /**
     * Display the specified post.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $post = Post::with('comments')->find($id);

        if (!$post) {
            return response()->json([
                'error'   => true,
                'message' => 'The post with id ' . $id . ' not found.'
            ]);
        }

        return response()->json([
            'error' => false,
            'post'  => $post,
        ], 200);
    }

    /**
     * Update the specified post.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'error'   => true,
                'message' => 'The post with id ' . $id . ' not found.'
            ]);
        }

        $post->title   = $request->input('title');
        $post->content = $request->input('content');

        $post->save();

        return response()->json([
            'error' => false,
            'post'  => $post
        ], 200);
    }

    /**
     * Remove the specified post.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'error'   => true,
                'message' => 'The post with id ' . $id . ' not found.'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'error'   => false,
            'message' => 'The post with id ' . $post->id . ' has successfully been deleted.'
        ]);
    }
}
