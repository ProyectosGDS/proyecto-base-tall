<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class UserInformation extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'cui',
        'phone',
        'birthday',
        'city',
        'address',
        'email',
        'gender',
        'user_id',
    ];

    protected $appends = [
        'full_name',
        'small_name',
        'url_photo',
    ];


    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getUrlPhotoAttribute() {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    public function getSmallNameAttribute() {

        $full_name = preg_replace('/\s+/', ' ', trim($this->first_name . ' ' . $this->last_name));
        $name_parts = explode(" ", $full_name);

        if (count($name_parts) < 2) {
            return $full_name;
        }

        $first_name = $name_parts[0];
        $prepositions = ['de', 'del', 'la', 'los', 'las'];
        $last_name_parts = [];
        $total_parts = count($name_parts);

        for ($i = 1; $i < $total_parts; $i++) {
            $current_part = $name_parts[$i];
            $current_part_lower = strtolower($current_part);

            if (in_array($current_part_lower, $prepositions)) {
                $last_name_parts[] = $current_part;
                continue;
            }

            $last_name_parts[] = $current_part;
            break; 
        }

        if (empty($last_name_parts)) {
            return $first_name;
        }

        $first_last_name = implode(' ', $last_name_parts);
        
        return $first_name . ' ' . $first_last_name;
    }
    
    public function getProfileNameAttribute() {
        return $this->user->profile_name;
    }
}
