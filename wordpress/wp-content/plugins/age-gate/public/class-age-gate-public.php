<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://philsbury.uk
 * @since      1.0.0
 *
 * @package    Age_Gate
 * @subpackage Age_Gate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Age_Gate
 * @subpackage Age_Gate/public
 * @author     Phil Baker <phil@philsbury.co.uk>
 */
class Age_Gate_Public {

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
	 * Cookie name used in the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $cookie;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cookie = 'ageCookie';

		$this->settings = get_option('wp_age_gate_general');

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Age_Gate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Age_Gate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering enqueue_styles from enqueue_scripts");
		}

		if (isset($this->settings['wp_age_gate_styling'])){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/age-gate-public.css', array(), $this->version, 'all' );
		}

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Age_Gate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Age_Gate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering enqueue_scripts from enqueue_scripts");
		}

		if(isset($this->settings['wp_age_gate_use_js']) && $this->settings['wp_age_gate_use_js'] !== 'standard'){
			
			wp_enqueue_script( $this->plugin_name . '-twig', plugin_dir_url( __FILE__ ) . 'js/twig.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'js/age-gate-public.js', array( 'jquery' ), $this->version, true );
		}

		
		
	}


	/**
	 * Add admin defined CSS to head
	 * @since 1.0.0
	 */
	public function customCss()
	{
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering customCss from wp_head");
		}

		if(isset($this->settings['wp_age_gate_background_colour'])){ ?>
			<style>
				.age-gate-wrapper { background-color: <?php echo $this->settings['wp_age_gate_background_colour']; ?>;}
			</style>
		<?php 
		}

		if(isset($this->settings['wp_age_gate_background_image'])){ ?>
			<style>
				.age-gate-wrapper { background-image: url(<?php echo wp_get_attachment_url($this->settings['wp_age_gate_background_image']); ?>);}
			</style>
		<?php 
		}

		if(isset($this->settings['wp_age_gate_foreground_colour'])){ ?>
			<style>
				.age-gate-form {
					background-color: <?php echo $this->settings['wp_age_gate_foreground_colour']; ?>;
				}
			</style>
		<?php 
		}

		if(isset($this->settings['wp_age_gate_text_colour'])){ ?>
		<style>
			.age-gate-form, .age-gate-form label, .age-gate-form h1, .age-gate-form h2 {
				color: <?php echo $this->settings['wp_age_gate_text_colour']; ?>;
			}
		</style>
		<?php 
		}

		if(isset($this->settings['wp_age_gate_use_js']) && $this->settings['wp_age_gate_use_js'] !== 'standard'){ ?>
		<style>
			.error {
				display: none;
			}

			.error.under {
				display: block;
			}
		</style>
		<?php 
		}

	}


	/**
	 * Check our age cookie
	 * @param string 	$tmpl The default template selected by WP
	 * @return string $tmpl The template for WP to render, either the age gate or original template
	 * @since 1.0.0 
	 */	
	public function age_gate($tmpl)
	{
		
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering age_gate from template_include");
		}
		
		if(isset($this->settings['wp_age_gate_use_js']) && $this->settings['wp_age_gate_use_js'] !== 'standard'){
			return $tmpl;
		}

		if(isset($_COOKIE[$this->cookie . 'Remember'])){
			$this->_setSession($this->cookie, $_COOKIE[$this->cookie . 'Remember']);
		}
		
		if(isset($_POST['age-submit']) && $_POST['age-submit'] == 1){


			$remember = (!isset($_POST['remember'])) ? false : true;

			if(!wp_verify_nonce( $_REQUEST['_agenonce'], 'age_verification' )){
				$this->_page_redirect(null, true, array('error' => 3));
				
			}

			if(isset($_POST['confirm'])){
				if ($_POST['confirm'] === 'no') {
					if(isset($this->settings['wp_age_gate_no_second_chance'])){
						$this->_setSession('under');
					}

					if(isset($this->settings['wp_age_gate_fail_link']) && !empty($this->settings['wp_age_gate_fail_link'])){
						$this->_page_redirect($this->settings['wp_age_gate_fail_link'], false);
					} else {

						parse_str($_SERVER['QUERY_STRING'], $qs);
						$this->_page_redirect(null, true, array('error' => 2));
						
					}
				} else {
					$this->_setSession($this->cookie, $remember);
					$this->_unsetSession('under');
					global $wp;
					
					$this->_page_redirect(null, true, array(), true);
				}

			} elseif(!$this->_validateInput($_POST)){
				$this->_page_redirect(null, true, array('error' => 1));
				;

			} elseif($this->_ageTest($_POST) >= (int) $this->settings['wp_age_gate_min_age']){
				$this->_setSession($this->cookie, $remember);
				$this->_unsetSession('under');

				$this->_page_redirect(null, true, array(), true);

			} else {
				// show an error or redirect
				
				if(isset($this->settings['wp_age_gate_no_second_chance'])){
					$this->_setSession('under');
				}

				if(isset($this->settings['wp_age_gate_fail_link']) && !empty($this->settings['wp_age_gate_fail_link'])){
					$this->_page_redirect($this->settings['wp_age_gate_fail_link'], false);
				} else {
					$this->_page_redirect(null, true, array('error' => 2, ));
				}
			
			}

		}

		if($this->_ageRestricted() && !$this->_ageGatePassed() && !$this->_bot_detected()){

			return AGE_GATE_DIR . 'public/partials/age-gate-public-display.php';
		} else {
			return $tmpl;
		}
	}

	/**
	 * Handle redirects on form pass/fail
	 * @param  [type]  $url      [description]
	 * @param  boolean $internal [description]
	 * @param  array   $params   [description]
	 * @return [type]            [description]
	 * @since  1.5.1
	 */
	private function _page_redirect($url, $internal = true, $params = array(), $clearErrors = false){
		if(!$internal){
			$url = $url;
		} else {
			global $wp;
			// get any current query
			parse_str($_SERVER['QUERY_STRING'], $qs);

			if($clearErrors){
				unset($qs['error']);
			}

			$url = home_url(add_query_arg(array_merge($qs, $params),$wp->request));
		}

		wp_redirect($url);

	}

	/**
	 * Add fields to the registration form
	 * @return void Returns nothing
	 * @since 1.0.0
	 */
	public function extend_registration_form()
	{
		$day = filter_input( INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT );
		$month = filter_input( INPUT_POST, 'month', FILTER_SANITIZE_NUMBER_INT );
		$year = filter_input( INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT );
		$settings = $this->settings;

    echo '<fieldset>';
    echo '<legend>Date of Birth</legend>';


    include AGE_GATE_DIR . 'public/partials/form/'. ($this->settings['wp_age_gate_input_type'] !== 'buttons' ? $this->settings['wp_age_gate_input_type'] : 'inputs') .'.php';
    
    echo '</fieldset>';

    

	}

	/**
	 * Add CSS to the registration forms for our added fields
	 * @return void
	 * @since 1.0.0
	 */
	public function extend_registration_form_styles(){
		echo '<link rel="stylesheet" href="' . plugin_dir_url( __FILE__ ) . 'css/age-gate-public.css' . '">';
	}

	/**
	 * Validate the additional items on the registration form
	 * @param  mixed $errors Default errors
	 * @param  string $login  Login username
	 * @param  string $email  login email
	 * @return mixed 	$errors The original errors with custom additions
	 * @since 1.0.0
	 */
	public function extend_registration_form_show_errors($errors, $login, $email)
	{
		

    $day = filter_input( INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT );
		$month = filter_input( INPUT_POST, 'month', FILTER_SANITIZE_NUMBER_INT );
		$year = filter_input( INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT );
		$dob = array(
			'year' => $year,
			'month' => $month,
			'day' => $day,
		);

		
		
    if ( $this->_ageTest($dob) < (int) $this->settings['wp_age_gate_min_age'] ){
      $errors->add( 'toyoungerror', '<strong>ERROR</strong>: Sorry, you are too young' );
    }

    

    return $errors;
	}

	
	/**
	 * Store users DOB on registration
	 * @param  	int 		$user_id The ID of the user
	 * @return 	int 		$user_id The ID of the user
	 * @since 	1.0.0
	 */
	public function extend_registration_user_data( $user_id ) {

		$data = array();

		$day = filter_input( INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT );
		$month = filter_input( INPUT_POST, 'month', FILTER_SANITIZE_NUMBER_INT );
		$year = filter_input( INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT );
		$dob = $year . '-' . $month . '-' . $day;

		if ( ! empty( $dob ) ){
			$data['dob'] = $dob;
		}

		update_user_meta( $user_id, 'u_db', $data );

		return $user_id;

	}

	
	/**
	 * Test if this content need restricing
	 * @return bool
	 * @access   private
	 * @since 1.0.0
	 */
	private function _ageRestricted()
	{

		if(isset($this->settings['wp_age_gate_ignore_logged']) && is_user_logged_in()){
			$this->log_message('Returning false from USER LOGGED IN');
			return false;
		}

		// check for WooCommerce shop archive
		if(function_exists('is_shop')){

			if(is_shop() && $this->settings['wp_age_gate_restriction_type'] === 'selected' && get_post_meta( get_option('woocommerce_shop_page_id'), '_age-restricted', true ) == true ){
				$this->log_message('Returning TRUE from WOOCOMMERCE ARCHIVE');
				return true;
			}
		}

		// when using selected content, has the post got age restriction?
		if(!is_archive() && $this->settings['wp_age_gate_restriction_type'] === 'selected' && get_post_meta( get_the_ID(), '_age-restricted', true ) != true ){ 
			$this->log_message('Returning false from SELECTED CONTENT');
			return false;
		}

		// when using ALL content, has the post got age restriction BYPASS?
		if($this->settings['wp_age_gate_restriction_type'] === 'all' && get_post_meta( get_the_ID(), '_age-bypass', true ) != false ){ 
			$this->log_message('Returning false from ALL CONTENT BYPASS');
			return false;
		}


		// check it's not the blog homepage 
		if(is_home() && $this->settings['wp_age_gate_restriction_type'] === 'selected' || is_archive() && $this->settings['wp_age_gate_restriction_type'] === 'selected' && get_post_meta( get_the_ID(), '_age-restricted', true ) != true ){
			$this->log_message('Returning false from ARCHIVE');
			return false;
		}

		

		return true;

	}

	/**
	 * Update the page title if the age gate is present
	 * @return 		string
	 * @access   	public
	 * @since 		1.0.0
	 */
	public function assignPageTitle($title){

		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering assignPageTitle from document_title_parts");
		}

		if (!isset($this->settings['wp_age_gate_switch_title']) || empty($this->settings['wp_age_gate_switch_title'])) {
			return $title;
		}

		
		if(isset($this->settings['wp_age_gate_use_js']) && $this->settings['wp_age_gate_use_js'] !== 'standard'){
			return $title;
		}	
		if($this->_ageRestricted() && !$this->_ageGatePassed() && !$this->_bot_detected()){
			$title_parts['title'] = __('Age Verification', $this->plugin_name);
    	return $title_parts;
	  } else {
	  	
	  	return $title;
	  }
	}

	/**
	 * Get the title parts when Yoast is messing with it
	 * @return mixed
	 * @since 1.4.8
	 */
	public function return_page_title($title)
	{
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log("Entering return_page_title from pre_get_document_title");
		}

		if (!isset($this->settings['wp_age_gate_switch_title']) || empty($this->settings['wp_age_gate_switch_title'])) {
			return $title;
		}

		return;
	}

	/**
	 * Set the cookie
	 * @param boolean $remember Wether to remember the visitor
	 * @since 		1.0.0
	 * @deprecated 1.2.0 
	 */	
	private function _setCookie($remember = false)
	{
		$expires = (!$remember) ? 0 : time()+31556926;
		setcookie($this->cookie, 1, $expires);
	}

	/**
	 * Set the cookie
	 * @param boolean $remember Wether to remember the visitor
	 * @since 		1.0.0
	 * @deprecated 1.2.0 
	 */	
	private function _setSession($name, $remember = false)
	{
		$_SESSION[$name] = 1;
		if($remember){

			$length = (isset($this->settings['wp_age_gate_remember_days']) && $this->settings['wp_age_gate_remember_days'] > 0) ? $this->settings['wp_age_gate_remember_days'] : 365;

			$length = strtotime('+' . $length . ' days');

			setcookie($this->cookie . 'Remember', 1, $length, false);
		}
	}

	/**
	 * unset a session var
	 * @since 1.2.0
	 */
	private function _unsetSession($name)
	{
		if(isset($_SESSION[$name])){
			unset($_SESSION[$name]);
		}
	}

	/**
	 * @since 1.2.0
	 */
	private function _ageGatePassed()
	{
		return (isset($_SESSION[$this->cookie]));
	}
	
	/**
	 * Test the age of the user
	 * @param  mixed $dob Post array
	 * @return int   The int value of the age
	 * @since 		1.0.0
	 */
	private function _ageTest($dob)
	{
		
		$dob = intval($dob['year']). '-' . str_pad(intval($dob['month']), 2, 0, STR_PAD_LEFT) . '-' . str_pad(intval($dob['day']), 2, 0, STR_PAD_LEFT);

		$from = new DateTime($dob);
		$to   = new DateTime('today');
		return $from->diff($to)->y;


	}

	/**
	 * Test for common robots
	 * @return bool
	 * @since 		1.0.0
	 * 
	 */
	private function _bot_detected() {

	  return (
	    isset($_SERVER['HTTP_USER_AGENT'])
	    && preg_match('/bot|crawl|slurp|spider|facebookexternalhit|Facebot|Twitterbot|Googlebot/i', $_SERVER['HTTP_USER_AGENT'])
	  );
	}

	/**
	 * Validate the input from the form
	 * @param  		mixed $data The post data
	 * @return 		bool
	 * @since 		1.0.0
	 */
	private function _validateInput($data)
	{

		if(!is_numeric($data['year'])){
			// wp_die('<h1>Year num</h1>');
			return false;
		}

		if(strlen( (string) $data['year'] ) !== 4){
			// wp_die('<h1>Year len</h1>' . strlen( (string) $data['year']));
			return false;	
		}

		if(!is_numeric($data['month'])){
			// wp_die('<h1>month num</h1>');
			return false;
		}

		if($data['month'] > 12){
			// wp_die('<h1>Month non existant</h1>');
			return false;
		}

		if(strlen( (string) $data['month'] ) !== 2){
			// wp_die('<h1>MM len</h1>');
			return false;	
		}

		if(!is_numeric($data['day'])){
			// wp_die('<h1>day num</h1>');
			return false;
		}

		if($data['day'] > 31){
			// wp_die('<h1>Day non existant</h1>');
			return false;
		}

		if(strlen( (string) $data['day'] ) !== 2){
			// wp_die('<h1>day Len</h1>');
			return false;	
		}

		return true;

	}
	/**
	 * Start a session to keep the age gate in
	 * @since 1.2.0
	 */
	public function start_ag_session() {
    if(!session_id()) {
        session_start();
    }
	}


	/**
	 * Add javascript version of Age Gate to page
	 *
	 * @since 1.4.0
	 */
	public function add_js_gate()
	{
		$dir = plugin_dir_url( __FILE__ );
		include AGE_GATE_DIR . 'public/partials/head/js-gate.php';
	}
	

	private function log_message($message)
	{
		if(defined('WP_DEBUG') && WP_DEBUG){
			error_log($message);
		}
	}
	

}
