<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'area_id',
    ];

    public function dependency(){
        return $this->belongsTo(Area::class, 'area_id');
    }
}
