<?php
/**
 * Plugin Name: Pix Desconto no Catálogo (Payment Gateway Based Fees)
 * Description: Exibe o desconto PIX do plugin Payment Gateway Based Fees and Discounts no catálogo da loja.
 * Version: 1.0
 * Author: Marcelo Nascimento
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Exibe info de desconto abaixo do preço no loop da loja
 */
add_action( 'woocommerce_after_shop_loop_item_title', function() {

    if ( ! function_exists( 'alg_wc_checkout_fees_get_product_info_html' ) ) {
        return;
    }

    global $product;

    if ( ! $product instanceof WC_Product ) {
        return;
    }

    $html = alg_wc_checkout_fees_get_product_info_html( $product );

    if ( empty( $html ) ) {
        return;
    }

    echo '<div class="alg-pix-desconto-catalogo">';
    echo $html;
    echo '</div>';

}, 11 );
