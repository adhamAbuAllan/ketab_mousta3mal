<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'price'=>$this->price,
            'count_of_reads'=>$this->count_of_reads,
            'count_of_pages'=>$this->count_of_pages,
            'title'=>$this->title,
            'author'=>$this->author,
            'description'=>$this->description,
            'about_author'=>$this->about_author,
            'active'=>$this->active,
            'category_id' => $this->category,
            'photos' => $this->photo,


        ];
    }
}
