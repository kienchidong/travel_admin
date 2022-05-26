<?php

namespace App\Http\Resources\ProductCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $next_page = 0;
        if ($this->currentPage() < $this->lastPage()) {
            $next_page = $this->currentPage() + 1;
        }
        return [
            'lists' => ProductCategoryResource::collection($this->collection),
            'next_page'=>$next_page,
            'total_page' => $this->lastPage()
        ];
    }
}
