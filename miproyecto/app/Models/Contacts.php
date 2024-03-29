<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Contact model.
 * 
 */
class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "phone_number",
        "age",
        "email",
        "user_id",
        "profile_picture"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
