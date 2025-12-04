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

    public function user_type() : BelongsTo {
        return $this->belongsTo(UserType::class);
    }

    public function area() : BelongsTo {
        return $this->belongsTo(Area::class);
    }

    public function information() : HasOne {
        return $this->hasOne(UserInformation::class);
    }

    public function getRoleNameAttribute() {
        return $this->roles->pluck('name')->first();
    }

    public function getMenuAttribute() {
        $allowedPermissions = $this->getAllPermissions()
            ->where('module','menu')
            ->pluck('name')
            ->toArray();

        if (empty($allowedPermissions)) {
            return [];
        }

        $pages = Page::with(['parent', 'children'])
            ->where('state',true)
            ->orderBy('order')
            ->get();

        $allowedPages = $pages->filter(function ($page) use ($allowedPermissions) {
            return in_array($page->permission_name, $allowedPermissions);
        });

        // Preparar menú final
        $menu = collect();

         foreach ($allowedPages as $page) {

            // Si es hijo y tiene padre, solo agregamos el padre
            if ($page->parent) {
                $menu->push($page->parent);
            }

            // Si es padre sin padre, agregarlo
            if (!$page->parent) {
                $menu->push($page);
            }
        }

        // Únicos y ordenados
        $menu = $menu->unique('id')->sortBy('order')->values();

        // Adjuntar hijos permitidos a cada padre
        $menu->each(function ($parent) use ($allowedPages) {

            $parent->childrens = $allowedPages
                ->where('page_id', $parent->id)  // hijos del padre
                ->sortBy('order')
                ->values();
        });

        return $menu->values()->all();
    }

    public function getSmallNameAttribute() {
        return $this->information?->small_name;
    }

    public function getUrlPhotoAttribute() {
        return $this->information?->url_photo ?? null;
    }

}
