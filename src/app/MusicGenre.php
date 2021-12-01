<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MusicGenre extends Model
{

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];



    //Relationships
    public function songs(){ //un género musical posee muchas canciones
        return $this->hasMany(Song::class, 'id_genre');
    }
}

