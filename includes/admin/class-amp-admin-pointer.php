<?php
/**
 * Admin pointer class.
 *
 * @package AMP
 * @since 1.0
 */

/**
 * AMP_Admin_Pointer class.
 *
 * Outputs an admin pointer to show the new features of v1.0.
 * Based on https://code.tutsplus.com/articles/integrating-with-wordpress-ui-admin-pointers--wp-26853
 *
 * @since 1.0
 */
class AMP_Admin_Pointer {

	/**
	 * The ID of the template mode admin pointer.
	 *
	 * @var string
	 */
	const TEMPLATE_POINTER_ID = 'amp_template_mode_pointer_10';

	/**
	 * The slug of the script.
	 *
	 * @var string
	 */
	const SCRIPT_SLUG = 'amp-admin-pointer';

	/**
	 * Initializes the class.
	 *
	 * @since 1.0
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_pointer' ) );
	}

	/**
	 * Enqueues the pointer assets.
	 *
	 * If the pointer has not been dismissed, enqueues the style and script.
	 * And outputs the pointer data for the script.
	 *
	 * @since 1.0
	 */
	public function enqueue_pointer() {
		$dismissed = explode( ',', strval( get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) ) );

		// Exit if the pointer has been dismissed.
		if ( in_array( self::TEMPLATE_POINTER_ID, $dismissed, true ) ) {
			return;
		}

		wp_enqueue_style( 'wp-pointer' );

		wp_enqueue_script(
			self::SCRIPT_SLUG,
			amp_get_asset_url( 'js/' . self::SCRIPT_SLUG . '.js' ),
			array( 'jquery', 'wp-pointer' ),
			AMP__VERSION,
			true
		);

		wp_add_inline_script(
			self::SCRIPT_SLUG,
			sprintf( 'ampAdminPointer.load( %s );', wp_json_encode( $this->get_pointer_data() ) )
		);
	}

	/**
	 * Gets the pointer data to pass to the script.
	 *
	 * @since 1.0
	 * @return array
	 */
	public function get_pointer_data() {
		return array(
			'pointer' => array(
				'pointer_id' => self::TEMPLATE_POINTER_ID,
				'target'     => '#toplevel_page_amp-options',
				'options'    => array(
					'content'  => sprintf(
						'<h3>%s</h3><p><strong>%s</strong></p><p>%s</p>',
						__( 'AMP', 'amp' ),
						__( 'New AMP Template Modes', 'amp' ),
						__( 'You can now reuse your theme\'s styles in AMP responses, using "Paired" or "Native" mode.', 'amp' )
					),
					'position' => array(
						'edge'  => 'left',
						'align' => 'middle',
					),
				),
			),
		);
	}
}
