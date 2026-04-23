<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model {
    protected $table = 'statistics';
    public $timestamps = false;
    protected $fillable = ['name', 'category_id', 'price', 'rating', 'created_at'];
}
