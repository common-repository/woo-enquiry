<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
$url3 =  admin_url('admin.php?page=woo-enquiry-call-price');
$url2 =  admin_url('admin.php?page=woo-enquiry-contact-form');
$url =  admin_url('admin.php?page=woo-enquiry');
$urlwhatsApp =  admin_url('admin.php?page=woo-enquiry-whatsapp');

if ( isset( $_POST['woo-contact-form-options_nonce_field'] )  && wp_verify_nonce( $_POST['woo-contact-form-options_nonce_field'], 'woo-contact-form-options_nonce_action' ) ) {
if (isset($_POST['woo_cf_submit'])) {
	$aVals = array_map( 'sanitize_text_field', wp_unslash( $_POST['val'] ) );
  
    if($aVals['woo_cf_shortcode'] == ''){
    	$val['val']['woo_cf_shortcode'] = '';
    } else{

    	$val['val']['woo_cf_shortcode'] = $aVals['woo_cf_shortcode'];
    }
    if($aVals['woo_cf_heading'] == ''){
    	$val['val']['woo_cf_heading'] = '';
    } else{

    	$val['val']['woo_cf_heading'] = $aVals['woo_cf_heading'];
    }

	foreach ($val['val'] as $key => $value) {
		update_option( $key, $value );
	}

}
}
?>

<div class="d3-navigation">
	<ul>
		<li>
			<a href="<?php echo $url; ?>">General</a>
		</li>
		<li>
			<a class="active" href="<?php echo $url2; ?>">Contact Form</a>
		</li>
		<li>
			<a href="<?php echo $url3; ?>">Call for price</a>
		</li>
		<li>
			<a href="<?php echo $urlwhatsApp; ?>">Whatsapp</a>
		</li>
	</ul>
</div>
<form action="" method="post" name="woo-contact-form-options">
	<?php wp_nonce_field( 'woo-contact-form-options_nonce_action', 'woo-contact-form-options_nonce_field' ); ?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">Add Contact Form Shortcode</th>
				<td><textarea rows="2" cols="50" name='val[woo_cf_shortcode]'><?php echo stripslashes(get_option('woo_cf_shortcode')); ?></textarea></td>
			</tr>
			<tr>
				<th scope="row">CF Button Text</th>
				<td><input type="text" name="val[woo_cf_heading]" value="<?php if(get_option('woo_cf_heading')) { echo get_option('woo_cf_heading'); } else{ echo  'Enquire form'; } ?>"></td>
			</tr>
				<td colspan="2">
					<p class="submit"><input type="submit" name="woo_cf_submit" class="button-primary" value="Save Changes"></p>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<style type="text/css">
.d3-navigation li {
    display: inline-block;
    padding: 10px 25px;
    background-color: #ccc;
    border: 1px solid #ccc;
}
.d3-navigation li a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
}
.d3-navigation li a.active {
    color: #0073aa;
}
</style>