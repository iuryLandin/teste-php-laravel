<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
  protected $table = 'documents';
  protected $fillable = [
    'category_id',
    'title',
    'contents',
    'reference',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }
}
