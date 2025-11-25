<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public const DEFAULTPASS = 'password';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cui',
        'password',
        'profile_id',
        'area_id',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sessions() {
        return $this->hasMany(Session::class);
    }

    public function profile() : BelongsTo {
        return $this->belongsTo(Profile::class);
    }

    public function user_type() : BelongsTo {
        return $this->belongsTo(UserType::class);
    }

    public function area() : BelongsTo {
        return $this->belongsTo(Area::class);
    }

    public function information() : HasOne {
        return $this->hasOne(UserInformation::class);
    }

    public function getProfileNameAttribute() {
        return $this->profile->name ?? null;
    }

    public function getPermissionsAttribute() {

        $permissions = [];

        if ($this->profile && $this->profile->role) {
            foreach ($this->profile->role->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }

    public function getMenuAttribute() {
        if ($this->profile->menu && $this->profile->menu->pages) {
            $pages = $this->profile->menu->pages->load('parent');
            $pagesGroup = $pages->groupBy('page_id');
            
            $menu = collect();
            $childrens = collect();

            foreach ($pagesGroup as $group) {
                foreach ($group as $children) {
                    if ($children->parent) {
                        $menu->push($children->parent);
                    } else {
                        $menu->push($children);
                    }
                    unset($children->parent, $children->pivot);
                    $childrens->push($children);
                }
            }
            $menu = $menu->unique('id');
            $menu->each(function ($parent) use ($childrens) {
                $parent->childrens = $childrens->where('page_id', $parent->id)->sortBy('order')->values();
            });
        }
        return $menu->sortBy('order')->values()->all();
    }

    public function getSmallNameAttribute() {
        return $this->information?->small_name;
    }

    public function getUrlPhotoAttribute() {
        return $this->information?->url_photo ?? null;
    }

}
