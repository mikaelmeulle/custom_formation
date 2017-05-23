<?php

namespace Drupal\custom_formation\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure Custom formation settings for this site.
 */
class CustomFormationSettingsForm extends ConfigFormBase {

  /**
   * {@inheritDoc}
   */
  /*public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }
  */

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_formation_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_formation.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_formation.settings');

    $form['verbose'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Verbose'),
      '#default_value' => $config->get('verbose'),
      '#description' => $this->t('Display message in log'),
    );

    $form['basename'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Base name'),
      '#size' => 70,
      '#maxlength' => 255,
      '#default_value' => $config->get('basename'),
      '#description' => $this->t('Base name to be added in log messages'),
    );
    return parent::buildForm($form, $form_state);
  }

   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_formation.settings')
      ->set('basename', $form_state->getValue('basename'))
      ->set('verbose', $form_state->getValue('verbose'))
      ->save();
  
    parent::submitForm($form, $form_state);
  }
}
