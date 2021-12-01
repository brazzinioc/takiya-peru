<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Author extends Model
{

    use SoftDeletes;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_lastname', 'slug', 'biography', 'birth', 'facebook', 'youtube', 'instagram',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_lastname',
                'onUpdate' => true,
            ]
        ];
    }

    //ACCESORS
    public function getGetFacebookAttribute(){
        return "https://facebook.com/" . $this->facebook;
    }

    public function getGetYoutubeAttribute(){
        return "https://youtube.com/channel/" . $this->youtube;
    }

    public function getGetInstagramAttribute(){
        return "https://instagram.com/" . $this->instagram;
    }


    //Relationships
    public function songs(){ //un autor posee muchas canciones.
        return $this->hasMany(Song::class, 'id_author');
    }
}
