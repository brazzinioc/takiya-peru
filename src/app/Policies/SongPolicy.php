<?php

namespace App\Policies;

use App\{ User, Song };
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Validate Song writer (owner)
     * @param \app\User
     * @param \app\Song
     * @return bool
     */
    public function permit(User $user, Song $song){
        return $user->id == $song->id_writer;
    }
}
