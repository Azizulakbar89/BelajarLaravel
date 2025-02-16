<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        // return view('blog', ['data' => 'tes']);

        // menampilkan data dari database
        // $blogs = DB::table('blogs')->get();
        // return $blogs;

        // menampilkan dari views
        // $blogs = DB::table('blogs')->get();
        // return view('blog', ['blogs' => $blogs]);

        // pencarian
        $title =  $request->title;

        // paginate
        $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->Paginate(5);
        return view('blog', ['blogs' => $blogs]);
    }
}
