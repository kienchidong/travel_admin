<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    //

    protected $table = 'products';

    protected $fillable = ['category_id', 'name', 'slug', 'image', 'image_details', 'describe', 'status'];
}
