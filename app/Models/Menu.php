<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function pages() {
        return $this->belongsToMany(Page::class,'pages_menu');
    }

}
