<?php
if (!defined('__TYPECHO_ROOT_DIR__')) 
	exit;

/**
 * 图片懒加载
 * 
 * @package LazyLoad
 * @author 八云酱
 * @version 1.0.0
 * @link https://www.bayun.org
 */

class LazyLoad_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){
		Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */    
    public static function deactivate(){
    	/*八云酱*/
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){

    	$jquery = new Typecho_Widget_Helper_Form_Element_Radio('jquery', array(
            0   =>  _t('没有'),
            1   =>  _t('有')
        ), 0, _t('主题有没有jQuery.js'), _t('功能实现需要 <b>jQuery.js</b> 支持，如果主题中已经自带切勿重复引用。'));
        $form->addInput($jquery->addRule('enum', _t('必选项'), array(0, 1)));
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */   
    public static function personalConfig(Typecho_Widget_Helper_Form $form){
    	/*八云酱*/
    }

    /**
     * 
     * 功能实现需要 jQuery.js 支持
     * @return void
     */
    public static function footer() {
        if (!Helper::options()->plugin('LazyLoad')->jquery) {
            echo '<script src="https://upcdn.b0.upaiyun.com/libs/jquery/jquery-2.0.0.min.js"></script>';
        }      
        $LazyLoadJS = Helper::options()->pluginUrl . '/LazyLoad/lazy.js';
     	echo '<script src="'.$LazyLoadJS.'"></script>'; 
     	echo '<script>$("header").lazyload();$("img").lazyload();</script>';     	
    }
}