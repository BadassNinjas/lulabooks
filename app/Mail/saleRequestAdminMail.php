<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class saleRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $saleReq;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($saleReq)
    {
        $this->saleReq = $saleReq;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('info@lulabooks.mobi')
      ->cc('lux@lulabooks.mobi')
      ->subject('A User has just submitted a Sales Request on lulabooks website') 
      ->view('email.salesrequestadmin')
      ->with(['fullname' => $this->saleReq->firstname. " ".$this->saleReq->firstname,
      'email' => $this->saleReq->email,
      'phone' => $this->saleReq->phone,
      'book_name' => $this->saleReq->name,
      'book_isbn' => $this->saleReq->isbn,
      'book_grade' => $this->saleReq->grade,
      ]);
    }
}
