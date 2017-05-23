<?php

namespace Drupal\custom_formation\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ControlleurExemple.
 *
 * @package Drupal\custom_formation\Controller
 */
class ControlleurExemple extends ControllerBase {

  /**
   * Exemple de Routes, cette methode retourne le contenu de la route.
   *
   * @return string
   *   Return contenu de la page correpondant à la route exemple.
   */
  public function routeSimple() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello Drupal training')
    ];
  }

}
