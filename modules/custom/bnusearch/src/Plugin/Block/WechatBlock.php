<?php

namespace Drupal\bnusearch\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Block\BlockBase;
use Drupal\Component\Serialization\Json;

/**
 * Provides a 'Wechat' block.
 *
 * @Block(
 *   id = "wechat_block",
 *   admin_label = @Translation("Wechat Block")
 * )
 */
class WechatBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $list['wechat_link'] = array(
      '#type' => 'link',
      '#title' => '',
      //'#url' => Url::fromRoute('<front>'), 
      '#url' => Url::fromUri('internal:/bnusearch/wechat/nojs'), 
      '#attributes' => array(
          'class' => array('use-ajax-hover bnusearch_icon_link bnusearch_wechat_link'),
      ),
  );
   
    $list['weibo_link'] = array(
      '#type' => 'link',
      '#title' => '',
      '#url' => Url::fromUri('internal:/bnusearch/weibo/nojs'), 
      '#attributes' => array(
          'class' => array('use-ajax-hover bnusearch_icon_link bnusearch_weibo_link'),
      ),
  );
    $list['phone_link'] = array(
      '#type' => 'link',
      '#title' => '',
      /*
      '#title' => array(
         '#type' => 'html_tag',
         '#tag' => 'img',
         '#attributes' => array(
            'src'=>'http://avatar.csdn.net/9/2/1/1_u010363836.jpg', 
            'title'=>t('QRcode'),
         ),
      ),
      */ 
      '#url' => Url::fromUri('internal:/bnusearch/phone/nojs'), 
      '#attributes' => array(
          'class' => array('use-ajax-hover bnusearch_icon_link bnusearch_phone_link'),
      ),
  );
   
  $build['list'] = array(
   
     '#theme' => 'item_list',
     '#items' => $list,
     '#list_type' => 'ul',
   );
  $current_url = Url::fromRoute('<current>');
  $build['icon'] = array(
      
      '#markup'=>'<div id="wechat_icon"></div>',
    );
  $build['#attached']['library'][] = 'bnusearch/ajaxhover';

  return $build;
  }
}
