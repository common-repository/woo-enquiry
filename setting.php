<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php 
$url3 =  admin_url('admin.php?page=woo-enquiry-call-price');
$url2 =  admin_url('admin.php?page=woo-enquiry-contact-form');
$url =  admin_url('admin.php?page=woo-enquiry');
$urlwhatsApp =  admin_url('admin.php?page=woo-enquiry-whatsapp');


$aRows[] = array('label' => 'Enable Contact Form', 'name' => 'enablecf', 'value' => get_option("enablecf"), 'type' => 'checkbox', 'class' => 'general-option');
$aRows[] = array('label' => 'Enable Call Now Button', 'name' => 'enablecfp', 'value' => get_option("enablecfp"), 'type' => 'checkbox', 'class' => 'general-option');
$aRows[] = array('label' => 'Enable Whatsapp Button', 'name' => 'enable_whatsapp', 'value' => get_option("enable_whatsapp"), 'type' => 'checkbox', 'class' => 'general-option');
//$aRows[] = array('label' => 'Disable Add To Cart', 'name' => 'add_to_cart', 'value' => get_option("add_to_cart"), 'type' => 'checkbox', 'class' => 'general-option');

$woo_hook = get_option("woo_hook");
if ( isset( $_POST['woo-general-options_nonce_field'] )  && wp_verify_nonce( $_POST['woo-general-options_nonce_field'], 'woo-general-options_nonce_action' ) ) {
if($_POST['general_option']){
	$aVals = array_map( 'sanitize_text_field', wp_unslash( $_POST['val'] ) );

	foreach ($aRows as $key => $aName) {
		$aNames[$aName['name']] = 'false';
	}
	
    if(!empty($aVals)){
		$aMatch = array_merge($aNames,$aVals);
	}
	else{
		$aMatch = $aNames;
	}

	foreach ($aMatch as $key => $value) {
		update_option( $key, $value );
	}

	wp_redirect( $url );
	exit;
}
}
//$woo_hook = get_option("woo_hook_wcf");
?>
<div class="d3-navigation">
	<ul>
		<li>
			<a class="active" href="<?php echo $url; ?>">General</a>
		</li>
		<li>
			<a href="<?php echo $url2; ?>">Contact Form</a>
		</li>
		<li>
			<a href="<?php echo $url3; ?>">Call now for price</a>
		</li>
		<li>
			<a href="<?php echo $urlwhatsApp; ?>">Whatsapp</a>
		</li>
	</ul>
</div>
<form action="" method="post" name="woo-general-options">
	<?php wp_nonce_field( 'woo-general-options_nonce_action', 'woo-general-options_nonce_field' ); ?>
	<table class="form-table">
		<tbody>
			<?php foreach ($aRows as $key => $value) { ?>
				<tr class="<?php echo $value['class']; ?>">
					<th scope="row"><?php echo $value['label']; ?></th>
					<td><input type="<?php echo $value['type']; ?>" name="val[<?php echo $value['name']; ?>]" value="<?php echo isset($value['value']) ? $value['value'] :'true' ; ?>" <?php if($value['value'] == 'true'){ echo 'checked' ; } ?>></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2">
					<p class="submit"><input type="submit" name="general_option" class="button-primary" value="Save Changes"></p>
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
<script type="text/javascript">
	jQuery(document).ready(function(){
    jQuery('.general-option input').click(function(){
        if(jQuery(this).prop("checked") == true){
            jQuery(this).val('true');
        }
        else if(jQuery(this).prop("checked") == false){
            jQuery(this).val('false');
        }
    });
});
</script>