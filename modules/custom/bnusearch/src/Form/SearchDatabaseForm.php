<?php

namespace Drupal\bnusearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SearchDatabaseForm extends FormBase {

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
   
   
   $form['actions'] = [
     '#type' => 'actions',
   ]; 
   $form['actions']['submit'] = [
     '#type' => 'submit',
     '#value' => $this->t('Submit'),
     '#description' => $this->t('Submit, #type = submit'),
   ];
   return $form; 
}
 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'search_Database_form';
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) {
        $value = array_filter($value);
      }

      // Only display for controls that have titles and values.
      if ($value && $label) {
        $display_value = is_array($value) ? preg_replace('/[\n\r\s]+/', ' ', print_r($value, 1)) : $value;
        $message = $this->t('Value for %title: %value', array('%title' => $label, '%value' => $display_value));
        drupal_set_message($message);
      }
    }
 }

}
