<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
//    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class, 'id_cities');
    }

    protected $fillable = [
        'name',
        'surname',
        'date_birth',

        'email',

        'id_instruments',
        'id_cities',
        'id_bands',


        'sex',
        'pictures',
        'comment',
        'deactivated',
        'deleted',

        'created_at',
        'updated_at'

    ];


}
