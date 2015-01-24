<?php

class lassoEditorAssets {

	function __construct(){

		add_action('wp_enqueue_scripts', array($this,'scripts'));
	}

	function scripts(){

		// only run on posts and pages if user is logged in and has teh right capabilities (edit_posts)
		if ( is_singular() && lasso_editor_user_can_edit() ) {

			wp_enqueue_style('lasso-editor-style', LASSO_URL.'/public/assets/css/lasso-editor.css', LASSO_VERSION, true);

			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-slider');

			// media uploader
			wp_enqueue_media();

			$article_object = lasso_editor_get_option('article_class','lasso_editor');
			$featImgClass = lasso_editor_get_option('featimg_class','lasso_editor');
			$titleClass = lasso_editor_get_option('title_class','lasso_editor');

			wp_enqueue_script('lasso-editor', LASSO_URL.'/public/assets/js/lasso-editor.js', array('jquery'), LASSO_VERSION, true);
			wp_localize_script('lasso-editor', 'lasso_editor',array(
				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
				'editor' 			=> 'lasso--content', // ID of editable content (without #) DONT CHANGE
				'article_object'	=> $article_object,
				'featImgClass'		=> $featImgClass,
				'titleClass'		=> $titleClass,
				'post_status'		=> get_post_status( get_the_ID() ),
				'postid'			=> get_the_ID(),
				'permalink'			=> get_permalink(),
				'author'			=> is_user_logged_in() ? get_current_user_ID() : false,
				'nonce'				=> wp_create_nonce('lasso_editor'),
				'handle'			=> lasso_editor_settings_toolbar(),
				'toolbar'			=> lasso_editor_text_toolbar(),
				'component_modal'	=> lasso_editor_component_modal(),
				'component_sidebar'	=> lasso_editor_component_sidebar(),
				'components'		=> lasso_editor_components(),
				'wpImgEdit'			=> lasso_editor_wpimg_edit(),
				'featImgControls'   => lasso_editor_image_controls(),
				'featImgNonce'		=> wp_create_nonce('lasso_editor_image'),
				'getGallImgNonce'	=> wp_create_nonce('lasso_get_gallery_images'),
				'createGallNonce'	=> wp_create_nonce('lasso_create_gallery'),
				'swapGallNonce'		=> wp_create_nonce('lasso_swap_gallery'),
				'titleNonce'		=> wp_create_nonce('lasso_update_title'),
				'wpImgNonce'		=> wp_create_nonce('lasso_update_wpimg'),
				'component_options' => lasso_editor_options_blob(),
				'userCanEdit'		=> current_user_can('edit_posts'),
				'newPostModal'		=> lasso_editor_newpost_modal()
			));
		}

	}

}
new lassoEditorAssets;