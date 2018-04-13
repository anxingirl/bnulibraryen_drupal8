<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchHolding' block.
 *
 * @Block(
 *   id = "search_holding_block",
 *   admin_label = @Translation("Search Holding Block")
 * )
 */
class SearchHoldingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchHoldingForm');
    return $form;
  }
 
}
