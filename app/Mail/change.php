<?php

namespace App\Mail;
use App\Models\posts;
use App\Models\Review;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class change extends Mailable
{
    use Queueable, SerializesModels;

    private $link;


    /**
     * Create a new message instance.
     *
     * @param $link
     */
    public function __construct($link)
    {

        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mail.change')
            ->with([
                'link' => $this->link
            ]);
    }
}
