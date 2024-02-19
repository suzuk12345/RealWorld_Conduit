<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedArticleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['globalFeed', 'show']]);
    }

    // 記事一覧(全体)
    public function globalFeed()
    {
        return FeedArticleResource::collection(Article::with('user', 'tags')->orderBy('id', 'desc')->paginate(5));
    }

    // 記事一覧(認証済みユーザー)
    public function userFeed()
    {
        return FeedArticleResource::collection(Article::where('user_id', '=', auth()->user()->id)->with('user', 'tags')->orderBy('id', 'desc')->paginate(5));
    }


    // 記事作成
    public function create(Request $request)
    {
        $authorId = auth()->user()->id;
        $article = Article::create([
            'slug' => urlencode(implode('-', explode(' ', $request->input('article.title')))),
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

    // 記事取得
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $res = $this->articleRes($article);

        return response()->json($res);
    }

    // 記事更新
    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (auth()->user()->id != $article->user_id) {
            return response()->json([
                'message' => '記事の著者ではありません。',
            ], 401);
        }

        $article->slug = urlencode(implode('-', explode(' ', $request->input('article.title'))));
        $article->title = $request->input('article.title');
        $article->description = $request->input('article.description');
        $article->body = $request->input('article.body');

        $article->save();

        $res = $this->articleRes($article);

        return response()->json($res);
    }

    // 記事削除
    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (auth()->user()->id != $article->user_id) {
            return response()->json([
                'message' => '記事の著者ではありません。',
            ], 401);
        }

        $article->delete();
        return response()->json([
            'message' => '記事の削除に成功しました。'
        ]);
    }

    // レスポンス作成
    private function articleRes($article)
    {
        $author = $article->user;
        $tags = $article->tags;
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