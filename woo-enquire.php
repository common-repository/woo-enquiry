<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
/*
Plugin Name: Woo Enquiry
Plugin URI: https://d3logics.com/woo-enquire
Description: woocommerce enquiry form whatsapp, call for price and contact form.
Version: 1.0
Author: D3 Logics
Author URI: https://d3logics.com/
Text Domain: wps-testimonials-carousel
Requires: 3.7 or higher
*/

class woo_enquiry_form {
	public $aParams;
	public function __construct()
	{
		$this->aParams['woo_cfp_phone'] = get_option("woo_cfp_phone");
		$this->aParams['woo_cfp_text'] 	= get_option("woo_cfp_text");

		$this->aParams['enablecf'] = get_option("enablecf");
		$this->aParams['enablecfp'] = get_option("enablecfp");
		$this->aParams['enable_whatsapp'] = get_option("enable_whatsapp");
		//$this->aParams['woo_hook_wcf'] = get_option("woo_hook_wcf");

		$this->aParams['woo_cf_shortcode'] = get_option("woo_cf_shortcode");
		$this->aParams['woo_cf_heading'] = get_option("woo_cf_heading");

		$this->aParams['woo_whatsapp_number'] = get_option("woo_whatsapp_number");
		$this->aParams['woo_whatsapp_text'] = get_option("woo_whatsapp_text");
		$this->aParams['woo_whatsapp_message'] = get_option("woo_whatsapp_message");

		add_filter('woocommerce_empty_price_html', array($this,'call_for_price_and_inquiry_form'));
		add_action( 'admin_menu', array($this,'admin_menu_setting'));
		add_action( 'wp_head', array($this,'woo_enquiry_style' ));
		add_action( 'wp_footer', array($this,'woo_enquiry_script' ));
	}

function call_for_price_and_inquiry_form() {
    if(!is_admin() && is_single()){
	if($this->aParams['woo_cf_heading'] && !empty($this->aParams['woo_cf_heading'])){
		$cf_button_text = $this->aParams['woo_cf_heading'];
	}
	else{
		$cf_button_text = 'Enquire form';
	}
	if($this->aParams['woo_cfp_text'] && !empty($this->aParams['woo_cfp_text'])){
		$cfp_button_text = $this->aParams['woo_cfp_text'];
	}
	else{
		$cfp_button_text = 'Call For Price';
	}
	if($this->aParams['woo_whatsapp_text'] && !empty($this->aParams['woo_whatsapp_text'])){
		$wapp_button_text = $this->aParams['woo_whatsapp_text'];
	}
	else{
		$wapp_button_text = 'Whatsapp';
	}
    $html = '<div class="woo-enquire-form"><div class="woo-enquire-buttons">';
    if($this->aParams['enablecf'] && $this->aParams['enablecf'] == 'true'){
    	$html .= '<button type="button" id="trigger_cf" class="single_add_to_cart_button button alt">'.$cf_button_text.'</button>';
	}
	if($this->aParams['enablecfp'] && $this->aParams['enablecfp'] == 'true'){
    	$html .='<a href="tel:'.$this->aParams['woo_cfp_phone'].'"><button type="button" id="trigger_cfp" class="single_add_to_cart_button button alt">'.$cfp_button_text.'</button></a>';
	}
	if($this->aParams['enable_whatsapp']){
    	$html .='<a href="https://api.whatsapp.com/send?phone='.$this->aParams['woo_whatsapp_number'].'&text='.$this->aParams['woo_whatsapp_message'].'"><button type="button" id="trigger_whatsapp" class="single_add_to_cart_button button alt">'.$wapp_button_text.'</button></a>';
	}
    $html .=  '</div><div id="product_inq_form" class="modal"><div class="modal-content"><span class="close">&times;</span>';
    $html .= do_shortcode($this->aParams["woo_cf_shortcode"]);
    $html .=  '</div></div></div>';
    return $html;
}
}

function admin_menu_setting(){
	add_menu_page('Woo Enquiry', 'Woo Enquiry', 'manage_options', 'woo-enquiry', array($this,'woo_enquiry_form'), 'dashicons-phone', 90 );
	add_submenu_page('woo-enquiry', 'Setting', 'Setting', 'manage_options', 'woo-enquiry' );
    add_submenu_page(null, 'Contact form', 'Contact form', 'manage_options', 'woo-enquiry-contact-form',array($this,'woo_enquiry_contact_form') );
    add_submenu_page(null, 'Call for price', 'Call for price', 'manage_options','woo-enquiry-call-price', array($this,'woo_enquiry_call_price') );
    add_submenu_page(null, 'Whatsapp', 'Whatsapp', 'manage_options','woo-enquiry-whatsapp', array($this,'woo_enquiry_whatsapp') );
}
function woo_enquiry_form(){
	include(plugin_dir_path( __FILE__ ).'setting.php');
}
function woo_enquiry_contact_form(){
	include(plugin_dir_path( __FILE__ ).'woo-contact-form.php');
}
function woo_enquiry_call_price(){
	include(plugin_dir_path( __FILE__ ).'woo-call-for-price.php');
}
function woo_enquiry_whatsapp(){
	include(plugin_dir_path( __FILE__ ).'woo-whatsapp.php');
}
function woo_enquiry_style(){ ?>
<style>
div#product_inq_form input, div#product_inq_form select, div#product_inq_form textarea {
    width: 100%;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  border-radius: 10px;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
div#product_inq_form textarea {
    max-height: 100px;
}
.woo-enquire-buttons {
    margin-left: -7px;
    margin-right: -7px;
}
.woo-enquire-buttons button {
    padding: 10px 15px;
    display: inline-block;
    margin: 0px 7px;
}
@media(min-width: 768px){
	.modal-content {
		width: 400px;
	}
}
@media(max-width: 768px){
	.modal-content {
		width: 90%;
	}
}
</style>
<?php
}
function woo_enquiry_script(){ ?>
<script type="text/javascript">
	// Get the modal
var modal = document.getElementById('product_inq_form');

// Get the button that opens the modal
var btn = document.getElementById("trigger_cf");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php }
}
$wooEnquiryObj =  new woo_enquiry_form();
?>