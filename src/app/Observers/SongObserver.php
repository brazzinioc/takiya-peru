<?php

namespace App\Observers;

use App\Song;
use Illuminate\Support\Facades\Storage;

class SongObserver
{
    /**
     * Handle the song "created" event.
     *
     * @param  \App\Song  $song
     * @return void
     */
    public function created(Song $song)
    {
        //
    }

    /**
     * Handle the song "updated" event.
     *
     * @param  \App\Song  $song
     * @return void
     */
    public function updated(Song $song)
    {
        //
    }

    /**
     * Handle the song "deleted" event.
     *
     * @param  \App\Song  $song
     * @return void
     */
    public function deleted(Song $song)
    {
        if( ! is_null($song->image) ){
            Storage::disk('s3')->delete($song->image);
            $song->image = NULL;
            $song->save();
        }

    }

    /**
     * Handle the song "restored" event.
     *
     * @param  \App\Song  $song
     * @return void
     */
    public function restored(Song $song)
    {
        //
    }

    /**
     * Handle the song "force deleted" event.
     *
     * @param  \App\Song  $song
     * @return void
     */
    public function forceDeleted(Song $song)
    {
        //
    }
}
