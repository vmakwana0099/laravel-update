<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use Redirect;

class SendMailable extends Mailable {

    use Queueable,
        SerializesModels;

    public $name;
    public $reset_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $reset_link, $Subject,$blade_file) {
        $this->name = $name;
        $this->reset_link = $reset_link;
        $this->subject = $Subject;
        $this->blade_file = $blade_file;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
     return  $this->view($this->blade_file)
                ->subject($this->subject);
       
    }

}
