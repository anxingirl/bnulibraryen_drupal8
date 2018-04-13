<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Search' block.
 *
 * @Block(
 *   id = "search_block",
 *   admin_label = @Translation("Search Block")
 * )
 */
class SearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form1 = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchPrimoForm');
    //$form2 = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchHoldingForm');
    //return $form1;
    //return $form2;
    return $form1;
  }
 
}
