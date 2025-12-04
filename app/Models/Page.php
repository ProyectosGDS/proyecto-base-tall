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
        'permission_name'
    ];

    protected $appends = ['active'];

    public function parent() {
        return $this->belongsTo(Page::class,'page_id');
    }

    public function children() {
        return $this->hasMany(Page::class,'page_id');
    }

    public function getActiveAttribute() {
        return false;
    }

}
