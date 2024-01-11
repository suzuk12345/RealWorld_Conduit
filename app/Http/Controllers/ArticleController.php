<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

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

        for ($i = 0; $i < count($request->input('article.tagList')); $i++) {
            Tag::create([
                'article_id' => $article->id,
                'tag_name' => $request->input('article.tagList')[$i]
            ]);
        }

        $res = $this->articleRes($article);

        return response()->json($res);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $article = Article::find($request->input('id'));
        $res = $this->articleRes($article);

        return response()->json([$res]);
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

        $res = $this->articleRes($article);

        return response()->json([$res]);
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


    private function articleRes($article)
    {
        $tags = $article->tags;
        $author = $article->user;
        $tagList = [];
        for ($i = 0; $i < count($tags); $i++) {
            $tagList[] = $tags[$i]['tag_name'];
        }

        return [
            'article' => [
                'slug' => $article->slug,
                'title' => $article->title,
                'description' => $article->description,
                'body' => $article->body,
                'tagList' => $tagList,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
                'favoriteCount' => $article->favoriteCount,
                'author' => $author
            ]
        ];
    }
}
