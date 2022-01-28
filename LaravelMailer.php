<?php
namespace App\LaravelMailer;

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
	
	/* 
	*	@param $data - Data to be stiched to the view, 
	*	@param $view - Laravel blade view, 
	*	@param $senderEmail - Optional sender email address, 
	*	@param $senderName - Optional sender name
	*	@return void
	*/
	
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
	
	
	/* 
	*	@param $receiver - Receiver's email address, 
	*	@param $data - Data to be stiched to the view, 
	*	@param $view - Laravel blade view, 
	*	@param $senderEmail - Optional sender email address, 
	*	@param $senderName - Optional sender name
	*	@return void
	*/
	
	public static function postMail($receiver, $data, $view, $senderEmail ='', $senderName ='' ){	
		$mailer = new self($data, $view, $senderEmail ='', $senderName ='' );
		Mail::to($receiver)->send($mailer);
	}
	
}