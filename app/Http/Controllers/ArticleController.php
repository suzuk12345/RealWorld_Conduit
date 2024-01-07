<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ConduitArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $authorId = Auth::user()->id;
        $article = Article::create([
            'slug' => implode('-', explode(' ', $request->title)),
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'user_id' => $authorId
        ]);

        return response()->json([
            'message' => '記事の作成に成功しました!',
            'article' => $article
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);

        return view('conduit.article', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);

        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;

        $article->save();

        return to_route('conduit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);

        $article->delete();

        return to_route('conduit.index');
    }
}