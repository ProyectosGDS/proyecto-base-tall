<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Profile extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'role_id',
        'menu_id',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
