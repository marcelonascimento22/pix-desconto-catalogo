<?php

add_action( 'woocommerce_after_shop_loop_item_title', function() {
    // 1. Verifica se o plugin está ativo
    if ( ! class_exists( 'Alg_WC_Checkout_Fees' ) ) {
        return;
    }

    global $product;

    if ( ! $product ) {
        return;
    }

    // 2. Tenta pegar o HTML formatado pelo plugin
    $html = '';
    if ( function_exists( 'alg_wc_checkout_fees_get_product_info_html' ) ) {
        $html = alg_wc_checkout_fees_get_product_info_html( $product );
    }

    // 3. Se o HTML veio vazio, o plugin pode estar ignorando o loop. 
    // Vamos forçar a exibição se houver uma regra de desconto global.
    if ( empty( $html ) ) {
        // Opcional: Aqui poderíamos calcular manualmente, 
        // mas primeiro vamos garantir que o container apareça para teste.
        $html = apply_filters( 'alg_wc_checkout_fees_product_info_html', '', $product );
    }

    if ( ! empty( $html ) ) {
        echo '<div class="alg-pix-desconto-catalogo" style="color: #27ae60; font-weight: bold; font-size: 0.9em; margin-top: 5px;">';
        echo $html;
        echo '</div>';
    } else {
        // Debug visual temporário: remova após testar
        // echo '<small style="display:none;">Plugin carregado, mas sem regra para este item.</small>';
    }

}, 15 ); // Aumentamos a prioridade para 15 para garantir que fique abaixo do preço

?>
