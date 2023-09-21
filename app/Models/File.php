<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile_image()
    {
        return $this->morphedByMany(
            Profile::class,
            'fileable',
            'fileables',
            'file_id',
            'fileable_id',
            'id',
        );
    }
}
