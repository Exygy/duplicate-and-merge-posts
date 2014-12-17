<?php
/*
	Register Pro Settings screen
 */
if ( ! class_exists('Duplicate_Edit_And_Merge_Settings') )
{
	class Duplicate_Edit_And_Merge_Settings {
		private $settings;
		private $pageHook;

		public function __construct() {
			require_once dirname( __FILE__ ) . '/class.settings-api.php';
			$this->settings = cnSettingsAPI::getInstance();

			add_action( 'admin_menu', array( &$this , 'loadSettingsPage' ) );
			add_action( 'plugins_loaded', array( &$this , 'init') );
		}

		public function init() {
			/*
			 * Register the settings tabs shown on the Settings admin page tabs, sections and fields.
			 * Init the registered settings.
			 * NOTE: The init method must be run after registering the tabs, sections and fields.
			 */
			add_filter( 'cn_register_settings_tabs' , array( &$this , 'tabs' ) );
			add_filter( 'cn_register_settings_sections' , array( &$this , 'sections' ) );
			add_filter( 'cn_register_settings_fields' , array( &$this , 'fields' ) );
			$this->settings->init();
		}

		public function loadSettingsPage() {
			//$this->pageHook = add_options_page( 'Settings API', 'Settings API', 'manage_options', 'settings_dem', array( &$this , 'showPage' ) );
			$this->pageHook = add_menu_page( 'Dupe, Edit, Merge', 'Dupe, Edit, Merge', 'manage_options', 'settings_dem', array( &$this , 'showPage' ) );
		}



		public function register_my_custom_menu_page(){
		    add_menu_page( 'custom menu title', 'custom menu', 'manage_options', 'myplugin/myplugin-admin.php', '', plugins_url( 'myplugin/images/icon.png' ), 6 );
		}

		public function tabs( $tabs ) {
			// Register the core tab banks.
			$tabs[] = array(
				'id' => 'basic' ,
				'position' => 10 ,
				'title' => __( 'Settings' , 'dem' ) ,
				'page_hook' => $this->pageHook
			);
			/*
			$tabs[] = array(
				'id' => 'other' ,
				'position' => 20 ,
				'title' => __( 'Other' , 'dem' ) ,
				'page_hook' => $this->pageHook
			);

			$tabs[] = array(
				'id' => 'advanced' ,
				'position' => 30 ,
				'title' => __( 'Advanced' , 'dem' ) ,
				'page_hook' => $this->pageHook
			);
			*/

			return $tabs;
		}

		public function sections( $sections ) {
			$sections[] = array(
				'tab' => 'basic' ,
				'id' => 'basic_one' ,
				'position' => 10 ,
				'title' => __( 'Main Settings' , 'dem' ) ,
				'callback' => false,
				'page_hook' => $this->pageHook
			);
			/*
			$sections[] = array(
				'tab' => 'basic' ,
				'id' => 'basic_two' ,
				'position' => 20 ,
				'title' => __( 'Test Section Two' , 'dem' ) ,
				'callback' => create_function( '', "_e( 'Test Section Two Description.' , 'dem' );" ) ,
				'page_hook' => $this->pageHook
			);
			*/

			return $sections;
		}

		public function fields( $fields ) {
			// Test Fields -- Remove before release.
			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'checkbox_test',
				'position' => 5,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Checkbox', 'dem'),
				'desc' => __('Checkbox Label.', 'dem'),
				'help' => __('testing'),
				'type' => 'checkbox',
				'default' => 1
			);

			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'notify_emails',
				'position' => 1,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Admin Emails', 'dem'),
				'desc' => __('Enter notification emails one per line', 'dem'),
				'help' => __(''),
				'type' => 'textarea',
				'size' => 'large',
				'default' => 'LARGE TEXT AREA'
			);
			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'text_regular',
				'position' => 28,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Regular Text', 'dem'),
				'desc' => __('Regular Text Label', 'dem'),
				'help' => __(''),
				'type' => 'text',
				'size' => 'regular',
				'default' => 'Regular'
			);

			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'text_large',
				'position' => 29,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Large Text', 'dem'),
				'desc' => __('Large Text Label', 'dem'),
				'help' => __(''),
				'type' => 'text',
				'size' => 'large',
				'default' => 'LARGE'
			);

			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'multicheck_test',
				'position' => 21,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Multi-Checkbox', 'dem'),
				'desc' => __('Multi-Checkbox Label', 'dem'),
				'help' => __(''),
				'type' => 'multicheckbox',
				'options' => array(
					'one' => 'One',
					'two' => 'Two',
					'three' => 'Three',
					'four' => 'Four'
				),
				'default' => array( 'one' , 'three' )
			);
			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'radio_test',
				'position' => 22,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Radio', 'dem'),
				'desc' => __('Radio Label', 'dem'),
				'help' => __(''),
				'type' => 'radio',
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				),
				'default' => 'yes'
			);
			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'select_test',
				'position' => 23,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Select', 'dem'),
				'desc' => __('Select Label', 'dem'),
				'help' => __(''),
				'type' => 'select',
				'options' => array(
					'one' => 'One',
					'two' => 'Two',
					'three' => 'Three',
					'four' => 'Four'
				),
				'default' => 'two'
			);
			$fields[] = array(
				'plugin_id' => 'dem',
				'id' => 'multi_select_test',
				'position' => 24,
				'page_hook' => 'toplevel_page_settings_dem',
				'tab' => 'basic',
				'section' => 'basic_one',
				'title' => __('Multi-Select', 'dem'),
				'desc' => __('Multi-Select Label', 'dem'),
				'help' => __(''),
				'type' => 'multiselect',
				'options' => array(
									'one' => 'One',
									'two' => 'Two',
									'three' => 'Three',
									'four' => 'Four',
									'five' => 'Five',
									'six' => 'Six',
									'seven' => 'Seven',
									'eight' => 'Eight',
									'nine' => 'Nine',
									'ten' => 'Ten'
				),
				'default' => array( 'two' , 'four' )
			);

			return $fields;
		}

		public function showPage() {
			echo '<div class="wrap">';

			$args = array(
				'page_icon' => '',
				'page_title' => 'Duplicate, Edit, and Merge Settings',
				'tab_icon' => 'options-general'
				);

			$this->settings->form( $this->pageHook , $args );

			echo '</div>';
		}
	}

	global $Duplicate_Edit_And_Merge_Settings;
	$Duplicate_Edit_And_Merge_Settings = new Duplicate_Edit_And_Merge_Settings();
}
?>