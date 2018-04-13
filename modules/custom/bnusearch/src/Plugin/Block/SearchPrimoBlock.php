<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchPrimo' block.
 *
 * @Block(
 *   id = "search_primo_block",
 *   admin_label = @Translation("Search Primo Block")
 * )
 */
class SearchPrimoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchPrimoForm');
    return $form;
  }
 
}
