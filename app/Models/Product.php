<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';

    
    public function categoryName()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'product_category_id');
    }

    public function documentName()
    {
        return $this->hasOne('App\Models\Documents', 'entity_id', 'id');
    }
}
