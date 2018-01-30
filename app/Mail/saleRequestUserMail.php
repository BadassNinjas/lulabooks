<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class saleRequestUserMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('info@lulabooks.mobi','Lulabooks')
      ->subject('Lulabooks Sale Request Captured') 
      ->view('email.salesrequestuser')
      ->with('name', $this->name);
    }
}
