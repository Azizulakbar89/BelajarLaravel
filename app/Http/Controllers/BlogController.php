<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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

        // // pencarian
        // $title =  $request->title;

        // // paginate
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->Paginate(5);
        // return view('blog', ['blogs' => $blogs]);

        // Eloquent
        $title = $request->title;
        $blogs = Blog::where("title", "like", "%" . $title . "%")->withTrashed()->orderBy("id", "desc")->paginate(5);
        return view("blog", ['blogs' => $blogs]);
    }

    public function add()
    {
        return view('blog-add');
    }

    public function create(Request $request)
    {
        // validasi
        $request->validate([
            'title' => 'required|unique:blogs,title|max:255',
            'description' => 'required',
        ]);

        // Query builder
        // DB::table('blogs')->insert([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);
        // Session::flash('message', 'sukses');
        // return redirect()->route('blog');


        // ELOQUENT
        Blog::create($request->all());
        Session::flash('message', 'sukses');
        return redirect()->route('blog');
    }

    public function show($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first();
        // menggunakan eloquent
        $blog = Blog::with(['comments', 'tags'])->findOrFail($id); //1-M //tags M-M
        // return $blog;
        // if ($blog == null) {
        //     abort(404);
        // }
        // 

        return view('blog-detail', ['blog' => $blog]);
    }

    public function edit($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first();

        // ELOQUENT
        $blog = Blog::findOrFail($id);
        // if ($blog == null) {
        //     abort(404);
        // }
        return view('blog-edit', ['blog' => $blog]);
    }
    public function up(Request $request, $id)
    {
        // validasi
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id . '|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->where('id', $id)->update([
        Blog::find($id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        Session::flash('message', 'update sukses');
        return redirect()->route('blog');
    }
    public function delete($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->delete();
        Blog::find($id)->delete();
        Session::flash('message', 'delete sukses');
        return redirect()->route('blog');
    }

    // restore softdeletes
    public function restore(Request $request, $id)
    {
        Blog::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('blog');
    }
}
