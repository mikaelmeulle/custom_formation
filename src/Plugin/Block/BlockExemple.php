<?php

namespace Drupal\custom_formation\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'BlockExemple' block.
 *
 * @Block(
 *  id = "custom_formation_block_exemple",
 *  admin_label = @Translation("Block exemple"),
 * )
 */
class BlockExemple extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;
 

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory; 

  /**
   * Constructs a new BlockExemple object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Session\AccountProxy $current_user
   *   The current user
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        AccountProxy $current_user,
        ConfigFactoryInterface $config_factory
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;	
    $this->configFactory = $config_factory;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
     return 3600;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return \Drupal\Core\Cache\Cache::mergeContexts(parent::getCacheContexts(), ['user']);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $display_name = ($this->currentUser->id() >= 1) ? $this->currentUser->getDisplayName() : '';
    $display_method = $this->configuration['method'];
    switch($display_method) {
         case 'template':
		 $build['custom_formation_block_exemple']= [
			 '#theme' => 'custom_formation_hello',
			 '#user_name' => $display_name,
			 ];
		 break;

	 case 'advanced':
		 $message_element = [ '#theme' => 'custom_formation_hello', '#user_name' => $display_name ];
		 $message = drupal_render( $message_element );
		 \Drupal::logger('custom_formation')->info("message = ".$message);
		 $build['custom_formation_block_exemple']= [
			'#attached' => [
				'library' => ['custom_formation/opentip-drupal'],
				'drupalSettings' => [
					'custom_formation' => [
						'opentip' => [
							['elementSelector' => '.page-header','message' => $message  ]
						]
					]
				]
			]
		 ];
		 break;
	 case 'markup':
	 default:
		 $message = t("Hello @display_name",['@display_name'=>  $display_name]);
		 $build['custom_formation_block_exemple']= [
			 '#markup' => $message,
			 '#allowed_tags' => [],
			 ];
		 break;

    }
    return $build;
  }

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


}
