<?php
//Message
if(!function_exists('optione_woocommerce_checkout_coupon_message')){
	add_filter('woocommerce_checkout_coupon_message','optione_woocommerce_checkout_coupon_message');
	function optione_woocommerce_checkout_coupon_message(){
		return '<span class="pxl-added-to-cart-msg">'.esc_html__( 'Have a coupon?', 'optione' ) . '</span> <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'optione' ) . '</a>';
	}
}

// add inner wrap div to order review columns
if(!function_exists('optione_woocommerce_checkout_order_review_inner_open')){
	add_action('woocommerce_checkout_order_review','optione_woocommerce_checkout_order_review_inner_open', 0);
	function optione_woocommerce_checkout_order_review_inner_open(){
		echo '<div class="pxl-woocommerce-checkout-review-order-inner p-30 bg-accent pxl-radius-12">';
	}
}
if(!function_exists('optione_woocommerce_checkout_order_review_inner_close')){
	add_action('woocommerce_checkout_order_review','optione_woocommerce_checkout_order_review_inner_close', 999);
	function optione_woocommerce_checkout_order_review_inner_close(){
		echo '</div>';
	}
}

// add heading to order review columns
if(!function_exists('optione_woocommerce_checkout_order_review')){
	add_action('woocommerce_checkout_order_review','optione_woocommerce_checkout_order_review', 1);
	function optione_woocommerce_checkout_order_review(){ ?>
		<h3 id="pxl-order-review-heading" class="order-title"><?php esc_html_e( 'Your order', 'optione' ); ?></h3>
	<?php }
}

// add div wrap content after order review title
if(!function_exists('optione_woocommerce_checkout_order_review_inner2_open'))
{
	add_action('woocommerce_checkout_order_review','optione_woocommerce_checkout_order_review_inner2_open', 2);
	function optione_woocommerce_checkout_order_review_inner2_open(){
		echo '<div class="pxl-woocommerce-checkout-review-order-inner2 overflow-hidden text-body">';
	}
}
if(!function_exists('optione_woocommerce_checkout_order_review_inner2_close'))
{
	add_action('woocommerce_checkout_order_review','optione_woocommerce_checkout_order_review_inner2_close', 998);
	function optione_woocommerce_checkout_order_review_inner2_close(){
		echo '</div>';
	}
}

// custom proceed to paypal button
if(!function_exists('optione_woocommerce_order_button_html')){
	add_filter('woocommerce_order_button_html', 'optione_woocommerce_order_button_html');
	function optione_woocommerce_order_button_html(){
		$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'optione' ) );
		return '<div class="pxl-checkout-place-order"><button type="submit" class="button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button></div>';
	}
}