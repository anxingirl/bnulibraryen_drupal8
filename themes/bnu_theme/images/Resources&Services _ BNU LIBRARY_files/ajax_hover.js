/**
 * @file
 * Provides Ajax page updating via jQuery $.ajax.
 *
 * Ajax is a method of making a request via JavaScript while viewing an HTML
 * page. The request returns an array of commands encoded in JSON, which is
 * then executed to make any changes that are necessary to the page.
 *
 * Drupal uses this file to enhance form elements with `#ajax['url']` and
 * `#ajax['wrapper']` properties. If set, this file will automatically be
 * included to provide Ajax capabilities.
 */

(function ($, window, Drupal, drupalSettings) {

  'use strict';

  /**
   * Attaches the Ajax behavior to each Ajax form element.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Initialize all {@link Drupal.Ajax} objects declared in
   *   `drupalSettings.ajax` or initialize {@link Drupal.Ajax} objects from
   *   DOM elements having the `use-ajax-submit` or `use-ajax` css class.
   * @prop {Drupal~behaviorDetach} detach
   *   During `unload` remove all {@link Drupal.Ajax} objects related to
   *   the removed content.
   */
  Drupal.behaviors.linkAJAX = {
    attach: function (context, settings) {
   /* 
       var ajaxSettings = {
       url: 'my/url/path',
       base: 'myBase',
       element: $(context).find('.someElement')
     };

     var myAjaxObject = Drupal.ajax(ajaxSettings);

     // Declare a new Ajax command specifically for this Ajax object.
     myAjaxObject.commands.insert = function (ajax, response, status) {
     $('#my-wrapper').append(response.data);
        alert('New content was appended to #my-wrapper');
      };
     
      // This command will remove this Ajax object from the page.
     myAjaxObject.commands.destroyObject = function (ajax, response, status) {
       Drupal.ajax.instances[this.instanceIndex] = null;
     };
     myAjaxObject.execute();
*/
     // Bind Ajax behaviors to all items showing the class.
     $('.use-ajax-hover').once('ajax').each(function () {
        var element_settings = {};
        // Override the default progress set, which is throbber.
        element_settings.progress = {type: '', message: ''};

        // For anchor tags, these will go to the target of the anchor rather
        // than the usual location.
        var href = $(this).attr('href');
        if (href) {
          element_settings.url = href;
          element_settings.event = 'mouseover';
        }
        element_settings.dialogType = $(this).data('dialog-type');
        element_settings.dialog = $(this).data('dialog-options');
        element_settings.base = $(this).attr('id');
        element_settings.element = this;
        var mouseinAjaxObject =  Drupal.ajax(element_settings);
       //override the default insrt command.
       //重写默认的insert方法，先检查页面中是否有相应的数据，如果没有则插入，有则设置为显示 
       mouseinAjaxObject.commands.insert = function (ajax, response, status) {
        var response_data=eval("("+response.data+")");
        //var response_data = eval(response.data);
         
        //if there is already a '#wechat_pic' dom, then show this Dom.
        //there is no dom '#wechat_pic', insert the dom . 
        var node = $("#"+response_data.id);
        if(node.length>0){ 
          node.show();
        }else {
         $("<img id='"+response_data.id+"' src='"+response_data.content+"'></img>").appendTo($(response.selector)); 
       //   $("<div id='"+response_data.id+"'>"+response_data.content+"</div>").appendTo($(response.selector));
        }
        //$node.size() ? $node.hide() : $node.appendTo(response.selector);
        
       };
       if (href) {
         element_settings.url = href +'/mouseout';
         element_settings.event = 'mouseout';
       } 
        element_settings.dialogType = $(this).data('dialog-type');
        element_settings.dialog = $(this).data('dialog-options');
        element_settings.base = $(this).attr('id');
        element_settings.element = this;
        var mouseoutAjaxObject = Drupal.ajax(element_settings);
        
      });
    },
  }
})(jQuery, window, Drupal, drupalSettings);
