<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $product;
global $post;
if (isset($product) && $product->is_type("variable")) {
    $product_id                     = $product->get_id();
    $enable_global_stock_management = $product->get_manage_stock();
    $global_stock_quantity          = $enable_global_stock_management ? $product->get_stock_quantity() : null;
    $all_attributes                 = $product->get_attributes();
    $variableSetting                = get_option('variable_all_checked', array());
    $quickTableOnOff                = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
    $bulkSelectionHideShow          = isset($variableSetting['bulkSelectionHideShow']) ? $variableSetting['bulkSelectionHideShow'] : 'true';
    $imageHideShow                  = isset($variableSetting['imageHideShow']) ? $variableSetting['imageHideShow'] : 'true';
    $skuHideShow                    = isset($variableSetting['skuHideShow']) ? $variableSetting['skuHideShow'] : 'true';
    $allAttributeHideShow           = isset($variableSetting['allAttributeHideShow']) ? $variableSetting['allAttributeHideShow'] : 'true';
    $priceHideShow                  = isset($variableSetting['priceHideShow']) ? $variableSetting['priceHideShow'] : 'true';
    $quantityHideShow               = isset($variableSetting['quantityHideShow']) ? $variableSetting['quantityHideShow'] : 'true';
    $actionHideShow                 = isset($variableSetting['actionHideShow']) ? $variableSetting['actionHideShow'] : 'true';
    $onSaleHideShow                 = isset($variableSetting['onSaleHideShow']) ? $variableSetting['onSaleHideShow'] : 'true';
    $searchOptionHideShow           = isset($variableSetting['searchOptionHideShow']) ? $variableSetting['searchOptionHideShow'] : 'true';
    $bulkAddToCartPosition          = isset($variableSetting['bulkAddToCartPosition']) ? $variableSetting['bulkAddToCartPosition'] : 'after';
    $designSingleProductPageMobile  = isset($variableSetting['designSingleProductPageMobile']) ? $variableSetting['designSingleProductPageMobile'] : 'template_1';
    $cartButtonText                 = isset($variableSetting['cartButtonText']) ? $variableSetting['cartButtonText'] : 'Add-to-cart';
    $onSaleNameChange               = isset($variableSetting['onSaleNameChange']) ? $variableSetting['onSaleNameChange'] : 'On Sale';
    $searchOptionTextChange         = isset($variableSetting['searchOptionTextChange']) ? $variableSetting['searchOptionTextChange'] : 'Search...';
    $showPopUpImage                 = isset($variableSetting['showPopUpImage']) ? $variableSetting['showPopUpImage'] : 'true';
    $variationGalleryOnOff          = isset($variableSetting['variationGalleryOnOff']) ? $variableSetting['variationGalleryOnOff'] : '';
    $popUPImageShow                 = isset($variableSetting['popUPImageShow']) ? $variableSetting['popUPImageShow'] : 'default';
    $titleHideShow                  = isset($variableSetting['titleHideShow']) ? $variableSetting['titleHideShow'] : 'true';
    $descriptionHideShow            = isset($variableSetting['descriptionHideShow']) ? $variableSetting['descriptionHideShow'] : 'true';
    $weightDimensionsHideShow       = isset($variableSetting['weightDimensionsHideShow']) ? $variableSetting['weightDimensionsHideShow'] : 'true';
    $designAddCartTableTemplate2    = isset($variableSetting['designAddCartTableTemplate2']) ? $variableSetting['designAddCartTableTemplate2'] : 'template_1';
    $selectAllNameChange            = isset($variableSetting['selectAllNameChange']) ? $variableSetting['selectAllNameChange'] : 'Select All';
    $showDoublePrice                = isset($variableSetting['showDoublePrice']) ? $variableSetting['showDoublePrice'] : 'true';
    $stockStatusHideShow            = isset($variableSetting['stockStatusHideShow']) ? $variableSetting['stockStatusHideShow'] : 'true';
    $variationTableTemplate         = isset($variableSetting['variationTableTemplate']) ? $variableSetting['variationTableTemplate'] : 'template_1';
    $variationTableMeta             = get_post_meta($post->ID, '_variation_table_meta', true);
    $metaVariableTableTemplate      = get_post_meta($post->ID, '_variation_table_template', true);
    $metaTableTemplate2CartStyle    = get_post_meta($post->ID, '_table_template2_cart_section_style_template', true);
    $isMob                          = false;

    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $user_agent = sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT']));
        $isMob      = is_numeric(strpos(strtolower($user_agent), 'mobile'));
    }

    if($isMob){

        if ($quickTableOnOff == 'true') {

            if ($variationTableMeta === 'true' || $variationTableMeta === '') {
                if (!empty($metaVariableTableTemplate)){
                    if ($metaVariableTableTemplate === 'template_1'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template1.php';
                    }elseif ($metaVariableTableTemplate === 'template_2'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template2.php';
                    }
                }else{
                    if ($variationTableTemplate === 'template_2'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template2.php';
                    }elseif ($variationTableTemplate === 'template_1'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template1.php';
                    }
                }
            }
        }

    }else{

        if ($quickTableOnOff == 'true') {
            if ($variationTableMeta === 'true' || $variationTableMeta === '') {
                if (!empty($metaVariableTableTemplate)){
                    if ($metaVariableTableTemplate === 'template_1'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template1.php';
                    }elseif ($metaVariableTableTemplate === 'template_2'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template2.php';
                    }
                }else{
                    if ($variationTableTemplate === 'template_2'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template2.php';
                    }elseif ($variationTableTemplate === 'template_1'){
                        include plugin_dir_path(__FILE__) . '../table-template/table-template1.php';
                    }
                }
            }
        }
    }
}

?>
