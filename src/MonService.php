<?php

namespace Drupal\custom_formation;

use \Drupal\custom_formation\MonServiceInterface;
use \Drupal\Core\Session\AccountProxy;

/**
 *  service "MonService"
 */
class MonService implements MonServiceInterface {
	/**
	 * Drupal\Core\Session\AccountProxy definition.
	 *
	 * @var \Drupal\Core\Session\AccountProxy
	 */	
	protected $currentUser;

	/**
	 * Constructs a new ControllerWithInjection object.
	 *
	 * @param \Drupal\Core\Session\AccountProxy $current_user
	 *   The current user
	 */
	public function __construct(AccountProxy $current_user) {
		$this->currentUser = $current_user;
	}

	/**
	 * get a greeting message
	 *
	 * @return string
	 *   A greeting message
	 */
	public function getGreetingMessage() {
		$user_name = $this->currentUser->getDisplayName();
		return t("Hello @username",array("@username" => $user_name));
	}
}
