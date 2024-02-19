<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $article = $this->resource;
        $tagList = [];
        for ($i = 0; $i < count($article->tags); $i++) {
            $tagList[] = $article->tags[$i]['tag_name'];
        }

        return [
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
            'description' => $article->description,
            'body' => $article->body,
            'tagList' => $tagList,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'author' => $article->user
        ];
    }
}