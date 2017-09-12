<?php   
/*
Plugin Name:热门浏览  
Plugin URI:http://www.kutailang.com  
Description:热门浏览  
Version:1.0  
Author:树是我的朋友  
Author URI:http://www.kutailang.com  
*/  
//类   
class AshuPostViews extends WP_Widget{   
    function AshuPostViews(){   
        $widget_ops = array('classname'=>'widget_postviews','description'=>'按浏览量显示文章');   
        $this->WP_Widget(false,'热门浏览',$widget_ops);   
    }   
    //表单   
    function form($instance){   
        $instance = wp_parse_args((array)$instance,array(   
        'title'=>'热评文章','showPosts'=>10   
        ));   
        $title = htmlspecialchars($instance['title']);   
        $showPosts = htmlspecialchars($instance['showPosts']);   
        $output = '<table>';   
        $output .= '<tr><td>标题:</td><td>';   
        $output .= '<input id="'.$this->get_field_id('title') .'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" />';   
        $output .= '</td></tr><tr><td>文章数量：</td><td>';   
        $output .= '<input id="'.$this->get_field_id('showPosts') .'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$instance['showPosts'].'" />';   
        $output .= '</td></tr></table>';   
        echo $output;   
    }   
       
    function update($new_instance,$old_instance){   
        $instance = $old_instance;   
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));   
        $instance['showPosts'] = strip_tags(stripslashes($new_instance['showPosts']));   
        return $instance;   
    }   
       
    function widget($args,$instance){   
        extract($args);   
        $title = apply_filters('widget_title',emptyempty($instance['title']) ? '&nbsp;' : $instance['title']);   
        $showPosts = emptyempty($instance['showPosts']) ? 10 : $instance['showPosts'];   
        echo $before_widget;   
        echo $before_title . $title . $after_title;   
        echo '<ul>';   
            $this->ashu_get_hotpost($showPosts);   
        echo '</ul>';   
        echo $after_widget;   
    }   
    function ashu_get_hotpost($showposts){   
    global $wpdb;      
    $result = $wpdb->get_results("SELECT post_id,meta_key,meta_value,ID,post_title FROM $wpdb->postmeta key1 INNER JOIN $wpdb->posts key2 ON key1.post_id = key2.ID where key2.post_type='post' AND key2.post_status='publish' AND key1.meta_key='post_views_count' ORDER BY CAST(key1.meta_value AS SIGNED) DESC LIMIT 0 , $showposts");   
    $output = '';   
    foreach ($result as $post) {   
  
        $postid = $post->ID;      
        if( mb_strlen($post->post_title,"UTF-8")>18 ){   
            $title = strip_tags($post->post_title);   
            $short_title = trim(mb_substr($title ,0,14,"UTF-8"));   
            $short_title .= '...';   
        }else{   
            $short_title = $post->post_title;   
        }   
  
            $output .= '<li class=""><a href="' . get_permalink($postid) . '" title="' . $title .'">' . $short_title .'</a><br /> <span class="">'.$post->meta_value .'Views</span></li>';   
        $i++;   
    }      
    echo $output;      
    }     
}   
  
function AshuPostViews(){   
    register_widget('AshuPostViews');   
}   
add_action('widgets_init','AshuPostViews');   
?>