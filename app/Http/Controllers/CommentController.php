<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // $post_id = $request->post_id; //kirim post_id dari frontend
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required|string',
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create(
            $request->all()
        );

        return new CommentResource($comment->loadMissing(['commentator:id,username']));


        // $comments = Comment::with('commentator')->get();
        // return CommentResource::collection($comments);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'comments_content' => 'required|string',
        ]);

        $comment = Comment::findorFail($id);
        $comment->update($request->only(['comments_content']));

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }
}
