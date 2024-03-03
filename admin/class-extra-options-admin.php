<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://elivate.net
 * @since      1.0.0
 *
 * @package    Extra_Options
 * @subpackage Extra_Options/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Extra_Options
 * @subpackage Extra_Options/admin
 * @author     Alex Trusler <alex.t@elivate.net>
 */
class Extra_Options_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extra_Options_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extra_Options_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/extra-options-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extra_Options_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extra_Options_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/extra-options-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add a menu page for settings
	 */
	public function add_plugin_admin_menu() {
		add_menu_page(
			'Extra Options',
			'Extra Options',
			'manage_options',
			'extra-options',
			array( $this, 'display_settings_page' ),
			'dashicons-admin-generic',
			6
		);
	}

	public function display_settings_page() {
		// Check if the form has been submitted
		if ( isset( $_POST['submt'])) {
			// Check if the nonce field is set and valid
			if( check_admin_referer( 'extra_options_nonce_action', 'extra_options_nonce' ) ) {
				// Update the option value
				update_option( 'add_gravity_fields_cc', $_POST['add_gravity_fields_cc'] );
			}
		}
		wp_nonce_field( 'extra_options_nonce_action', 'extra_options_nonce' );
		include_once 'partials/extra-options-admin-display.php';
	}
	public function register_settings() {
		// Register a new setting for our options page.
		register_setting( 
			'extra_options', 
			'add_gravity_fields_cc',
			array($this, 'sanitize')
			);

		add_settings_section(
			'gravity_fields_section', // Unique identifier for the section
			'Gravity Fields', // Title of the section
			array( $this, 'gravity_fields_section_callback' ), // Callback function for the section
			'extra_options' // The menu page on which to display this section
		);
		
		// Add a new field to our section.
		add_settings_field(
			'add_gravity_fields_cc', // Unique identifier for the field
			'Add Gravity Fields CC', // Label of the field
			array( $this, 'add_gravity_fields_cc_callback' ), // Callback function for the field
			'extra_options', // The menu page on which to display this field
			'gravity_fields_section' // The section to which this field belongs
		);
	}

	public function gravity_fields_section_callback() {
		echo 'Gravity Forms settings';
	}

	public function add_gravity_fields_cc_callback() {
		// Get the value of the setting we've registered with register_setting()
		$setting = get_option( 'add_gravity_fields_cc' );
		// Check if the setting is 'on'. If so, the checkbox should be checked.
		$checked = ( $setting == 'on' ) ? 'checked' : '';
		// Output the checkbox
		echo "<input type='checkbox' name='add_gravity_fields_cc' " . $checked . ">";
	}

	public function sanitize( $input ) {
		// If the input is 'on', return 'on'. Otherwise, return 'off'.
		return $input === 'on' ? 'on' : 'off';
	}

}
