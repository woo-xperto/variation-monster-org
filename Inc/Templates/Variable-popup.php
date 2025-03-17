<?php
// Assuming you have the global product object available
global $product;

$variableSettings        = get_option("variable_all_checked", []);
$variableHoverClick      = isset($variableSettings['hoverClickValue'][0]) ? $variableSettings['hoverClickValue'][0] : '';
$tooltipPosition         = isset($variableSettings["boxPositionValue"][0]) ? $variableSettings["boxPositionValue"][0] : "";
$variableDetailsTitle    = isset($variableSettings["variableDetailsTitle"][0]) ? $variableSettings["variableDetailsTitle"][0] : "";
$variableSKU             = isset($variableSettings["variableDetailsSKU"][0]) ? $variableSettings["variableDetailsSKU"][0] : "";
$variableDetailsImage    = isset($variableSettings["variableDetailsImage"][0]) ? $variableSettings["variableDetailsImage"][0] : "";
$variableDetailsExcerpt  = isset($variableSettings["variableDetailsExcerpt"][0]) ? $variableSettings["variableDetailsExcerpt"][0] : "";
$cartButtonText          = isset($variableSettings['cartButtonText']) ? $variableSettings['cartButtonText'] : 'Add-to-cart';
$variableAddToCartIcon   = isset($variableSettings['variableAddToCartIcon']) ? $variableSettings['variableAddToCartIcon'] : '';
$addToCartSuccessColor   = isset($variableSettings['addToCartSuccessColor']) ? $variableSettings['addToCartSuccessColor'] : '#fff';
$quickCartIcon           = isset($variableSettings['quickCartIcon']) ? $variableSettings['quickCartIcon'] : 'fa fa-shopping-cart';
$quickCartIconImageLink  = isset($variableSettings['quickCartIconImageLink']) ? $variableSettings['quickCartIconImageLink'] : '';

?>

<div <?php if ($variableHoverClick == "" ){ ?> style="display: none" <?php } ?> class="quick-variable-tooltip tooltiptext quick-hidden <?php if ($tooltipPosition != "quick-tooltip-position-center") { echo esc_attr($tooltipPosition); } ?>">
    <p><span class='closebtn'>&times;</span></p>

    <?php if (!empty($variableDetailsImage) && !empty($variableSettings)) {
        ?>
        <div src="<?php echo esc_url($variableDetailsImage); ?>"
             alt="<?php echo esc_attr($product->get_name()); ?>"
             style="<?php if (empty($variableDetailsImage)) { echo 'display:none;'; } ?>"
             class="variableThumb image-shop-page" > </div>
        <?php

    } ?>

    <div id="quick-product-details">
        <div id="quick-product-content">
            <?php if (!empty($variableDetailsTitle) && !empty($variableSettings)) {
                ?>
                <h4 class="<?php if (empty($variableDetailsTitle) && !empty($variableSettings)) { echo "quick-hidden"; } ?>"></h4>
                <?php
            } ?>

            <?php if (!empty($variableDetailsExcerpt) && !empty($variableSettings)) { ?>

                <p class="variable-short-desc <?php if (empty($variableDetailsExcerpt) && !empty($variableSettings)) { echo esc_attr("quick-hidden"); } ?>"></p>

            <?php } ?>

            <?php if (!empty($variableSKU) && !empty($variableSettings)) { ?>

                <div style="display: flex; gap: 4px; justify-content: center">
                    <strong><?php  echo esc_html("SKU:", 'variation-monster') ?> </strong>
                    <p class="variable-sku <?php if (empty($variableSKU) && !empty($variableSettings)) { echo esc_attr("quick-hidden"); } ?>"></p>
                </div>

            <?php } ?>

            <p><strong><?php echo esc_html("Price:", 'variation-monster'); ?> </strong><span id="variable-product-price"></span></p>
            <div id="variable-product-variations"></div>
        </div>

        <!-- Quantity and Add-to-Cart Button -->
        <div class="quick-quantity-container">
            <button class="quick-quantity-decrease" id="decrease"><?php echo esc_html("-", 'variation-monster'); ?></button>
            <input type="text" autocomplete="off" id="quantity" class="quick-quantity-input" value="1" data-max="">
            <button class="quick-quantity-increase" id="increase"><?php echo esc_html("+", 'variation-monster'); ?></button>

            <button id="quick-add-to-cart-shop-page"
                    class="quick-add-to-cart-shop-page"
                    data-productId="<?php echo esc_attr($product->get_id()); ?>"
                    data-variationId=""
                    data-action="variable-product-btn"
                    style="outline: none">
                <?php if (!empty($quickCartIconImageLink)): ?>
                <span class="add-to-cart-icon-image-render-from-js" data-add-to-cart-icon-image="<?php echo esc_url($quickCartIconImageLink); ?>" style="height: 20px; width: 20px;"></span>

                <?php else: ?>
                    <i class="<?php echo esc_attr($quickCartIcon); ?> cart-icon-remove" aria-hidden="true"></i>
                <?php endif; ?>
                <span><?php echo esc_html($cartButtonText); ?></span>

            </button>

            <?php wp_nonce_field('quick_variable_nonce_action', 'quick_variable_nonce'); ?>
        </div>
        <div class="quick-cart-notification quick-hidden" id="notification"></div>
        <div class="shop-page-show-success-message"></div>
        <div class="shop-page-show-failed-message"></div>
    </div>
</div>
