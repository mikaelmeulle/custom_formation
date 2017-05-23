<?php
namespace Drupal\custom_formation;

use Symfony\Component\EventDispatcher\Event;

class CustomEvent extends Event {
  const SUBMIT = 'event.custom_formation_event';
  protected $customProperty;
  public function __construct($customProperty) {
    $this->customProperty = $customProperty;
  }
  public function getCustomProperty() {
    return $this->customProperty;
  }
  public function myEventDescription() {
    return "Exemple d'evenement";
  }
}
