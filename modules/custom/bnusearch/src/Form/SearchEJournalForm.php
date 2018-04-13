<?php

namespace Drupal\bnusearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

class SearchEJournalForm extends FormBase {

  /**
   * {@inheritdoc}
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {
  
    // CheckBoxes.
    $form['searchfield'] = [
      '#type' => 'textfield',
      '#size' => 60,
      '#maxlength' => 128,
   ]; 
   
    $form['submit'] =[
      '#type' => 'submit',
      '#value' => t('Search'),
      '#executes_submit_callback' => TRUE,
    ];
    /*
   * See \Drupal\Core\Utility\LinkGeneratorInterface.
   * * @code
   * $link_generator = \Drupal::service('link_generator');
   * $installer_url = \Drupal\Core\Url::fromUri('base://core/install.php');
   * $installer_link = $link_generator->generate($text, $installer_url);
   * $external_url = \Drupal\Core\Url::fromUri('http://example.com', ['query' => ['foo' => 'bar']]);
   * $external_link = $link_generator->generate($text, $external_url);
   * $internal_url = \Drupal\Core\Url::fromRoute('system.admin');
   * $internal_link = $link_generator->generate($text, $internal_url);
   */
   $urls['sfx'] = \Drupal\Core\Url::fromUri('http://search.lib.bnu.edu.cn:9003/sfx_bnu/az');
   $urls['core'] = \Drupal\Core\Url::fromUri('http://coreej.cceu.org.cn/');
   
   $form['links'] = [
      '#theme' => 'links',
      '#attributes' => [
        'class' => [
        'links',
      ],
    ],
  '#links' => [
    [
      'title' => t('EJournal'),
      'url' => $urls['sfx'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
    [
      'title' => t('Core Journal'),
      'url' => $urls['core'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
  ],
];

   return $form; 
}
 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'search_EJournal_form';
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    $searchfield =  array_key_exists('searchfield', $values) ? trim($values['searchfield']) : '';
    //http://www.lib.bnu.edu.cn/searchtabs/sfx?param_pattern_value=s%3Dio%26type%3D0%26lang%3D0
    //http://www.lib.bnu.edu.cn/searchtabs/sfx?param_pattern_value=s=android&type=0&lang=0
    $path = 'http://www.lib.bnu.edu.cn/searchtabs/sfx?param_pattern_value=s='.$searchfield.'&type=0&lang=0';
    $form_state->setResponse(new TrustedRedirectResponse($path, 302));
 }

}
