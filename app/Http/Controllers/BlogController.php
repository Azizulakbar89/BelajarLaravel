<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Categoriable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $blogs = Blog::with(['tags', 'comments', 'image', 'ratings', 'categories'])->where("title", "like", "%" . $title . "%")->withTrashed()->orderBy("id", "desc")->paginate(5);
        // cek session login
        // return auth()->user();

        // policy
        // if ($request->user()->cannot('viewAny', Blog::class)) {
        //     abort(403);
        // }
        Gate::authorize('viewAny', Blog::class);


        return view("blog", ['blogs' => $blogs]);
        // return $blogs;

        // solving n+1 {with(['tags', 'comments'])->} artinya whit mengambil dari table yang berelasi
    }

    public function add()
    {
        $tags = Tag::all();
        return view('blog-add', ['tags' => $tags]);
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
        $blog = Blog::create($request->all());

        //ATTACH
        $blog->tags()->attach($request->tags);

        Session::flash('message', 'sukses');
        return redirect()->route('blog');
    }

    public function show($id)
    {




        // $blog = DB::table('blogs')->where('id', $id)->first();
        // menggunakan eloquent
        $blog = Blog::with(['comments', 'tags'])->findOrFail($id); //1-M //tags M-M

        // implementasi gates
        // if (!Gate::allows('update-blog', $blog)) {
        //     return redirect()->route('blog');
        // }

        // return $blog;
        // if ($blog == null) {
        //     abort(404);
        // }
        // 




        return view('blog-detail', ['blog' => $blog]);
    }

    public function edit(Request $request, $id)
    {
        $tags = Tag::all();
        // $blog = DB::table('blogs')->where('id', $id)->first();

        // ELOQUENT
        $blog = Blog::with('tags')->findOrFail($id);
        // if ($blog == null) {
        //     abort(404);
        // }

        // implementasi gates
        // if (!Gate::allows('update-blog', $blog)) {
        //     return redirect()->route('blog');
        // }
        // Gate::authorize('update-blog', $blog);
        // $response = Gate::inspect('update-blog', $blog);
        // if (!$response->allowed()) {
        //     abort(403, $response->message());
        // }

        // policy
        // if ($request->user()->cannot('update', $blog)) {
        //     abort(403);
        // }
        Gate::authorize('update', $blog);



        return view('blog-edit', ['blog' => $blog, 'tags' => $tags]);
    }
    public function up(Request $request, $id)
    {
        // validasi
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id . '|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->where('id', $id)->update([


        $blog = Blog::findOrFail($id);
        if ($request->user()->cannot('update', $blog)) {
            abort(403);
        }

        // // detach
        // $blog->tags()->detach($blog->tags);
        // // attach
        // $blog->tags()->attach($request->tags);

        // sync pengganti ATT dan DTT
        $blog->tags()->sync($request->tags);

        $blog->update($request->all());

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
