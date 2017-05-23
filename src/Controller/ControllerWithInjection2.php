<?php

namespace Drupal\custom_formation\Controller;


use \Drupal\custom_formation\MonServiceInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface; 
use \Drupal\Core\Controller\ControllerBase;

/**
 * Class ControllerWithInjection2.
 *
 * @package Drupal\custom_formation\Controller
 */
class ControllerWithInjection2 extends ControllerBase {
	/**
	 * @var \Drupal\custom_formation\MonServiceInterface
	 */	
	protected $monService;

	/**
	 * Constructs a new ControllerWithInjection2 object.
	 *
	 * @param \Drupal\custom_formation\MonServiceInterface $mon_service
	 *   The greeting service
	 */
	public function __construct(MonServiceInterface $mon_service) {
		$this->monService = $mon_service;
	}
	public static function create(ContainerInterface $container) {
		$monService = $container->get('custom_formation.mon_service');
		return new static($monService);
	}
	public function methode() {
		$message = $this->monService->getGreetingMessage();
		return array('#markup' => $message);
	}
}
