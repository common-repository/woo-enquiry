<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
$url3 =  admin_url('admin.php?page=woo-enquiry-call-price');
$url2 =  admin_url('admin.php?page=woo-enquiry-contact-form');
$url =  admin_url('admin.php?page=woo-enquiry');
$urlwhatsApp =  admin_url('admin.php?page=woo-enquiry-whatsapp');

if ( isset( $_POST['woo-whatsapp-options_nonce_field'] )  && wp_verify_nonce( $_POST['woo-whatsapp-options_nonce_field'], 'woo-whatsapp-options_nonce_action' ) ) {
if ($_POST['woo_cfp_submit']) {
    $aVals = array_map( 'sanitize_text_field', wp_unslash( $_POST['val'] ) );

	if($aVals['woo_whatsapp_number'] == ''){
    	$val['val']['woo_whatsapp_number'] = '';
    } else{

    	$val['val']['woo_whatsapp_number'] = $aVals['woo_whatsapp_number'];
    }
    if($aVals['woo_whatsapp_text'] == ''){
    	$val['val']['woo_whatsapp_text'] = '';
    } else{

    	$val['val']['woo_whatsapp_text'] = $aVals['woo_whatsapp_text'];
    }

    if($aVals['woo_whatsapp_message'] == ''){
    	$val['val']['woo_whatsapp_message'] = '';
    } else{

    	$val['val']['woo_whatsapp_message'] = $aVals['woo_whatsapp_message'];
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
			<a href="<?php echo $url2; ?>">Contact Form</a>
		</li>
		<li>
			<a href="<?php echo $url3; ?>">Call now for price</a>
		</li>
		<li>
			<a class="active" href="<?php echo $urlwhatsApp; ?>">Whatsapp</a>
		</li>
	</ul>
</div>
<form action="" method="post" name="woo-whatsapp-options">
	<?php wp_nonce_field( 'woo-whatsapp-options_nonce_action', 'woo-whatsapp-options_nonce_field' ); ?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">whatsapp Number</th>
				<td><input type="number" name="val[woo_whatsapp_number]" value="<?php echo get_option('woo_whatsapp_number') ?>"></td>
			</tr>
			<tr>
				<th scope="row">Button Text</th>
				<td><input type="text" name="val[woo_whatsapp_text]" value="<?php if(get_option('woo_whatsapp_text')) { echo get_option('woo_whatsapp_text'); } else{ echo  'Whatsapp'; } ?>"></td>
			</tr>
			<tr>
				<th scope="row">Message</th>
				<td><input type="text" name="val[woo_whatsapp_message]" value="<?php if(get_option('woo_whatsapp_message')) { echo get_option('woo_whatsapp_message'); } ?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="submit"><input type="submit" name="woo_cfp_submit" class="button-primary" value="Save Changes"></p>
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