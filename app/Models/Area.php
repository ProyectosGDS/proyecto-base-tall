<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'dependency_id',
        'active',
    ];

    public function dependency(){
        return $this->belongsTo(Dependency::class);
    }
}
