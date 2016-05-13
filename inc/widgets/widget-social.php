<?php

/**
 * Social  Widget
 * onepageshop Theme
 */
class onepageshop_social_widget extends WP_Widget
{
    function onepageshop_social_widget(){

       $widget_ops = array('classname' => 'onepageshop-social','description' => esc_html__( "onepageshop Social Widget" ,'onepageshop') );
       parent::__construct('onepageshop-social', esc_html__('onepageshop Social Widget','onepageshop'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'onepageshop');

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */ ?>

        <!-- social icons -->
        <div class="social-icons sticky-sidebar-social">

            <?php onepageshop_social_icons(); ?>

        </div><!-- end social icons --><?php

        echo $after_widget;
    }

    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'onepageshop'); ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','onepageshop') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p><?php
    }

}
?>