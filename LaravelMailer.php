<?php
namespace App\Helpers;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LaravelMailer extends Mailable
{
	use Queueable, SerializesModels;
	public $data 		= [];	
	public $senderEmail = '';
	public $senderName 	= '';
	public $view 		= '';
    public $subject 	= '';
	
	public function __construct($data, $view, $senderEmail ='', $senderName ='' )
    {
       	$this->data 		= $data;
        $this->senderEmail 	= $senderEmail != '' ? $senderEmail : config('mail.from.address');
        $this->senderName 	= $senderName != '' ? $senderName : config('mail.from.name');
        $this->view 		= $view;
        $this->subject 		= (!isset($data['subject']) or $data['subject'] =="") ? $this->subject : $data['subject'];
        
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from($this->senderEmail, $senderName)
					->subject($this->subject)
                    ->view($this->view);
    }
	
	
	public static function postMail($receiver, $data, $view, $senderEmail ='', $senderName ='' ){	
		$mailer = new self($data, $view, $senderEmail ='', $senderName ='' );
		Mail::to($receiver)->send($mailer);
	}
	
}