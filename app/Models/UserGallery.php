<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGallery extends Model
{
    use HasFactory;

    protected $table = 'user_galleries';

    protected $fillable = ['user_id', 'filename'];

    public function getFilenameAttribute($value){
        if ($value == NULL)
            return "";

        $value = str_replace('public/', '', $value);
        return url(config('constants.image.dir_path') . $value);
    }

}
