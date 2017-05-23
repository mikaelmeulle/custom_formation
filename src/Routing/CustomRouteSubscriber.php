<?php
/**
 * @file
 * Contains \Drupal\custom_formation\Routing\RouteSubscriber.
 */

namespace Drupal\custom_formation\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class CustomRouteSubscriber extends RouteSubscriberBase {
  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('user.login')) {
      $route->setPath('/login');
    }
    if ($route = $collection->get('help.main')) {
        $route->setRequirement('_access', 'FALSE');
    }

    if($route = $collection->get('entity.group_content.group_node_relate_page')) {
        $route->setRequirement('_role', 'administrator');
    }

    if($route = $collection->get('entity.group_content.group_node_add_page')) {
        $route->setDefault('_title', 'Create content');
    }
  }
}
