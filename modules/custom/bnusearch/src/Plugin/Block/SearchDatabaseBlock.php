<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchDatabase' block.
 *
 * @Block(
 *   id = "search_database_block",
 *   admin_label = @Translation("Search Database Block")
 * )
 */
class SearchDatabaseBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchDatabaseForm');
    return $form;
  }
 
}
