<?php

namespace Drupal\custom_formation\Controller;


use \Symfony\Component\DependencyInjection\ContainerInterface; 
use \Drupal\Core\Controller\ControllerBase;
use \Drupal\Core\Session\AccountProxy;

/**
 * Class ControllerWithInjection.
 *
 * @package Drupal\custom_formation\Controller
 */
class ControllerWithInjection extends ControllerBase {
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
	public static function create(ContainerInterface $container) {
		$currentUser = $container->get('current_user');
		return new static($currentUser);
	}
	public function methode() {
		$current_user_name = $this->currentUser->getDisplayNAme();
		return array('#markup' => t('Hello @username',array('@username' => $current_user_name)));
	}
}
