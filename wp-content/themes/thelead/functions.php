<?php
/**
 * TheLead functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TheLead
 */

if ( ! function_exists( 'thelead_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thelead_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TheLead, use a find and replace
		 * to change 'thelead' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thelead', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'thelead' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thelead_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'thelead_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thelead_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'thelead_content_width', 640 );
}
add_action( 'after_setup_theme', 'thelead_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thelead_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'thelead' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'thelead' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'thelead_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thelead_scripts() {
	wp_enqueue_style( 'thelead-style', get_stylesheet_uri() );

	wp_enqueue_script( 'thelead-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'thelead-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thelead_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
add_action('customize_register', 'takethelead_customize_register');

function takethelead_customize_register($wp_customize) {
	//Customizer block date
    $wp_customize->add_section('date', array(
        'title' => 'Date block',
        'priority' => 1,
    ));
		$when = 'when';
		$wp_customize->add_setting($when, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($when, array(
				'section' => 'date',
				'type' => 'text',
				'label' => 'Enter date',
		));
		$wp_customize->selective_refresh->add_partial($when, array(
				'selector' => '.body',
				'render_callback' => function() use ($when) {
						return nl2br(esc_html(get_theme_mod($when)));
				}
		));
		$where = 'where';
		$wp_customize->add_setting($where, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($where, array(
				'section' => 'date',
				'type' => 'text',
				'label' => 'Enter address',
		));
		$wp_customize->selective_refresh->add_partial($where, array(
				'selector' => '.body',
				'render_callback' => function() use ($where) {
						return nl2br(esc_html(get_theme_mod($where)));
				}
		));
		$what = 'what';
		$wp_customize->add_setting($what, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($what, array(
				'section' => 'date',
				'type' => 'text',
				'label' => 'Enter subject',
		));
		$wp_customize->selective_refresh->add_partial($what, array(
				'selector' => '.body',
				'render_callback' => function() use ($what) {
						return nl2br(esc_html(get_theme_mod($what)));
				}
		));
		//text block
		$wp_customize->add_section('days', array(
				'title' => 'Days block',
				'priority' => 1,
		));
		$title = 'title';
		$wp_customize->add_setting($title, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($title, array(
				'section' => 'days',
				'type' => 'text',
				'label' => 'Enter title',
		));
		$wp_customize->selective_refresh->add_partial($title, array(
				'selector' => '.body',
				'render_callback' => function() use ($title) {
						return nl2br(esc_html(get_theme_mod($title)));
				}
		));
		$text = 'text';
		$wp_customize->add_setting($text, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($text, array(
				'section' => 'days',
				'type' => 'textarea',
				'label' => 'Enter text',
		));
		$wp_customize->selective_refresh->add_partial($text, array(
				'selector' => '.body',
				'render_callback' => function() use ($text) {
						return nl2br(esc_html(get_theme_mod($text)));
				}
		));
		$button_title = 'button_title';
		$wp_customize->add_setting($button_title, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($button_title, array(
				'section' => 'days',
				'type' => 'text',
				'label' => 'Enter title for button',
		));
		$wp_customize->selective_refresh->add_partial($button_title, array(
				'selector' => '.body',
				'render_callback' => function() use ($button_title) {
						return nl2br(esc_html(get_theme_mod($button_title)));
				}
		));
		$button_url = 'button_url';
		$wp_customize->add_setting($button_url, array(
				'default' => '',
				'sanitize_callback' => 'sanitize_textarea_field',
				'transport' => 'postMessage'
		));

		$wp_customize->add_control($button_url, array(
				'section' => 'days',
				'type' => 'text',
				'label' => 'Enter button url',
		));
		$wp_customize->selective_refresh->add_partial($button_url, array(
				'selector' => '.body',
				'render_callback' => function() use ($button_url) {
						return nl2br(esc_html(get_theme_mod($button_url)));
				}
		));
	}

	//Tesing custom fields
	if ( !class_exists('myCustomFields') ) {

	    class myCustomFields {
	        /**
	        * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
	        */
	        var $prefix = '_mcf_';
	        /**
	        * @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
	        */
	        var $postTypes = array( "page", "days" );
	        /**
	        * @var  array  $customFields  Defines the custom fields available
	        */
	        var $customFields = array(
	            array(
	                "name"          => "block-of-text",
	                "title"         => "A block of text",
	                "description"   => "",
	                "type"          => "textarea",
	                "scope"         =>   array( "page", "days" ),
	                "capability"    => "edit_pages"
	            ),
	            array(
	                "name"          => "button_urld",
	                "title"         => "A button url",
	                "description"   => "",
	                "type"          =>   "text",
	                "scope"         =>   array( "days" ),
	                "capability"    => "edit_posts"
	            ),
	            array(
	                "name"          => "checkbox",
	                "title"         => "Checkbox ",
	                "description"   => "",
	                "type"          => "checkbox",
	                "scope"         =>   array( "days" ),
	                "capability"    => "manage_options"
	            )
	        );
	        /**
	        * PHP 4 Compatible Constructor
	        */
	        function myCustomFields() { $this->__construct(); }
	        /**
	        * PHP 5 Constructor
	        */
	        function __construct() {
	            add_action( 'admin_menu', array( & $this, 'createCustomFields' ) );
	            add_action( 'save_post', array( & $this, 'saveCustomFields' ), 1, 2 );
	            // Comment this line out if you want to keep default custom fields meta box
	            add_action( 'do_meta_boxes', array( & $this, 'removeDefaultCustomFields' ), 10, 3 );
	        }
	        /**
	        * Remove the default Custom Fields meta box
	        */
	        function removeDefaultCustomFields( $type, $context, $post ) {
	            foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
	                foreach ( $this->postTypes as $postType ) {
	                    remove_meta_box( 'postcustom', $postType, $context );
	                }
	            }
	        }
	        /**
	        * Create the new Custom Fields meta box
	        */
	        function createCustomFields() {
	            if ( function_exists( 'add_meta_box' ) ) {
	                foreach ( $this->postTypes as $postType ) {
	                    add_meta_box( 'my-custom-fields', 'Custom Fields', array( & $this, 'displayCustomFields' ), $postType, 'normal', 'high' );
	                }
	            }
	        }
	        /**
	        * Display the new Custom Fields meta box
	        */
	        function displayCustomFields() {
	            global $post;
	            ?>
	            <div class="form-wrap">
	                <?php
	                wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
	                foreach ( $this->customFields as $customField ) {
	                    // Check scope
	                    $scope = $customField[ 'scope' ];
	                    $output = false;
	                    foreach ( $scope as $scopeItem ) {
	                        switch ( $scopeItem ) {
	                            default: {
	                                if ( $post->post_type == $scopeItem )
	                                    $output = true;
	                                break;
	                            }
	                        }
	                        if ( $output ) break;
	                    }
	                    // Check capability
	                    if ( !current_user_can( $customField['capability'], $post->ID ) )
	                        $output = false;
	                    // Output if allowed
	                    if ( $output ) { ?>
	                        <div class="form-field form-required">
	                            <?php
	                            switch ( $customField[ 'type' ] ) {
	                                case "checkbox": {
	                                    // Checkbox
	                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>';
	                                    echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
	                                    if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
	                                        echo ' checked="checked"';
	                                    echo '" style="width: auto;" />';
	                                    break;
	                                }
	                                case "textarea":
	                                case "wysiwyg": {
	                                    // Text area
	                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
	                                    echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
	                                    // WYSIWYG
	                                    if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
	                                        <script type="text/javascript">
	                                            jQuery( document ).ready( function() {
	                                                jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
	                                                if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
	                                                    tinyMCE.execCommand( "mceAddControl", false, "<?php echo $this->prefix . $customField[ 'name' ]; ?>" );
	                                                }
	                                            });
	                                        </script>
	                                    <?php }
	                                    break;
	                                }
	                                default: {
	                                    // Plain text field
	                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
	                                    echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
	                                    break;
	                                }
	                            }
	                            ?>
	                            <?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
	                        </div>
	                    <?php
	                    }
	                } ?>
	            </div>
	            <?php
	        }
	        /**
	        * Save the new Custom Fields values
	        */
	        function saveCustomFields( $post_id, $post ) {
	            if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
	                return;
	            if ( !current_user_can( 'edit_post', $post_id ) )
	                return;
	            if ( ! in_array( $post->post_type, $this->postTypes ) )
	                return;
	            foreach ( $this->customFields as $customField ) {
	                if ( current_user_can( $customField['capability'], $post_id ) ) {
	                    if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
	                        $value = $_POST[ $this->prefix . $customField['name'] ];
	                        // Auto-paragraphs for any WYSIWYG
	                        if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
	                        update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
	                    } else {
	                        delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
	                    }
	                }
	            }
	        }

	    } // End Class

	} // End if class exists statement

	// Instantiate the class
	if ( class_exists('myCustomFields') ) {
	    $myCustomFields_var = new myCustomFields();
	}
