<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
//    use HasFactory;


    public function genres()
    {
        return $this->hasMany(Genre::class);
    }


    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',

        'comment',
        'pictures',

        'id_cities',
        'sex',
        'deactivated',
        'deleted',

        'created_at',
        'updated_at'
    ];


}
