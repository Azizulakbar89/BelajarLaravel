<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('blog')->get();
        return $comments;
    }
    // 1-M
    public function store(Request $request, $blog_id)
    {
        $request->validate([
            'comment_text' => 'required',
        ]);
        $request['blog_id'] = $blog_id;
        Comment::create($request->all());
        Session::flash('message', 'OK');
        return redirect()->route('blog-detail', $blog_id);
    }
    //1-M
}
