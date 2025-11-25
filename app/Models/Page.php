<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'label',
        'icon',
        'route',
        'order',
        'state',
        'page_id',
        'type',
    ];

    protected $appends = ['active'];

    public function parent() {
        return $this->belongsTo(Page::class,'page_id');
    }

    public function childrens() {
        return $this->hasMany(Page::class,'page_id');
    }

    public function menu() {
        return $this->belongsToMany(Menu::class,'pages_menu');
    }

    public function getActiveAttribute() {
        return false;
    }

}
