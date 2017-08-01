<?php
/**
 * @file
 * Contains \Drupal\custom_formation\EventSubscriber\MyCustomEventSubscriber.
 */
namespace Drupal\custom_formation\EventSubscriber;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\custom_formation\CustomEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * Class MyCustomEventSubscriber.
 *
 * @package Drupal\custom_formation\EventSubscriber
 */
class MyCustomEventSubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ConfigEvents::SAVE][] = array('onSavingConfig', 800);
    $events[CustomEvent::SUBMIT][] = array('doSomeAction', 800);
    return $events;
  }
  /**
   * Subscriber Callback for the event.
   * @param CustomEvent $event
   */
  public function doSomeAction(CustomEvent $event) {
    \Drupal::logger("custom_formation")->info("evenement recu: ".$event->getCustomProperty());
  }
  /**
   * Subscriber Callback for the event.
   * @param ConfigCrudEvent $event
   */
  public function onSavingConfig(ConfigCrudEvent $event) {
    drupal_set_message("You have saved a configuration of " . $event->getConfig()->getName());
  }
}
