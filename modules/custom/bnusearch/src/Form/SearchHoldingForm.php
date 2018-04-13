<?php

namespace Drupal\bnusearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

class SearchHoldingForm extends FormBase {

  public function buildForm(array $form, FormStateInterface $form_state) {
    //select
    $form['key'] = [
      '#type' => 'select',
      //'#title' => $this->t('Holding Search'),
      '#options' => [
        'WRD' => $this->t('All Keys'),
        'WTI' => $this->t('Title Keys'),
        'WET' => $this->t('Title'),
        'WAU' => $this->t('Author'),
        'WSU' => $this->t('Keys'),
        'WPU' => $this->t('Publisher'),
        'ISS' => $this-> t('ISSN'),
        'WIS' => $this-> t('ISBN'),
        'CAL' => $this-> t('Index'),
        'CLC' => $this-> t('Class'),
      ],
    ];
    $form['searchfield'] = [
      '#type' => 'textfield',
      '#size' => 60,
      '#maxlength' => 128,
    ];
    $form['submit'] =[
     '#input' => TRUE,
     '#type' =>'button',
     '#value' => t('Search'),
     '#button_type' => 'submit',
    ];
    $form['submit'] =[
     '#type' =>'button',
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
   $urls['holding'] = \Drupal\Core\Url::fromUri('http://opac.lib.bnu.edu.cn:8080/F/');
   $urls['guji'] = \Drupal\Core\Url::fromUri('http://www.lib.bnu.edu.cn/content/%E5%8F%A4%E7%B1%8D%E7%9B%AE%E5%BD%95');
   $urls['tese'] = \Drupal\Core\Url::fromUri('http://www.lib.bnu.edu.cn/content/%E7%89%B9%E8%89%B2%E8%B5%84%E6%BA%90%E7%9B%AE%E5%BD%95');
 
   $form['links'] = [
      '#theme' => 'links',
      '#attributes' => [
        'class' => [
        'links',
      ],
    ],
  '#links' => [
    [
      'title' => t('Holding'),
      'url' => $urls['holding'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
    [
      'title' => t('Ancient'),
      'url' => $urls['guji'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
    [
      'title' => t('Special Collection'),
      'url' => $urls['tese'],
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
    return 'search_Holding_form';
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    $find_code =  array_key_exists('key', $values) ? trim($values['key']) : '';   
    $request = array_key_exists('searchfield', $values) ? trim($values['searchfield']) : '';
//dpm('Location:http://opac.lib.bnu.edu.cn:8080/F?func=find-m&find_code='.$form_state['values']['find_code'].'&request='.$form_state['values']['request']);
    $path = 'http://opac.lib.bnu.edu.cn:8080/F?func=find-m&find_code='.$find_code.'&request='.$request;
    $form_state->setResponse(new TrustedRedirectResponse($path, 302));

 }

}
