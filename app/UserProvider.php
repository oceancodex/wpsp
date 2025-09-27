<?php
namespace WPSP\app;

class UserProvider {
	protected $table = 'wp_users';

	public function retrieveById($id) {
		global $wpdb;
		return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table} WHERE id = %d", $id));
	}

	public function retrieveByCredentials($credentials) {
		global $wpdb;
		return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table} WHERE user_login = %s", $credentials['user_login']));
	}
}
