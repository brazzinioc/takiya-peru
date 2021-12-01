<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Song extends Model
{

    use SoftDeletes;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'lyrics_que', 'lyrics_spn', 'lyrics_eng', 'image', 'iframe', 'id_genre', 'id_author', 'id_writer',
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
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    //Accesor
    function getGetImageAttribute()
    {
        $image = NULL;

        if( is_null( $this->image ) ){
            $image = "songs/Takiya.webp";
        } else {
            $pieces = explode(".", $this->image);
            $image = $pieces[0] . ".webp";
        }

        return $image;
    }

    //Relationships
    public function genre(){
        return $this->belongsTo(MusicGenre::class, 'id_genre');
    }

    public function author(){
        return $this->belongsTo(Author::class, 'id_author');
    }

    public function writer(){
        return $this->belongsTo(User::class, 'id_writer');
    }
}
