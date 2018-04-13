<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchWebSearch' block.
 *
 * @Block(
 *   id = "search_websearch_block",
 *   admin_label = @Translation("Search Web Search Block")
 * )
 */
class SearchWebSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\WebResourceForm');
    return $form;
  }
 
}
