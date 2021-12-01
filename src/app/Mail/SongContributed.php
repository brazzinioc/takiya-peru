<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SongContributed extends Mailable
{
    use Queueable, SerializesModels;

    private $songContributed;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($songContributed = [])
    {
        if(sizeof($songContributed) > 0){
            $this->songContributed = $songContributed;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.song-contributed', [
            "song" => $this->songContributed
        ]);
    }
}
