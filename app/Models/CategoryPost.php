<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post';
    protected $fillable = ['category_id', 'post_id']; //[1,2,5]
    public $timestamps = false;
    //there is no timestamps

    #To get the name of the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

#Many to Many

/*
[Post_id, Category_id]
    [1,1]
    [1,2]
    [1,3]
*/