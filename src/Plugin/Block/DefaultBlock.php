<?php

namespace Drupal\custom_formation\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DefaultBlock' block.
 *
 * @Block(
 *  id = "default_block",
 *  admin_label = @Translation("Default block"),
 * )
 */
class DefaultBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
         'method' => $this->t('markup'),
        ] + parent::defaultConfiguration();

 }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['method'] = [
      '#type' => 'select',
      '#title' => $this->t('Method'),
      '#description' => $this->t('Select method'),
      '#options' => ['markup' => $this->t('markup'), 'template' => $this->t('template'), 'advanced' => $this->t('advanced')],
      '#default_value' => $this->configuration['method'],
      '#size' => 3,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['method'] = $form_state->getValue('method');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['default_block_method']['#markup'] = '<p>' . $this->configuration['method'] . '</p>';

    return $build;
  }

}
