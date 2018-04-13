<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchEJournal' block.
 *
 * @Block(
 *   id = "search_ejournal_block",
 *   admin_label = @Translation("Search EJournal Block")
 * )
 */
class SearchEJournalBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $form = \Drupal::formBuilder()->getForm('Drupal\bnusearch\Form\SearchEJournalForm');
    return $form;
  }
 
}
