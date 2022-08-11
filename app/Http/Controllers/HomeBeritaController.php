<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeBeritaController extends Controller
{
    //
    function index()
    {
        $post = Post::paginate(5);
        $data = [
            'post'          => $post,
            'kategori'      => Kategori::all(),
            'content'       => 'home/berita/index'
        ];
        return view('home/layouts/wrapper', $data);
    }

    function show($id)
    {
        $post = Post::find($id);
        $data = [
            'post'          => $post,
            'kategori'      => Kategori::all(),
            'content'       => 'home/berita/show'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
