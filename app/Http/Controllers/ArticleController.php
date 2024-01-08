<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
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
    public function create(Request $request)
    {
        $authorId = Auth::user()->id;
        $article = Article::create([
            'slug' => implode('-', explode(' ', $request->input('article.title'))),
            'title' => $request->input('article.title'),
            'description' => $request->input('article.description'),
            'body' => $request->input('article.body'),
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
    public function show(Request $request)
    {
        $article = Article::find($request->input('id'));
        $author = $article->author;
        return response()->json([
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $article = Article::find($request->input('id'));
        $authorId = $article->user_id;

        if (Auth::user()->id != $authorId) {
            return response()->json([
                'message' => '記事の著者ではありません。',
            ]);
        }

        $article->slug = implode('-', explode(' ', $request->input('article.title')));
        $article->title = $request->input('article.title');
        $article->description = $request->input('article.description');
        $article->body = $request->input('article.body');

        $article->save();

        return response()->json([
            'message' => '記事の更新に成功しました!',
            'article' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $article = Article::find($request->input('id'));

        $article->delete();

        return response()->json([
            'message' => '記事の削除に成功しました。'
        ]);
    }
}