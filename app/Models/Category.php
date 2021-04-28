<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['category_code','name','parent_category_id'];
    public function parent(){
        return $this->belongsTo('App\Models\Category','parent_category_id');
    }
    public function childs(){
        return $this->hasMany('App\Models\Category','parent_category_id');
    }
    // public static function boot() {
    //     parent::boot();
    //     static::deleting(function($category) {
    //          $category->childs()->delete();
    //     });
    // }
}