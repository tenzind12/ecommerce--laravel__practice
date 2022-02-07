<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    // model Category has one User linked [one to one] 
    // Eloquent method to link
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
