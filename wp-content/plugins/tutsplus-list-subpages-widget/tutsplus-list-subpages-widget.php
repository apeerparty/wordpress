<?php 
/*Plugin Name: 自制小工具
Description: 注意作者
Version: 0.1
Author: Xianggui Xie
Author URI: http://apeerparty.com
License: GPLv2
*/
?>

<?php
class Tutsplus_List_Pages_Widget extends WP_Widget {
 
	// __construct 函数会完成你所期望的——它会构造一个函数。在这个函数里面你可以做出一些定义，比如WordPress小工具的ID、标题和说明。
    function __construct() {
		parent::__construct(

			// WordPress小工具的唯一ID
			'tutsplus_list_pages_widget',

			// WordPress小工具在其界面上的名称
			__('推荐 文字上移效果' ),

			// 一系列在WordPress小工具界面显示的选项，包括选项说明。
			array (
				'description' => __( '默认显示文字鼠标悬浮时文字上移' )
			)

		);
    }
 
	// form函数会在WordPress小工具界面创建表单，让用户来定制或者激活它。
    function form( $instance ) {
    }
 
	// update函数确保WordPress能及时更新用户在WordPress小工具界面输入的任何设置。
    function update( $new_instance, $old_instance ) {       
    }
 
	// widget函数则定义了在网站前端通过WordPress小工具输出的内容。
    function widget( $args, $instance ) {
 
    }
 
}
?>

<?php
function tutsplus_register_list_pages_widget() {
 
    register_widget( 'Tutsplus_List_Pages_Widget' );
 
}
add_action( 'widgets_init', 'tutsplus_register_list_pages_widget' );
?>