<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'author' => $this->author,
            'can' => $this->permissions(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Returns the permissions of the resource.
     *
     * @return array
     */
    protected function permissions()
    {
        return [
            'update' => Gate::allows('update', $this->resource),
            'delete' => Gate::allows('delete', $this->resource),
        ];
    }
}
