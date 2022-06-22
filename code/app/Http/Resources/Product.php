<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id'=> $this->id,  
                'category_id'=> $this->category_id,
                'name'=>$this->name, 
                'image'=>$this->image ? $this->image : " ",
                'category_name'=>$this->category ? $this->category->name : " ",
                'description'=>$this->description ? $this -> description : " - "

            ];
    }
}
