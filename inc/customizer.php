<?php
/**
 * _s Theme Customizer
 *
 * @package onepageshop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepageshop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'onepageshop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function onepageshop_customize_preview_js() {
	wp_enqueue_script( 'onepageshop_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'onepageshop_customize_preview_js' );

/**
 * Options for onepageshop Theme Customizer.
 */
function onepageshop_customizer( $wp_customize ) {
    
    /* Main option Settings Panel */
    $wp_customize->add_panel('onepageshop_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('onepageshop Options', 'onepageshop'),
        'description' => __('Panel to update onepageshop theme options', 'onepageshop'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

        $wp_customize->add_section('onepageshop_layout_options', array(
            'title' => __('Layout options', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));
            // Layout options
            global $blog_layout;
            $wp_customize->add_setting('onepageshop[blog_settings]', array(
                 'default' => '1',
                 'type' => 'option',
                 'sanitize_callback' => 'onepageshop_sanitize_blog_layout'
            ));
            $wp_customize->add_control('onepageshop[blog_settings]', array(
                 'label' => __('Blog Layout', 'onepageshop'),
                 'section' => 'onepageshop_layout_options',
                 'type'    => 'select',
                 'choices'    => $blog_layout
            ));
            
            global $site_layout;
            $wp_customize->add_setting('onepageshop[site_layout]', array(
                 'default' => 'side-pull-left',
                 'type' => 'option',
                 'sanitize_callback' => 'onepageshop_sanitize_layout'
            ));
            $wp_customize->add_control('onepageshop[site_layout]', array(
                 'label' => __('Website Layout Options', 'onepageshop'),
                 'section' => 'onepageshop_layout_options',
                 'type'    => 'select',
                 'description' => __('Choose between different layout options to be used as default', 'onepageshop'),
                 'choices'    => $site_layout
            ));

            $wp_customize->add_setting('onepageshop[element_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[element_color]', array(
                'label' => __('Element Color', 'onepageshop'),
                'description'   => __('Default used if no color is selected','onepageshop'),
                'section' => 'onepageshop_layout_options',
                'settings' => 'onepageshop[element_color]',
            )));

            $wp_customize->add_setting('onepageshop[element_color_hover]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[element_color_hover]', array(
                'label' => __('Element color on hover', 'onepageshop'),
                'description'   => __('Default used if no color is selected','onepageshop'),
                'section' => 'onepageshop_layout_options',
                'settings' => 'onepageshop[element_color_hover]',
            )));

        /* onepageshop Typography Options */
        $wp_customize->add_section('onepageshop_typography_options', array(
            'title' => __('Typography', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));
            // Typography Defaults
            $typography_defaults = array(
                    'size'  => '14px',
                    'face'  => 'helvetica-neue',
                    'style' => 'normal',
                    'color' => '#6B6B6B'
            );
            // Typography Options
            global $typography_options;
            $wp_customize->add_setting('onepageshop[main_body_typography][size]', array(
                'default' => $typography_defaults['size'],
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_typo_size'
            ));
            $wp_customize->add_control('onepageshop[main_body_typography][size]', array(
                'label' => __('Main Body Text', 'onepageshop'),
                'description' => __('Used in p tags', 'onepageshop'),
                'section' => 'onepageshop_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['sizes']
            ));
            $wp_customize->add_setting('onepageshop[main_body_typography][face]', array(
                'default' => $typography_defaults['face'],
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_typo_face'
            ));
            $wp_customize->add_control('onepageshop[main_body_typography][face]', array(
                'section' => 'onepageshop_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['faces']
            ));
            $wp_customize->add_setting('onepageshop[main_body_typography][style]', array(
                'default' => $typography_defaults['style'],
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_typo_style'
            ));
            $wp_customize->add_control('onepageshop[main_body_typography][style]', array(
                'section' => 'onepageshop_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['styles']
            ));
            $wp_customize->add_setting('onepageshop[main_body_typography][color]', array(
                'default' => $typography_defaults['color'],
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[main_body_typography][color]', array(
                'section' => 'onepageshop_typography_options',
            )));

            $wp_customize->add_setting('onepageshop[heading_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[heading_color]', array(
                'label' => __('Heading Color', 'onepageshop'),
                'description'   => __('Color for all headings (h1-h6)','onepageshop'),
                'section' => 'onepageshop_typography_options',
            )));
            $wp_customize->add_setting('onepageshop[link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[link_color]', array(
                'label' => __('Link Color', 'onepageshop'),
                'description'   => __('Default used if no color is selected','onepageshop'),
                'section' => 'onepageshop_typography_options',
            )));
            $wp_customize->add_setting('onepageshop[link_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[link_hover_color]', array(
                'label' => __('Link:hover Color', 'onepageshop'),
                'description'   => __('Default used if no color is selected','onepageshop'),
                'section' => 'onepageshop_typography_options',
            )));
            
            $wp_customize->add_setting('onepageshop[social_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[social_color]', array(
                'label' => __('Social icon color', 'onepageshop'),
                'description' => sprintf(__('Default used if no color is selected', 'onepageshop')),
                'section' => 'onepageshop_typography_options',
            )));
            
            /* onepageshop Header Options */
        $wp_customize->add_section('onepageshop_header_options', array(
            'title' => __('Header', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));
            $wp_customize->add_setting('onepageshop[top_nav_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[top_nav_bg_color]', array(
                'label' => __('Top nav background color', 'onepageshop'),
                'description'   => __('Default used if no color is selected','onepageshop'),
                'section' => 'onepageshop_header_options',
            )));
            $wp_customize->add_setting('onepageshop[top_nav_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[top_nav_link_color]', array(
                'label' => __('Top nav item color', 'onepageshop'),
                'description'   => __('Link color','onepageshop'),
                'section' => 'onepageshop_header_options',
            )));

            $wp_customize->add_setting('onepageshop[top_nav_dropdown_bg]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[top_nav_dropdown_bg]', array(
                'label' => __('Top nav dropdown background color', 'onepageshop'),
                'description'   => __('Background of dropdown item hover color','onepageshop'),
                'section' => 'onepageshop_header_options',
            )));

            $wp_customize->add_setting('onepageshop[top_nav_dropdown_item]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[top_nav_dropdown_item]', array(
                'label' => __('Top nav dropdown item color', 'onepageshop'),
                'description'   => __('Dropdown item color','onepageshop'),
                'section' => 'onepageshop_header_options',
            )));

        /* onepageshop Footer Options */
        $wp_customize->add_section('onepageshop_footer_options', array(
            'title' => __('Footer', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));

            $wp_customize->add_setting('onepageshop[footer_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[footer_bg_color]', array(
                'label' => __('Footer background color', 'onepageshop'),
                'section' => 'onepageshop_footer_options',
            )));

            $wp_customize->add_setting('onepageshop[footer_text_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[footer_text_color]', array(
                'label' => __('Footer text color', 'onepageshop'),
                'section' => 'onepageshop_footer_options',
            )));

            $wp_customize->add_setting('onepageshop[footer_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'onepageshop[footer_link_color]', array(
                'label' => __('Footer link color', 'onepageshop'),
                'section' => 'onepageshop_footer_options',
            )));

            $wp_customize->add_setting('onepageshop[custom_footer_text]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('onepageshop[custom_footer_text]', array(
                'label' => __('Footer information', 'onepageshop'),
                'description' => sprintf(__('Copyright text in footer', 'onepageshop')),
                'section' => 'onepageshop_footer_options',
                'type' => 'textarea'
            ));

        /* onepageshop Content Options */
        $wp_customize->add_section('onepageshop_content_options', array(
            'title' => __('Content Options', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));
            $wp_customize->add_setting('onepageshop[single_post_image]', array(
                'default' => 1,
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('onepageshop[single_post_image]', array(
                'label' => __('Display Featured Image on Single Post', 'onepageshop'),
                'section' => 'onepageshop_content_options',
                'type' => 'checkbox'
            ));

        /* onepageshop Other Options */
        $wp_customize->add_section('onepageshop_other_options', array(
            'title' => __('Other', 'onepageshop'),
            'priority' => 31,
            'panel' => 'onepageshop_main_options'
        ));
            $wp_customize->add_setting('onepageshop[custom_css]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'onepageshop_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('onepageshop[custom_css]', array(
                'label' => __('Custom CSS', 'onepageshop'),
                'description' => sprintf(__('Additional CSS', 'onepageshop')),
                'section' => 'onepageshop_other_options',
                'type' => 'textarea'
            ));

        $wp_customize->add_section('onepageshop_important_links', array(
            'priority' => 5,
            'title' => __('Support and Documentation', 'onepageshop')
        ));
            $wp_customize->add_setting('onepageshop[imp_links]', array(
              'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control(
            new onepageshop_Important_Links(
            $wp_customize,
                'onepageshop[imp_links]', array(
                'section' => 'onepageshop_important_links',
                'type' => 'onepageshop-important-links'
            )));

}
add_action( 'customize_register', 'onepageshop_customizer' );



/**
 * Sanitize checkbox for WordPress customizer
 */
function onepageshop_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: colors
 * @package onepageshop
 */
function onepageshop_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package onepageshop
 */
function onepageshop_sanitize_nohtml($input) {
    return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package onepageshop
 */
function onepageshop_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package onepageshop
 */
function onepageshop_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package onepageshop
 */
function onepageshop_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package onepageshop
 */
function onepageshop_sanitize_blog_layout( $input ) {
    global $blog_layout;
    if ( array_key_exists( $input, $blog_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package onepageshop
 */
function onepageshop_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package onepageshop
 */
function onepageshop_sanitize_typo_size( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['sizes'] ) ) {
        return $input;
    } else {
        return $typography_defaults['size'];
    }
}
/**
 * Adds sanitization callback function: Typography Face
 * @package onepageshop
 */
function onepageshop_sanitize_typo_face( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['faces'] ) ) {
        return $input;
    } else {
        return $typography_defaults['face'];
    }
}
/**
 * Adds sanitization callback function: Typography Style
 * @package onepageshop
 */
function onepageshop_sanitize_typo_style( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['styles'] ) ) {
        return $input;
    } else {
        return $typography_defaults['style'];
    }
}

/**
 * Add CSS for custom controls
 */
function onepageshop_customizer_custom_control_css() {
	?>
    <style>
        #customize-control-onepageshop-main_body_typography-size select, #customize-control-onepageshop-main_body_typography-face select,#customize-control-onepageshop-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'onepageshop_customizer_custom_control_css' );

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a onepageshop important links
 */
class onepageshop_Important_Links extends WP_Customize_Control {

   public $type = "onepageshop-important-links";

   public function render_content() {?>
        <!-- Twitter -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        <!-- Facebook -->
        <div id="fb-root"></div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=328285627269392";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="inside">
            <div id="social-share">
              <div class="fb-like" data-href="https://www.facebook.com/rockscritps" data-send="false" data-layout="button_count" data-width="90" data-show-faces="true"></div>
              <div class="tw-follow" ><a href="https://twitter.com/rockscritps" class="twitter-follow-button" data-show-count="false">Follow @rockscritps</a></div>
            </div>
            <p><b><a href="http://rockscritps.com/wp/support/onepageshop"><?php _e('onepageshop Documentation','onepageshop'); ?></a></b></p>
            <p><?php _e('The best way to contact us with <b>support questions</b> and <b>bug reports</b> is via','onepageshop') ?> <a href="http://rockscritps.com/wp/forums"><?php _e('rockscritps support forum','onepageshop') ?></a>.</p>
            <p><?php _e('If you like this theme, I\'d appreciate any of the following:','onepageshop') ?></p>
            <ul>
                <li><a class="button" href="http://wordpress.org/support/view/theme-reviews/onepageshop?filter=5" title="<?php esc_attr_e('Rate this Theme', 'onepageshop'); ?>" target="_blank"><?php printf(__('Rate this Theme','onepageshop')); ?></a></li>
                <li><a class="button" href="http://www.facebook.com/rockscritps" title="Like rockscritps on Facebook" target="_blank"><?php printf(__('Like on Facebook','onepageshop')); ?></a></li>
                <li><a class="button" href="http://twitter.com/rockscritps/" title="Follow Colrolib on Twitter" target="_blank"><?php printf(__('Follow on Twitter','onepageshop')); ?></a></li>
            </ul>
        </div><?php
   }

}

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );

function customizer_custom_scripts() { ?>
<style>
    li#accordion-section-onepageshop_important_links h3.accordion-section-title, li#accordion-section-onepageshop_important_links h3.accordion-section-title:focus { background-color: #00cc00 !important; color: #fff !important; }
    li#accordion-section-onepageshop_important_links h3.accordion-section-title:hover { background-color: #00b200 !important; color: #fff !important; }
    li#accordion-section-onepageshop_important_links h3.accordion-section-title:after { color: #fff !important; }
</style>
<?php
}