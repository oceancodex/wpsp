<?php

namespace WPSP\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use WPSP\Funcs;

class TestMail extends Mailable {

	use Queueable, SerializesModels;

	public string $messageBody;

	/*
	 *
	 */

	public function __construct(string $messageBody = '') {
		$this->messageBody = $messageBody;
	}

	/*
	 *
	 */

	public function build(): TestMail {
		return $this->from(Funcs::config('mail.from.address'), 'WordPress Starter Plugin')
			->subject('Email từ WPSP - WordPress Starter Plugin')
			->view('emails.welcome.content')
			->with([
				'messageBody' => $this->messageBody
			]);
	}

}
