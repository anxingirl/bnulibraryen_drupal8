<?php

namespace Drupal\bnusearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

class WebResourceForm extends FormBase {

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

   return $form; 
}
 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webresource_form';
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    //http://xueshu.baidu.com/s?wd=%E7%A7%AF%E6%9E%81
     $searchfield =  array_key_exists('searchfield', $values) ? trim($values['searchfield']) : '';
     $path = 'http://xueshu.baidu.com/s?wd='.$searchfield.'&type=0&lang=0';
    $form_state->setResponse(new TrustedRedirectResponse($path, 302));
 }

}

