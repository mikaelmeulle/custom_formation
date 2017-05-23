<?php

namespace Drupal\custom_formation\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BlockSimple' block.
 *
 * @Block(
 *  id = "custom_formation_block_simple",
 *  admin_label = @Translation("Block simple"),
 * )
 */
class BlockSimple extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['custom_formation_block_simple']['#markup'] = 'Implement BlockSimple.';

    return $build;
  }

}
