<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSignupEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view($this->data['viewTemplate'])->with($this->data)->subject($this->data['subjectLine']);
        if (isset($this->data['attachments'])) {
            foreach($this->data['attachments'] as $attach) {
                $filePath = storage_path().$attach->path.'/'.$attach->file_name;
                $mail->attach($filePath);
            }
        }
        return $mail; 
    }
}
