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
	wp_enqueue_script('jquery');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');

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


	//Custom fields for header
	if ( !class_exists('TakeTheLeadHeaderCustomFields') ) {

	    class TakeTheLeadHeaderCustomFields {
	        /**
	        * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
	        */
	        var $prefix = '_ttlh_';
	        /**
	        * @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
	        */
	        var $postTypes = array( "page", "days", "partners", "speakers" );
	        /**
	        * @var  array  $customFields  Defines the custom fields available
	        */
	        var $customFields = array(
						//header block
	            // array(
	            //     "name"          => "header_imagee",
	            //     "title"         => "A url for header image",
	            //     "description"   => "",
	            //     "type"          => "url",
	            //     "scope"         =>   array( "page"),
	            //     "capability"    => "edit_pages"
	            // ),
							array(
								"name" => "header_image",
								"title" => "Header image",
								"description" => "Select header image",
								"type" => "media",
								"scope" => array("page"),
								"capability" => "edit_pages"
							),
							array(
									"name"          => "header_text",
									"title"         => "Header text",
									"description"   => "Enter header text",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							//WWW block
							array(
									"name"          => "when",
									"title"         => "When",
									"description"   => "Enter text for field - when",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							array(
									"name"          => "where",
									"title"         => "Where",
									"description"   => "Enter text for field - where",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							array(
									"name"          => "what",
									"title"         => "What",
									"description"   => "Enter text for field - what",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							//main block
							array(
									"name"          => "main_title",
									"title"         => "Main title",
									"description"   => "",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							array(
									"name"          => "main_text",
									"title"         => "Main text",
									"description"   => "",
									"type"          => "textarea",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							//main button
							array(
									"name"          => "button_text",
									"title"         => "Button text",
									"description"   => "",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							array(
									"name"          => "button_url",
									"title"         => "Button url",
									"description"   => "",
									"type"          => "text",
									"scope"         =>   array( "page"),
									"capability"    => "edit_pages"
							),
							//Days fields
							array(
									"name"          => "title",
									"title"         => "Title",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "days" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "subtitle",
									"title"         => "Subtitle",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "days" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "content",
									"title"         => "Content",
									"description"   => "",
									"type"          =>   "textarea",
									"scope"         =>   array( "days" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "days_button_text",
									"title"         => "Button text",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "days" ),
									"capability"    => "edit_posts"
							),
	            array(
	                "name"          => "days_button_url",
	                "title"         => "Button url",
	                "description"   => "",
	                "type"          =>   "text",
	                "scope"         =>   array( "days" ),
	                "capability"    => "edit_posts"
	            ),
							//Speakers fields
							array(
								"name" => "speakers_image",
								"title" => "Speaker image",
								"description" => "Select speaker image",
								"type" => "media",
								"scope" => array("speakers"),
								"capability" => "edit_posts"
							),
							array(
									"name"          => "speakers_name",
									"title"         => "Name",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "speakers" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "speakers_job",
									"title"         => "Job",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "speakers" ),
									"capability"    => "edit_posts"
							),
							//Partners fields
							array(
									"name"          => "partners_title",
									"title"         => "Title",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "partners" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "partners_content",
									"title"         => "Content",
									"description"   => "",
									"type"          =>   "textarea",
									"scope"         =>   array( "partners" ),
									"capability"    => "edit_posts"
							),
							array(
								"name" => "partners_image",
								"title" => "Partner image",
								"description" => "Select partner image",
								"type" => "media",
								"scope" => array("partners"),
								"capability" => "edit_posts"
							),
							array(
									"name"          => "partners_button_text",
									"title"         => "Button text",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "partners" ),
									"capability"    => "edit_posts"
							),
							array(
									"name"          => "partners_button_url",
									"title"         => "Url",
									"description"   => "",
									"type"          =>   "text",
									"scope"         =>   array( "partners" ),
									"capability"    => "edit_posts"
							),
	        );
	        /**
	        * PHP 4 Compatible Constructor
	        */
	        function TakeTheLeadHeaderCustomFields() { $this->__construct(); }
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
	                    add_meta_box( 'my-custom-fields', 'Header block', array( & $this, 'displayCustomFields' ), $postType, 'normal', 'high' );
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
																	//media
																	case "media":{
																		image_upload($post);
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
	if ( class_exists('TakeTheLeadHeaderCustomFields') ) {
	    $TakeTheLeadHeaderCustomFields_var = new TakeTheLeadHeaderCustomFields();
	}
	//removing standart wordpress editor from post_type: days; page
	add_action( 'init', function() {
    remove_post_type_support( 'days', 'editor' );
    remove_post_type_support( 'page', 'editor' );
    remove_post_type_support( 'partners', 'editor' );
    remove_post_type_support( 'speakers', 'editor' );
}, 99);

//callback function for image uploading
function image_upload($post){
  $url = get_post_meta($post->ID, 'header-image', true); ?>
  <input id="my_image_URL" name="my_image_URL" type="text"
         value="<?php echo $url;?>" style="width:400px;" />
  <input id="my_upl_button" type="button" value="Upload Image" /><br/>
  <img src="<?php echo $url;?>" style="width:200px;" id="picsrc" />
  <script>
  jQuery(document).ready( function($) {
    jQuery('#my_upl_button').click(function() {
      window.send_to_editor = function(html) {
        imgurl = jQuery(html).attr('src')
        jQuery('#my_image_URL').val(imgurl);
        jQuery('#picsrc').attr("src", imgurl);
        tb_remove();
      }

      formfield = jQuery('#my_image_URL').attr('name');
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
      return false;
    }); // End on click
  });
  </script>
<?php
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['my_image_URL'])){
    update_post_meta($post_id, 'header-image', $_POST['my_image_URL']);
  }
});


/*add_action(
  'add_meta_boxes',
  function(){
    add_meta_box(
      'header_image', // ID
      'Header image', // Title
      'image_upload', // Callback (Construct function)
      'page', //screen (This adds metabox to all post types)
      'normal' // Context
    );
 },
 9
);*/
