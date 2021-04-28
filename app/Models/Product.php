<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductCategory;
use App\Models\Category;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $appends = array('categories');
    protected $fillable = ['product_code','name','image'];
    public function getCategoriesAttribute()
	{
        $ids = ProductCategory::where('product_id',$this->id)->pluck('category_id')->toArray();
        $categories = Category::whereIn('id',$ids)->pluck('name')->toArray();
		return implode(',',$categories);
	}
}