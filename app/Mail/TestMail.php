<?php

namespace WPSP\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable {

	use Queueable, SerializesModels;

	public string $messageBody;

	public function __construct(string $messageBody = '') {
		$this->messageBody = $messageBody;
	}

	public function build() {
		return $this->subject('Test From WPSP')
			->view('emails.test')
			->with(['messageBody' => $this->messageBody]);
	}

}
