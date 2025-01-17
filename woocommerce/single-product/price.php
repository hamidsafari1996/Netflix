<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$time_link = get_post_meta(get_the_ID(),'text-link',true);
$text_button = get_post_meta(get_the_ID(),'text-button',true);
?>
<?php if ( $price_html = $product->get_price_html() ) { ?>
	<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> text-success py-1"><span class="ml-1 text-white-50">قیمت:</span><?php echo $product->get_price_html(); ?></p>
<?php  
}
else{
	echo '<div class="pt-5"><span class="no-price alert text-white"><a href="'.$time_link.'" class="popup-youtube"><i class="fas fa-play ml-3"></i>'.$text_button.'</a></span></div>';
}

?>

