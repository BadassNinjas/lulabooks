<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class orderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      return $this->from('info@lulabooks.mobi', 'info@lulabooks.mobi')
      ->cc('info@lulabooks.mobi','lulabooks admin')
      ->subject('Order placed')
      ->view('email.orderplaced')
      ->with('user', $this->user);
    }
}
