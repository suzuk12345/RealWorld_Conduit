<?php

namespace App\Http\Controllers;

use App\Models\ConduitArticle;
use Illuminate\Http\Request;

class ConduitArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = ConduitArticle::select('id', 'title', 'description', 'updated_at')->get();

        return view('conduit.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function editorNew()
    {
        return view('conduit.editor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        ConduitArticle::create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body
        ]);

        return to_route('conduit.index');
    }

    /**
     * Display the specified resource.
     */
    public function article(string $id)
    {
        $article = ConduitArticle::find($id);

        return view('conduit.article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editorExisting(string $id = '')
    {
        $article = ConduitArticle::find($id);

        return view('conduit.editor', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}