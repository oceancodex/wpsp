<?php

namespace WPSP\app\Listeners;

use WPSP\app\Events\SettingsUpdatedEvent;
use WPSP\app\Events\UsersCreatedEvent;
use WPSP\Funcs;
use WPSPCORE\Events\Contracts\ListenerContract;
use WPSPCORE\HttpClient\HttpClient;

class NotifyTelegramListener implements ListenerContract {

	public function handle($event, $payload = []) {
		// Notify khi user được tạo
		if ($event instanceof UsersCreatedEvent || $event == 'users.created') {
//			$user = $event->user ?? $payload;

//			$botToken = Funcs::env('TELEGRAM_BOT_TOKEN') ?: (function_exists('get_option') ? (get_option('wpsp_telegram_bot_token') ?: '') : '');
//			$chatId   = Funcs::env('TELEGRAM_CHAT_ID') ?: (function_exists('get_option') ? (get_option('wpsp_telegram_chat_id') ?: '') : '');
//
//			if (!$botToken || !$chatId) {
//				error_log('[NotifyTelegramListener] Thiếu TELEGRAM_BOT_TOKEN hoặc TELEGRAM_CHAT_ID');
//				return null;
//			}
//
//			$now = function_exists('wp_date') ? wp_date('Y-m-d H:i:s') : date('Y-m-d H:i:s');
//
//			$name     = is_object($user) && isset($user->name) ? (string)$user->name : '';
//			$username = is_object($user) && isset($user->username) ? (string)$user->username : '';
//			$email    = is_object($user) && isset($user->email) ? (string)$user->email : '';
//			$id       = is_object($user) && isset($user->id) ? (string)$user->id : '';
//
//			$message = sprintf(
//				"✅ <b>New User Created</b>\n🆔 ID: <code>%s</code>\n👤 Name: <code>%s</code>\n👥 Username: <code>%s</code>\n📧 Email: <code>%s</code>\n🕑 Time: <code>%s</code>",
//				$id,
//				$name,
//				$username,
//				$email,
//				$now
//			);
//			$this->sendTelegramMessage($botToken, $chatId, $message);
			Funcs::notice('(UsersObserver) NotifyTelegramListener after user created! in: ' . __FILE__, 'info', true);
		}
		elseif ($event instanceof SettingsUpdatedEvent) {
			Funcs::notice('NotifyTelegramListener after setting updated! in: ' . __FILE__);
//			echo '<pre style="background:white;z-index:9999;position:relative">'; print_r('NotifyTelegramListener fired! in: ' . __FILE__); echo '</pre>';
		}

		return null;
	}

	public function shouldQueue(): bool {
		return false;
	}

	/*
	 *
	 */

	protected function sendTelegramMessage($botToken, $chatId, $message) {
		$client = HttpClient::createForBaseUri(
			"https://api.telegram.org/bot{$botToken}/",
			[
				'headers' => [
					'Accept' => 'application/json',
				],
				'timeout' => 8,
			]
		);

		try {
			$response = $client->request('POST', 'sendMessage', [
				'body' => [
					'chat_id'                  => $chatId,
					'text'                     => $message,
					'parse_mode'               => 'HTML',
					'disable_web_page_preview' => true,
				],
			]);

			$status = $response->getStatusCode();
			if ($status < 200 || $status >= 300) {
				$errorBody = $response->getContent(false);
				error_log('[NotifyTelegramListener] HTTP ' . $status . ' - ' . $errorBody);
			}
		}
		catch (\Throwable $e) {
			error_log('[NotifyTelegramListener] HttpClient error: ' . $e->getMessage());
		}
	}

}