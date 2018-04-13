<?php

namespace Drupal\bnusearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

class SearchPrimoForm extends FormBase {

  public function buildForm(array $form, FormStateInterface $form_state) {
    
        /*
 * http://www.lib.bnu.edu.cn/searchtabs/primo?
 * search_key=any&search_term=纳米
 * &search_scope=&tab=book_tab
 * &search_scope=book_scope&vl(177737365UI0)=
         * 
         * 
         * http://www.lib.bnu.edu.cn/searchtabs/primo?
         * search_key=title&search_term=纳米
         * &search_scope=&tab=article_tab
         * &search_scope=article_scope&vl(177737366UI0)=
         * 
         * 
         * http://www.lib.bnu.edu.cn/searchtabs/primo?
         * search_key=creator&search_term=纳米
         * &search_scope=&tab=dissertation_tab
         * &search_scope=dissertation_scope&vl(177737367UI0)=
         */
    //select
    
    $form['key'] = [
      '#type' => 'select',
      //'#title' => $this->t('Primo Search'),
      '#options' => [
        'All Field' => $this->t('All Field'),
        'Title' => $this->t('Title'),
        'Author' => $this->t('Author'),
      ],
    ];
    $form['searchfield'] = [
      '#type' => 'textfield',
      '#size' => 60,
      '#maxlength' => 128,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Search'),
      '#executes_submit_callback' => TRUE,
    ];
    /*
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] =[
     '#type' =>'submit',
     '#value' => t('Search'),
    ];
     * 
     */
    // Radios.
    $options = ['&tab=default_tab&search_scope=all_scope=' => $this->t('All Resources'), 
                '&tab=book_tab&search_scope=book_scope=' => $this->t('Book'),
                '&tab=article_tab&search_scope=article_scope=' => $this->t('Article'), 
                '&tab=dissertation_tab&search_scope=dissertation_scope=' => $this->t('Dissertation'), 
                '&tab=multimedia_tab&search_scope=multimedia_scope=' => $this->t('Multimedia'),
                '&tab=database_tab&search_scope=database_scope=' => $this->t('Database')];
    $form['scope'] = [
      '#type' => 'radios',
      '#title' => t('scope'),
      '#options' => $options,
     // '#description' => $this->t('Radios, #type = radios'),
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
   $urls['database'] = \Drupal\Core\Url::fromUri('http://202.112.82.7:8080/V');
   $urls['primo'] = \Drupal\Core\Url::fromUri('http://discovery.lib.bnu.edu.cn:8080/primo_library/libweb/action/search.do?mode=Basic&vid=bnu_v1');
   $urls['chaoxing'] = \Drupal\Core\Url::fromUri('http://ss.zhizhen.com/');
 
   $form['links'] = [
      '#theme' => 'links',
      '#attributes' => [
        'class' => [
        'links',
      ],
    ],
  '#links' => [
    [
      'title' => t('Database'),
      'url' => $urls['database'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
    [
      'title' => t('Primo'),
      'url' => $urls['primo'],
      'attributes' => [
        'class' => [
          'links__link',
        ],
      ],
    ],
    [
      'title' => t('Chaoxing'),
      'url' => $urls['chaoxing'],
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
    return 'search_primo_form';
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
   
    $search_key =  array_key_exists('key', $values) ? trim($values['key']) : '';
    $search_term = array_key_exists('searchfield', $values) ? trim($values['searchfield']) : '';
    $search_scope = array_key_exists('scope', $values) ? trim($values['scope']) : '';
    $path = 'http://202.112.82.125:1701/primo_library/libweb/action/dlSearch.do?institution=BNU&vid=bnu_v1'.$search_scope.'&query='.$search_key.',contains,'.$search_term;
    $form_state->setResponse(new TrustedRedirectResponse($path, 302));
    /*
 * http://www.lib.bnu.edu.cn/searchtabs/primo?
 * search_key=any&search_term=纳米
 * &search_scope=&tab=book_tab
 * &search_scope=book_scope&vl(177737365UI0)=
 * 
 * http://discovery.lib.bnu.edu.cn:8080/primo_library/libweb/action/search.do?
 * fn=search&ct=search&initialSearch=true&mode=Basic
 * &indx=1&dum=true&srt=rank&vid=bnu_v1&frbg=&tb=t
 * &vl(1UIStartWith0)=contains&tab=book_tab
 * &search_scope=book_scope&vl(177737365UI0)=any
 * &vl(freeText0)=纳米
 */
    
 }

}
