<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        return Comments::all();
    }

    public function show($postId)
    {
        $comments = Comments::getComment($postId);
        echo 'post id = '.$postId.'<br />';
        echo $comments;
        die;
        return $comments;
    }

    public function store(Request $request)
    {
        $comment = Comments::create($request->all());
        return response()->json($comment, 201);
    }

    public function update(Request $request, $commentId)
    {
        $comment = Comments::findOrFail($commentId);
        $comment->update($request->all());
        return response()->json($comment, 200);
    }

    public function delete(Comments $commentId)
    {
        $comment = Comments::findOrFail($commentId);
        $children = Comments::where('postId','=',$comment->postId)->where('parentId','=',$comment->id)->get();
        if($children){
            foreach ($children as $key => $child) {
                DB::table('comments')
                ->where('id', $child->id)
                ->update(['parentId' => $comment->id]);
            }
        }
        $comment->delete();
        return response()->json(null, 204);
    }
}
