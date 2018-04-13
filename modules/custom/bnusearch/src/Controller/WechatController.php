<?php

namespace Drupal\bnusearch\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenDialogCommand;
use Drupal\Core\Ajax\InsertCommand;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Controller routines for page example routes.
 */
class WechatController extends ControllerBase {

  /*
   *返回不同的二维码的路径
   
   */
  public function qrcode($type) {
     $module_url = '/' . drupal_get_path('module', 'bnusearch');
     switch ($type)
    {
     case 'wechat':
       
     $module_url .= '/images/wechat_qr.png';
       break;
     case 'weibo':
     $module_url .= '/images/weibo_qr.png';
       break;
     default:
     $module_url .= '/images/phone_qr.png';
    }
 
    return $module_url;
  }

  /**
   * This callback is mapped to the path
   * 'bnusearch/wechat/{ajax}'.
   */
  public function arguments($ajax) {
      // Make sure you don't trust the URL to be safe! Always check for exploits.
    if (is_numeric($ajax)) {
      // We will just show a standard "access denied" page in this case.
      throw new AccessDeniedHttpException();
    }
    $list[] = $this->t("First number was @number.", array('@number' => $ajax));

    $render_array['page_example_arguments'] = array(
      // The theme function to apply to the #items.
      '#theme' => 'item_list',
      // The list itself.
      '#items' => $list,
      '#title' => $this->t('Argument Information'),
    );
    return $render_array;  
  }
  /**
   * This callback is mapped to the path
   * 'bnusearch/wechat/{ajax}'.
   */
  public function wechat($ajax) {
    
    // ... Other code ...
    $content = array('id'=>'wechat_pic', 'content'=>$this->qrcode('wechat'));
    $response = new AjaxResponse();
    
    //$response->addCommand(new OpenDialogCommand('#some-element', $title, $content, ['width' => '700']));
    $response->addCommand(new AppendCommand('#wechat_icon',json_encode($content)));
    return $response;
  }
  
  public function weibo($ajax) {
    // ... Other code ...
    $content = array('id'=>'weibo_pic', 'content'=>$this->qrcode('weibo') );
    $response = new AjaxResponse();
    
    //$response->addCommand(new OpenDialogCommand('#some-element', $title, $content, ['width' => '700']));
    $response->addCommand(new AppendCommand('#wechat_icon',json_encode($content)));
    return $response;
  }

  public function phone($ajax) {
    // ... Other code ...
    $content = array('id'=>'phone_pic', 'content'=>$this->qrcode('phone'));
    $response = new AjaxResponse();
    
    //$response->addCommand(new OpenDialogCommand('#some-element', $title, $content, ['width' => '700']));
    $response->addCommand(new AppendCommand('#wechat_icon',json_encode($content)));
    return $response;
  }

  public function delete($type, $ajax) {
    $response = new AjaxResponse();
   
    switch ($type)
    {
      case "wechat":
      $content = 'delete wechat';
      $response->addCommand(new InvokeCommand('#wechat_pic','hide' ));
      break;
      case "weibo":
      $content = 'delete weibo';
      $response->addCommand(new InvokeCommand('#weibo_pic','hide' ));
      break;
      case "phone":
      $content = 'delete phone';
      $response->addCommand(new InvokeCommand('#phone_pic','hide' ));
      break; 
    } 
   
    return $response;
  }
}
