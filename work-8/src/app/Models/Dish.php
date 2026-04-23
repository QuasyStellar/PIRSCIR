<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model {
    protected $table = 'dishes';
    public $timestamps = false;
    protected $fillable = ['category_id', 'name', 'price'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
