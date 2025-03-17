<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$variableSetting                       = get_option('variable_all_checked', array());
$variableHoverClick                    = isset($variableSetting['hoverClickValue'][0]) ? $variableSetting['hoverClickValue'][0] : 'variable-hover';
$showAttributeSwatchesArchive          = isset($variableSetting['showAttributeSwatchesArchive'][0]) ? $variableSetting['showAttributeSwatchesArchive'][0] : 'none';
$variableTooltipPosition               = isset($variableSetting['boxPositionValue'][0]) ? $variableSetting['boxPositionValue'][0] : '';
$variableDetailsTitle                  = isset($variableSetting['variableDetailsTitle'][0]) ? $variableSetting['variableDetailsTitle'][0] : '';
$variableDetailsImage                  = isset($variableSetting['variableDetailsImage'][0]) ? $variableSetting['variableDetailsImage'][0] : '';
$variableDetailsExcerpt                = isset($variableSetting['variableDetailsExcerpt'][0]) ? $variableSetting['variableDetailsExcerpt'][0] : '';
$variableDetailsSKU                    = isset($variableSetting['variableDetailsSKU'][0]) ? $variableSetting['variableDetailsSKU'][0] : '';
$variableDetailsPrice                  = isset($variableSetting['variableDetailsPrice'][0]) ? $variableSetting['variableDetailsPrice'][0] : '';
$variableDetailsAttribute              = isset($variableSetting['variableDetailsAttribute'][0]) ? $variableSetting['variableDetailsAttribute'][0] : '';
$quickCartIcon                         = isset($variableSetting['quickCartIcon']) ? $variableSetting['quickCartIcon'] : 'fa fa-shopping-cart';
$quickCartIconImageLink                = isset($variableSetting['quickCartIconImageLink']) ? $variableSetting['quickCartIconImageLink'] : '';
$cartButtonText                        = isset($variableSetting['cartButtonText']) ? $variableSetting['cartButtonText'] : 'Add-to-cart';
$cartButtonBg                          = isset($variableSetting['cartButtonBg']) ? $variableSetting['cartButtonBg'] : '#007cba';
$cartButtonTextColor                   = isset($variableSetting['cartButtonTextColor']) ? $variableSetting['cartButtonTextColor'] : '#fff';
$cartButtonTextHoverColor              = isset($variableSetting['cartButtonTextHoverColor']) ? $variableSetting['cartButtonTextHoverColor'] : '#000000';
$tooltipBgColor                        = isset($variableSetting['tooltipBg']) ? $variableSetting['tooltipBg'] : '#000';
$tooltipTextColor                      = isset($variableSetting['tooltipTextColor']) ? $variableSetting['tooltipTextColor'] : '#fff';
$addToCartSuccessColor                 = isset($variableSetting['addToCartSuccessColor']) ? $variableSetting['addToCartSuccessColor'] : '#fff';
$addToCartErrorColor                   = isset($variableSetting['addToCartErrorColor']) ? $variableSetting['addToCartErrorColor'] : '#FF0000';
$quantityBg                            = isset($variableSetting['quantityBg']) ? $variableSetting['quantityBg'] : '#007bff';
$quantityBorderColor                   = isset($variableSetting['quantityBorderColor']) ? $variableSetting['quantityBorderColor'] : '#ccc';
$quantityTextColor                     = isset($variableSetting['quantityTextColor']) ? $variableSetting['quantityTextColor'] : '#fff';
$quantityTextHoverColor                = isset($variableSetting['quantityTextHoverColor']) ? $variableSetting['quantityTextHoverColor'] : '#000000';
$showDoublePrice                       = isset($variableSetting['showDoublePrice']) ? $variableSetting['showDoublePrice'] : 'true';
$carouselButtonBgColor                 = isset($variableSetting['CarouselButtonBg']) ? $variableSetting['CarouselButtonBg'] : '#000';
$carouselButtonIconColor               = isset($variableSetting['CarouselButtonIconColor']) ? $variableSetting['CarouselButtonIconColor'] : '#fff';
$galleryNavigationButtonIconColor      = isset($variableSetting['galleryNavigationButtonIconColor']) ? $variableSetting['galleryNavigationButtonIconColor'] : '#fff';
$galleryNavigationButtonIconHoverColor = isset($variableSetting['galleryNavigationButtonIconHoverColor']) ? $variableSetting['galleryNavigationButtonIconHoverColor'] : '#D0D0D0';
$galleryNavigationButtonBgColor        = isset($variableSetting['galleryNavigationButtonBgColor']) ? $variableSetting['galleryNavigationButtonBgColor'] : '#808080';
$galleryNavigationButtonBgHoverColor   = isset($variableSetting['galleryNavigationButtonBgHoverColor']) ? $variableSetting['galleryNavigationButtonBgHoverColor'] : '##2F3031';
$tableHeadBgColor                   = isset($variableSetting['tableHeadBgColor']) ? $variableSetting['tableHeadBgColor'] : '#007cba';
$template2TableBgColor              = isset($variableSetting['template2TableBgColor']) ? $variableSetting['template2TableBgColor'] : '#000000';
$template2DetailsSectionBgColor     = isset($variableSetting['template2DetailsSectionBgColor']) ? $variableSetting['template2DetailsSectionBgColor'] : '#FFFFFF';
$template2CartSectionBgColor        = isset($variableSetting['template2CartSectionBgColor']) ? $variableSetting['template2CartSectionBgColor'] : '#FBFBFB';
$bulkAddCartBgColor                 = isset($variableSetting['bulkAddCartBgColor']) ? $variableSetting['bulkAddCartBgColor'] : '#007cba';
$bulkAddCartTextColor               = isset($variableSetting['bulkAddCartTextColor']) ? $variableSetting['bulkAddCartTextColor'] : '#FFFFFF';
$bulkAddCartHoverBgColor            = isset($variableSetting['bulkAddCartHoverBgColor']) ? $variableSetting['bulkAddCartHoverBgColor'] : '#007cba';
$bulkAddCartHoverTextColor          = isset($variableSetting['bulkAddCartHoverTextColor']) ? $variableSetting['bulkAddCartHoverTextColor'] : '#000000';
$paginationButtonBgColor            = isset($variableSetting['paginationButtonBgColor']) ? $variableSetting['paginationButtonBgColor'] : '#007cba';
$paginationButtonHoverBgColor       = isset($variableSetting['paginationButtonHoverBgColor']) ? $variableSetting['paginationButtonHoverBgColor'] : '#045CB4';
$paginationButtonTextColor          = isset($variableSetting['paginationButtonTextColor']) ? $variableSetting['paginationButtonTextColor'] : '#ffffff';
$paginationButtonTextHoverColor     = isset($variableSetting['paginationButtonTextHoverColor']) ? $variableSetting['paginationButtonTextHoverColor'] : '#000000';
$tableHeadTextColor                 = isset($variableSetting['tableHeadTextColor']) ? $variableSetting['tableHeadTextColor'] : '#fff';
$tableVariableTitleColor            = isset($variableSetting['tableVariableTitleColor']) ? $variableSetting['tableVariableTitleColor'] : '#111111';
$quickTableBorder                   = isset($variableSetting['quickTableBorder']) ? $variableSetting['quickTableBorder'] : '0';
$showPopUpImage                     = isset($variableSetting['showPopUpImage']) ? $variableSetting['showPopUpImage'] : 'true';
$tableBorderColor                   = isset($variableSetting['tableBorderColor']) ? $variableSetting['tableBorderColor'] : '#e1e8ed';
$tableBgColorOdd                    = isset($variableSetting['tableBgColorOdd']) ? $variableSetting['tableBgColorOdd'] : 'transparent';
$tableBgColorEven                   = isset($variableSetting['tableBgColorEven']) ? $variableSetting['tableBgColorEven'] : '#f2f2f2';
$tableBgColorHover                  = isset($variableSetting['tableBgColorHover']) ? $variableSetting['tableBgColorHover'] : '#ddd';
$onSaleNameChange                   = isset($variableSetting['onSaleNameChange']) ? $variableSetting['onSaleNameChange'] : 'On Sale';
$selectAllNameChange                = isset($variableSetting['selectAllNameChange']) ? $variableSetting['selectAllNameChange'] : 'Select All';
$tableRowPagination                 = isset($variableSetting['tableRowPagination']) ? $variableSetting['tableRowPagination'] : '5';
$listPagination                     = isset($variableSetting['listPagination']) ? $variableSetting['listPagination'] : '3';
$listPaginationPerLineMobile        = isset($variableSetting['listPaginationPerLineMobile']) ? $variableSetting['listPaginationPerLineMobile'] : '1';
$searchOptionTextChange             = isset($variableSetting['searchOptionTextChange']) ? $variableSetting['searchOptionTextChange'] : 'Search...';
$addToCartSuccessMessage            = isset($variableSetting['addToCartSuccessMessage']) ? $variableSetting['addToCartSuccessMessage'] : 'Successfully added to cart.';
$cartButtonBgHover                  = isset($variableSetting['cartButtonBgHover']) ? $variableSetting['cartButtonBgHover'] : '#045cb4';
$plusMinusBgColorHover              = isset($variableSetting['quantityBgColorHover']) ? $variableSetting['quantityBgColorHover'] : '#0056b3';
$quickCarouselOnOff                 = isset($variableSetting['quickCarouselOnOff']) ? $variableSetting['quickCarouselOnOff'] : '';
$quickTableOnOff                    = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
$imageHideShow                      = isset($variableSetting['imageHideShow']) ? $variableSetting['imageHideShow'] : 'true';
$skuHideShow                        = isset($variableSetting['skuHideShow']) ? $variableSetting['skuHideShow'] : 'true';
$titleHideShow                      = isset($variableSetting['titleHideShow']) ? $variableSetting['titleHideShow'] : 'true';
$descriptionHideShow                = isset($variableSetting['descriptionHideShow']) ? $variableSetting['descriptionHideShow'] : 'true';
$weightDimensionsHideShow           = isset($variableSetting['weightDimensionsHideShow']) ? $variableSetting['weightDimensionsHideShow'] : 'true';
$allAttributeHideShow               = isset($variableSetting['allAttributeHideShow']) ? $variableSetting['allAttributeHideShow'] : 'true';
$priceHideShow                      = isset($variableSetting['priceHideShow']) ? $variableSetting['priceHideShow'] : 'true';
$quantityHideShow                   = isset($variableSetting['quantityHideShow']) ? $variableSetting['quantityHideShow'] : 'true';
$stockStatusHideShow                = isset($variableSetting['stockStatusHideShow']) ? $variableSetting['stockStatusHideShow'] : 'true';
$actionHideShow                     = isset($variableSetting['actionHideShow']) ? $variableSetting['actionHideShow'] : 'true';
$onSaleHideShow                     = isset($variableSetting['onSaleHideShow']) ? $variableSetting['onSaleHideShow'] : 'true';
$searchOptionHideShow               = isset($variableSetting['searchOptionHideShow']) ? $variableSetting['searchOptionHideShow'] : 'true';
$bulkAddToCartPosition              = isset($variableSetting['bulkAddToCartPosition']) ? $variableSetting['bulkAddToCartPosition'] : 'after';
$variationGalleryOnOff              = isset($variableSetting['variationGalleryOnOff']) ? $variableSetting['variationGalleryOnOff'] : '';
$designSingleProductPageMobile      = isset($variableSetting['designSingleProductPageMobile']) ? $variableSetting['designSingleProductPageMobile'] : 'template_1';
$variationTableTemplate             = isset($variableSetting['variationTableTemplate']) ? $variableSetting['variationTableTemplate'] : 'template_1';
$designAddCartTableTemplate2        = isset($variableSetting['designAddCartTableTemplate2']) ? $variableSetting['designAddCartTableTemplate2'] : 'template_1';
$quickCarouselPosition              = isset($variableSetting['quickCarouselPosition']) ? $variableSetting['quickCarouselPosition'] : 'woocommerce_after_shop_loop_item';
$quickTablePosition                 = isset($variableSetting['quickTablePosition']) ? $variableSetting['quickTablePosition'] : 'woocommerce_after_single_product_summary';
$popUPImageShow                     = isset($variableSetting['popUPImageShow']) ? $variableSetting['popUPImageShow'] : 'thumbnail';
$galleryImageShow                   = isset($variableSetting['galleryImageShow']) ? $variableSetting['galleryImageShow'] : 'large';
$galleryStyleTemplate               = isset($variableSetting['galleryStyleTemplate']) ? $variableSetting['galleryStyleTemplate'] : 'template_3';
$attributeGalleryImageShow          = isset($variableSetting['attributeGalleryImageShow']) ? $variableSetting['attributeGalleryImageShow'] : 'large';
$carouselImageSize                  = isset($variableSetting['carouselImageSize']) ? $variableSetting['carouselImageSize'] : 'large';
$listImageShow                      = isset($variableSetting['listImageShow']) ? $variableSetting['listImageShow'] : 'thumbnail';
$globallyTooltipOnOff               = isset($variableSetting['globallyTooltipOnOff']) ? $variableSetting['globallyTooltipOnOff'] : '';
$variationSelectOnOff               = isset($variableSetting['variationSelectOnOff']) ? $variableSetting['variationSelectOnOff'] : '';
$selectVariationTooltipBgColor      = isset($variableSetting['selectVariationTooltipBgColor']) ? $variableSetting['selectVariationTooltipBgColor'] : '#000000';
$selectVariationTooltipTextColor    = isset($variableSetting['selectVariationTooltipTextColor']) ? $variableSetting['selectVariationTooltipTextColor'] : '#FFFFFF';
$selectVariationButtonBgColor       = isset($variableSetting['selectVariationButtonBgColor']) ? $variableSetting['selectVariationButtonBgColor'] : '#0071a1';
$selectVariationButtonTextColor     = isset($variableSetting['selectVariationButtonTextColor']) ? $variableSetting['selectVariationButtonTextColor'] : '#FFFFFF';
$imageColorWidth                    = isset($variableSetting['imageColorWidth']) ? $variableSetting['imageColorWidth'] : '40';
$imageColorHeight                   = isset($variableSetting['imageColorHeight']) ? $variableSetting['imageColorHeight'] : '40';
$imageColorBorderRadius             = isset($variableSetting['imageColorBorderRadius']) ? $variableSetting['imageColorBorderRadius'] : '50';
$swatchesButtonBorderColor          = isset($variableSetting['swatchesButtonBorderColor']) ? $variableSetting['swatchesButtonBorderColor'] : '#000000';
$selectedVariationButtonBorderColor = isset($variableSetting['selectedVariationButtonBorderColor']) ? $variableSetting['selectedVariationButtonBorderColor'] : '#0071a1';
$buttonWidth                        = isset($variableSetting['buttonWidth']) ? $variableSetting['buttonWidth'] : ' ';
$buttonHeight                       = isset($variableSetting['buttonHeight']) ? $variableSetting['buttonHeight'] : ' ';
$buttonBorderRadius                 = isset($variableSetting['buttonBorderRadius']) ? $variableSetting['buttonBorderRadius'] : '5';
$selectVariationTemplateOnOff       = isset($variableSetting['selectVariationTemplateOnOff']) ? $variableSetting['selectVariationTemplateOnOff'] : '';
$listLabelOnOff                     = isset($variableSetting['listLabelOnOff']) ? $variableSetting['listLabelOnOff'] : '';
$listSkuOnOff                       = isset($variableSetting['listSkuOnOff']) ? $variableSetting['listSkuOnOff'] : '';
$listPriceOnOff                     = isset($variableSetting['listPriceOnOff']) ? $variableSetting['listPriceOnOff'] : '';
$listQuantityOnOff                  = isset($variableSetting['listQuantityOnOff']) ? $variableSetting['listQuantityOnOff'] : '';
$listAttributeShow                  = isset($variableSetting['listAttributeShow']) ? $variableSetting['listAttributeShow'] : '';
$listTitleShow                      = isset($variableSetting['listTitleShow']) ? $variableSetting['listTitleShow'] : '';
$listBadgeShowOnOff                 = isset($variableSetting['listBadgeShowOnOff']) ? $variableSetting['listBadgeShowOnOff'] : '';
$listBadgeShowRight                 = isset($variableSetting['listBadgeShowRight']) ? $variableSetting['listBadgeShowRight'] : '';
$listBadgeDiscountFlatPrice         = isset($variableSetting['listBadgeDiscountFlatPrice']) ? $variableSetting['listBadgeDiscountFlatPrice'] : '';
$listBadgeBgColor                   = isset($variableSetting['listBadgeBgColor']) ? $variableSetting['listBadgeBgColor'] : '#FF5733';
$listBadgeTextColor                 = isset($variableSetting['listBadgeTextColor']) ? $variableSetting['listBadgeTextColor'] : '#ffffff';
$listBadgeHeight                    = isset($variableSetting['listBadgeHeight']) ? $variableSetting['listBadgeHeight'] : ' ';
$listBadgeWidth                     = isset($variableSetting['listBadgeWidth']) ? $variableSetting['listBadgeWidth'] : ' ';
$listForPercent                     = isset($variableSetting['listForPercent']) ? $variableSetting['listForPercent'] : '% OFF';
$listForFlat                        = isset($variableSetting['listForFlat']) ? $variableSetting['listForFlat'] : 'OFF';
$variationListTemplate              = isset($variableSetting['variationListTemplate']) ? $variableSetting['variationListTemplate'] : 'template_1';
$license_key                        = get_option('quick_license_key') ? get_option('quick_license_key') : "Enter Licence Key";
$exDateInt                          = get_option('quick_license_expiry_date') ? get_option('quick_license_expiry_date') : "0";
$exDate                             = gmdate("Y-m-d H:i:s", $exDateInt) ;
$license_active                     = get_option('quick_license_key');

?>

<div class="quick-variable-dashboard">
    <div class="alert adminAlert quick-hidden">
    </div>

    <div class="tab">
        <div id="variation-monster-admin-dashboard-image" data-image-url-variaion-monter="<?php echo esc_url(plugin_dir_url(__DIR__) . 'Assets/images/variation-monster.png'); ?>"></div>

        <button style="padding:8px; margin-top: 32px" class="tablinks" onclick="openCity(event, 'general')" id="defaultOpen">
            <i class="fas fa-cog"></i> <?php echo wp_kses(' General Setting','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'carousel')">
            <i class="fas fa-sliders-h"></i> <?php echo wp_kses(' Carousel Settings','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'table')">
            <i class="fas fa-table"></i> <?php echo wp_kses(' Table Setting','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'select-variation')">
            <i class="fas fa-layer-group"></i> <?php echo wp_kses(' Variation Swatches','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'select-variation-ul-li')">
            <i class="fas fa-list"></i> <?php echo wp_kses(' Variation List','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'variation-gallery')">
            <i class="fas fa-images"></i> <?php echo wp_kses(' Variation Gallery','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'attribute-gallery')">
            <i class="fas fa-shapes"></i> <?php echo wp_kses(' Attribute Gallery','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'support')">
            <i class="fas fa-life-ring"></i> <?php echo wp_kses(' Support','variation-monster'); ?>
        </button>
        <button style="padding:8px" class="tablinks" onclick="openCity(event, 'license')">
            <i class="fas fa-key"></i> <?php echo wp_kses(' License','variation-monster'); ?>
        </button>
    </div>

    <div id="general" class="tabcontent" >
        <div id="quickSwitchesWrapper">
            <h2><?php echo esc_html('Carousel and Table General Setting','variation-monster'); ?></h2>

            <div class="quick-selections" style="display: flex; gap: 21.2%; align-items: center;">
                <h4><?php echo wp_kses('Show Sell Price If Available: ','variation-monster');



                    ?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="show-double-price">
                        <label class="switch">
                            <input type="checkbox" name="show-double-price" <?php if( $showDoublePrice == "true" ): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="quick-selections" style="display: flex; gap: 10.2%; align-items: center;">
                <h4><?php echo wp_kses('Add to Cart Icon (Font Awesome 5): ','variation-monster');?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="icon-design" style="display: flex; gap: 10px; align-items: center;">

                        <?php
                        $variation_quick_cart_icon = [
                            'fa fa-shopping-cart',
                            'fa fa-cart-arrow-down',
                            'fa fa-cart-plus',
                            'fa none'
                        ];

                        $variation_quick_cart_icon_final = apply_filters('variation_quick_cart_icon', $variation_quick_cart_icon);

                        foreach ($variation_quick_cart_icon_final as $quick_cart_icon_final) {



                            ?>
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="radio" class="quick-cart-icon" name="quick_cart_icon" value="<?php echo esc_attr($quick_cart_icon_final); ?>"
                                    <?php echo ($quickCartIcon === $quick_cart_icon_final) ? 'checked' : ''; ?> />
                                <?php if ($quick_cart_icon_final === 'fa none') { ?>
                                    <span style="font-size: 16px; color: black">None</span>
                                <?php } else { ?>
                                    <i class="<?php echo esc_attr($quick_cart_icon_final); ?>" style="font-size: 20px;"></i>
                                <?php } ?>
                            </label>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <h4 style="margin-top: 20px">OR</h4>
            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quick-cart-icon-image-link"><strong><?php echo esc_html('Add to Cart Icon Image Link:','variation-monster'); ?></strong></label>
                    <input id="quick-cart-icon-image-link" type="text" class="quick-cart-icon-image-link" value="<?php echo  esc_attr($quickCartIconImageLink); ?>">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quick-add-to-cart-text"><strong><?php echo esc_html('Add to Cart Button Text:','variation-monster'); ?></strong></label>
                    <input id="quick-add-to-cart-text" type="text" class="quick-add-to-cart-text" value="<?php echo  esc_attr($cartButtonText); ?>">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-bg"><strong><?php echo esc_html('Add to Cart Button Background Color:','variation-monster'); ?></strong></label>
                    <input id="add-to-cart-bg" name="add-to-cart-bg" value="<?php echo esc_attr($cartButtonBg); ?>" data-jscolor="{}">
                </div>
            </div>


            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-bg-hover"><strong><?php echo wp_kses('Add to Cart Button Background Hover Color: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-bg-hover" name="add-to-cart-bg-hover" value="<?php echo esc_attr($cartButtonBgHover); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-text"><strong><?php echo wp_kses('Add to Cart Button Text Color: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-text" name="add-to-cart-text" value="<?php echo esc_attr($cartButtonTextColor); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-text-hover-color"><strong><?php echo wp_kses('Add to Cart Button Text Hover Color: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-text-hover-color" name="add-to-cart-text-hover-color" value="<?php echo esc_attr($cartButtonTextHoverColor); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quantity-bg-color"><strong><?php echo esc_html('Quantity Plus Minus Button Background Color:','variation-monster'); ?></strong></label>
                    <input id="quantity-bg-color" name="quantity-bg-color" value="<?php echo esc_attr($quantityBg); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quantity-bg-color-hover"><strong><?php echo wp_kses('Quantity Plus Minus Button Background Hover Color: ','variation-monster');?></strong></label>
                    <input id="quantity-bg-color-hover" name="quantity-bg-color-hover" value="<?php echo esc_attr($plusMinusBgColorHover); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quantity-text-color"><strong> <?php echo wp_kses('Quantity Plus Minus Button Text Color: ','variation-monster');?></strong></label>
                    <input id="quantity-text-color" name="quantity-text-color" value="<?php echo esc_attr($quantityTextColor); ?>"  data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quantity-text-hover-color"><strong> <?php echo wp_kses('Quantity Plus Minus Button Text Hover Color: ','variation-monster');?></strong></label>
                    <input id="quantity-text-hover-color" name="quantity-text-hover-color" value="<?php echo esc_attr($quantityTextHoverColor); ?>"  data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quantity-border-color"><strong> <?php echo wp_kses('Quantity Border Color:','variation-monster'); ?></strong></label>
                    <input id="quantity-border-color" name="quantity-border-color" value="<?php echo esc_attr( $quantityBorderColor ); ?>"  data-jscolor="{}">
                </div>
            </div>

        </div>

    </div>

    <div id="carousel" class="tabcontent">
        <div id="quickSwitchesWrapper">
            <h2><?php echo esc_html('Variation Quick Cart Carousel Setting','variation-monster'); ?></h2>

            <div class="quick-selections" style="display: flex; gap: 17.7%; align-items: center;">
                <h4><?php echo wp_kses('Variation Quick Cart Carousel On:', 'variation-monster'); ?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="quick-carousel-on-off">
                        <label class="switch">
                            <input type="checkbox" value="quick-carousel-on-off" <?php if($quickCarouselOnOff == "true"): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Variable Carousel Position Select -->
            <div class="quick-selections quick-selections-style" >
                <h4 ><?php echo wp_kses('Variation Quick Cart Carousel Position: ','variation-monster');

                    ?></h4>
                <div style="display: flex; gap: 17%;">
                    <select class="quick-carousel-position">

                        <?php
                        $variable_quick_cart_hook = [
                            'woocommerce_before_shop_loop_item',
                            'woocommerce_after_shop_loop_item',
                            'woocommerce_before_shop_loop_item_title',
                            'woocommerce_after_shop_loop_item_title'
                        ];

                        $variable_quick_cart_hook_final = apply_filters('variable_quick_cart_carousel_position', $variable_quick_cart_hook);

                        foreach ($variable_quick_cart_hook_final as $quick_cart_hook_final) {

                            $formatted_hook_name = ucwords(str_replace('_', ' ', str_replace('woocommerce_', '', $quick_cart_hook_final)));

                            ?>
                            <option value="<?php echo esc_attr($quick_cart_hook_final); ?>" <?php selected($quickCarouselPosition, $quick_cart_hook_final); ?>>
                                <?php echo esc_html($formatted_hook_name); ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>

                    <!-- Help Start -->
                    <button class="help-button variation-cart-carousel-setting-help">?</button>

                    <!-- Popup Structure -->
                    <div id="popup-container" style="display: none;">


                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <div class="help-image"></div>
                        </div>
                    </div>
                    <!-- Help End -->
                </div>
            </div>


            <!-- Carousel Image Size -->
            <div class="quick-selections quick-selections-style">
                <h4><?php echo wp_kses('Carousel Image Size : ','variation-monster');

                    ?></h4>

                <div style="display: flex; gap: 80px;">
                    <select id="carousel-image-size" class="carousel-image-size" disabled>


                        <?php
                        $carousel_image_size_hook = [
                            'thumbnail',
                            'medium',
                            'medium_large',
                            'large',
                            'woocommerce_thumbnail',
                            'woocommerce_single',
                            'woocommerce_gallery_thumbnail'
                        ];

                        $carousel_image_size_final_hook = apply_filters('variable_quick_cart_carousel_size_hook', $carousel_image_size_hook);

                        foreach ($carousel_image_size_final_hook as $carousel_image_final_hook) {

                            $formatted_image_size_hook_name = ucwords(str_replace('_', ' ', $carousel_image_final_hook));

                            ?>
                            <option value="<?php echo esc_attr($carousel_image_final_hook); ?>" <?php selected($carouselImageSize, $carousel_image_final_hook); ?>>
                                <?php echo esc_html($formatted_image_size_hook_name); ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
            </div>


            <div class="quick-selections" style="display: flex; gap: 23%; align-items: center;">
                <h4><?php echo wp_kses('Carousel Autoplay On: ','variation-monster');?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="quick-carousel-autoplay">
                        <label class="switch">
                            <input type="checkbox" name="quick-carousel-autoplay" disabled>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="quick-selections" style="display: flex; gap: 17.7%; align-items: center;">
                <h4><?php echo wp_kses('Redirect to Single Product Page: ','variation-monster');?>
                    <span class="redirect-single-page-help" data-tooltip="When click on image or title in popup">?</span>
                </h4>
                <div class="quick-selectors-wrapper">
                    <div class="name-image-redirect">
                        <label class="switch">
                            <input type="checkbox" name="name-image-redirect" disabled>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper" >
                    <label for="quick-carousel-button-bg-color"><strong> <?php echo esc_html('Carousel Nav Background Color:','variation-monster'); ?></strong></label>
                    <input id="quick-carousel-button-bg-color" name="quick-carousel-button-bg-color" value="<?php echo esc_attr( $carouselButtonBgColor ); ?>"  data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="quick-carousel-button-icon-color"><strong> <?php echo wp_kses('Carousel Navigation Button Icon Color: ','variation-monster');?></strong></label>
                    <input id="quick-carousel-button-icon-color" name="quick-carousel-button-icon-color" value="<?php echo esc_attr( $carouselButtonIconColor ); ?>"  data-jscolor="{}">
                </div>
            </div>
            <!-- Variable Details Box Show Checkboxes -->
            <div class="quick-selections quick-selections-style">
                <h4><?php echo esc_html('Popup Show:','variation-monster'); ?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="quick-hover-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-hover" <?php if($variableHoverClick == "variable-hover"): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('On Hover','variation-monster'); ?></span>
                    </div>
                    <div class="quick-hover-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-click" <?php if($variableHoverClick== "variable-click"): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('On Click ','variation-monster'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Variable Details Box Position Checkboxes -->
            <div class="quick-selections quick-selections-style">
                <h4><?php echo esc_html('Popup Position:','variation-monster'); ?></h4>
                <div class="quick-selectors-wrapper">
                    <div class="quick-box-position-click">
                        <label class="switch">
                            <input type="checkbox" value="quick-tooltip-position-center" <?php if($variableTooltipPosition == "quick-tooltip-position-center" || $variableTooltipPosition == "" || empty($variableSetting)): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Center','variation-monster'); ?></span>
                    </div>

                    <div class="quick-box-position-click">
                        <label class="switch">
                            <input type="checkbox" value="quick-tooltip-position-left" <?php if($variableTooltipPosition == "quick-tooltip-position-left"): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Left ','variation-monster');?></span>
                    </div>

                    <div class="quick-box-position-click">
                        <label class="switch">
                            <input type="checkbox" value="quick-tooltip-position-right"  <?php if($variableTooltipPosition == "quick-tooltip-position-right"): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Right ','variation-monster');?></span>
                    </div>
                </div>
            </div>
            <div class="quick-selections quick-selections-style">
                <h4><?php echo esc_html('Popup Contents:','variation-monster'); ?></h4>
                <div class="quick-selectors-wrapper">

                    <div class="quick-box-content-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-title-in-box" <?php if( !empty($variableDetailsTitle) || empty($variableSetting) ): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Title','variation-monster'); ?></span>
                    </div>

                    <div class="quick-box-content-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-image-in-box" <?php if( !empty($variableDetailsImage) || empty($variableSetting) ): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Image','variation-monster'); ?></span>
                    </div>

                    <div class="quick-box-content-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-excerpt-in-box" <?php if( !empty($variableDetailsExcerpt) ): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('Excerpt ','variation-monster');?></span> <span class="quickPro">(Pro)</span>
                    </div>


                    <div class="quick-box-content-click">
                        <label class="switch">
                            <input type="checkbox" value="variable-sku-in-box" <?php if( !empty($variableDetailsSKU) ): echo esc_attr("checked"); endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span><?php echo esc_html('SKU','variation-monster'); ?></span>
                    </div>

                    <!--
        <div class="quick-box-content-click">
            <label class="switch">
                <input type="checkbox" value="variable-price-in-box" <?php if( !empty($variableDetailsPrice) ): echo esc_attr("checked"); endif; ?>>
                <span class="slider round"></span>
            </label>
            <span><?php echo esc_html('Price  (Pro)','variation-monster'); ?></span> <span class="quickPro">(Pro)</span>
        </div>

        <div class="quick-box-content-click">
            <label class="switch">
                <input type="checkbox" value="variable-attribute-in-box" <?php if( !empty($variableDetailsAttribute) ): echo esc_attr("checked"); endif; ?>>
                <span class="slider round"></span>
            </label>
            <span><?php echo esc_html('Attribute  (Pro)','variation-monster'); ?></span> <span class="quickPro">(Pro)</span>
        </div>
         -->

                </div>
            </div>
            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="tooltip-bg"><strong><?php echo esc_html('Popup Background Color:','variation-monster'); ?></strong></label>
                    <input id="tooltip-bg" name="tooltip-bg" value="<?php echo esc_attr($tooltipBgColor); ?>" data-jscolor="{}">
                </div>
            </div>
            <!-- Quantity Button -->
            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="tooltip-text"><strong><?php echo wp_kses('Popup Text Color: ','variation-monster');?></strong></label>
                    <input id="tooltip-text" name="tooltip-text" value="<?php echo esc_attr($tooltipTextColor); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper">
                    <label for="add-to-cart-success-message"><strong> <?php echo wp_kses('Add to Cart Success Message: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-success-message" class="add-to-cart-success-message" type="text" name="add-to-cart-success-message" value="<?php echo esc_attr( $addToCartSuccessMessage ); ?>"  >
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-success-color"><strong><?php echo wp_kses('Add to Cart Success Text Color: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-success-color" name="add-to-cart-success-color" value="<?php echo esc_attr($addToCartSuccessColor); ?>" data-jscolor="{}">
                </div>
            </div>

            <div class="quick-selections">
                <div class="quick-selectors-wrapper m-top">
                    <label for="add-to-cart-error-color"><strong><?php echo wp_kses('Add to Cart Failed Text Color: ','variation-monster');?></strong></label>
                    <input id="add-to-cart-error-color" name="add-to-cart-error-color" value="<?php echo esc_attr($addToCartErrorColor); ?>" data-jscolor="{}">
                </div>
            </div>

        </div>
    </div>

    <div id="table" class="tabcontent" style="">

        <div id="quickAuthenticateWrapper">
            <h2><?php echo esc_html('Variation Table Setting','variation-monster'); ?></h2>

            <div style="display: flex; gap: 30%">
                <div>
                    <div class="quick-selections" style="display: flex; gap: 47% ; align-items: center">
                        <h4><?php echo wp_kses('Variation Table On: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="quick-table-on-off">
                                <label class="switch">
                                    <input type="checkbox" name="quick-table-on-off" <?php if( $quickTableOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Variation Table Images -->
                    <div class="quick-selections quick-selections-style">
                        <h4><?php echo wp_kses('Table Image Size: ','variation-monster');?></h4>

                        <div style="display: flex; gap: 80px;">
                            <select id="pop-up-image-show" class="pop-up-image-show">


                                <?php
                                $table_popup_image_size_hook = [
                                    'thumbnail',
                                    'medium',
                                    'medium_large',
                                    'large',
                                    'woocommerce_thumbnail',
                                    'woocommerce_single',
                                    'woocommerce_gallery_thumbnail'
                                ];

                                $table_popup_image_size_final_hook = apply_filters('variable_quick_cart_carousel_size_hook', $table_popup_image_size_hook);

                                foreach ($table_popup_image_size_final_hook as $table_popup_image_final_hook) {

                                    $formatted_table_popup_image_size_hook_name = ucwords(str_replace('_', ' ', $table_popup_image_final_hook));

                                    ?>
                                    <option value="<?php echo esc_attr($table_popup_image_final_hook); ?>" <?php selected($popUPImageShow, $table_popup_image_final_hook); ?>>
                                        <?php echo esc_html($formatted_table_popup_image_size_hook_name); ?>
                                    </option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="quick-selections quick-selections-style" style="display: flex; gap: 50%">
                        <div>
                            <h4><?php echo wp_kses('Variation Table Template: ','variation-monster');?></h4>

                            <div>
                                <select id="select-design-variation-table-template" class="variation-table-template" style="outline: none" disabled>
                                    <option value="template_1" <?php selected($variationTableTemplate, 'template_1'); ?>><?php echo wp_kses('Template 1','variation-monster');?></option>
                                    <option value="template_2" <?php selected($variationTableTemplate, 'template_2'); ?>><?php echo wp_kses('Template 2','variation-monster');?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--Variation Table Template 2 All Option-->
                    <div id="variation-table-template2-options" style="display: none;">
                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper">
                                <label for="template2-table-bg-color"><strong> <?php echo wp_kses('Template 2 Table Bg Color: ','variation-monster');?></strong></label>
                                <input id="template2-table-bg-color" name="template2-table-bg-color" value="<?php echo esc_attr( $template2TableBgColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper">
                                <label for="template2-details-section-bg-color"><strong> <?php echo wp_kses('Template 2 Details Section Bg Color: ','variation-monster');?></strong></label>
                                <input id="template2-details-section-bg-color" name="template2-details-section-bg-color" value="<?php echo esc_attr( $template2DetailsSectionBgColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper">
                                <label for="template2-cart-section-bg-color"><strong> <?php echo wp_kses('Template 2 Cart Section Bg Color: ','variation-monster');?></strong></label>
                                <input id="template2-cart-section-bg-color" name="template2-cart-section-bg-color" value="<?php echo esc_attr( $template2CartSectionBgColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections quick-selections-style" style="display: flex; gap: 50%">
                            <div>
                                <h4><?php echo wp_kses('Style Add to Cart for Template 2: ','variation-monster');?></h4>
                                <div>
                                    <select id="select-design-add-cart-table-template2" class="design-add-cart-table-template2" style="outline: none">
                                        <option value="template_1" <?php selected($designAddCartTableTemplate2, 'template_1'); ?>><?php echo wp_kses('Template 1','variation-monster');?></option>
                                        <option value="template_2" <?php selected($designAddCartTableTemplate2, 'template_2'); ?>><?php echo wp_kses('Template 2','variation-monster');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="select-all-name-change"><strong> <?php echo wp_kses('Custom Bulk Selection Text: ','variation-monster');?></strong></label>
                                <input id="select-all-name-change" class="select-all-name-change" type="text" name="select-all-name-change" value="<?php echo esc_attr( $selectAllNameChange ); ?>"  >
                            </div>
                        </div>
                    </div>
                    <!--Variation Table Template 1 All options-->
                    <div id="variation-table-template1-options" style="display: none;">
                        <div class="quick-selections" style="display: flex; gap: 28%; align-items: center">
                            <h4><?php echo wp_kses('Variation Table Border Show: ','variation-monster');

                                ?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="quick-table-border">
                                    <label class="switch">
                                        <input type="checkbox" name="quick-table-border" <?php if( $quickTableBorder == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper">
                                <label for="quick-table-head-bg-color"><strong> <?php echo wp_kses('Table Head Background Color: ','variation-monster');?></strong></label>
                                <input id="quick-table-head-bg-color" name="quick-table-head-bg-color" value="<?php echo esc_attr( $tableHeadBgColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top" >
                                <label for="quick-table-head-text-color"><strong> <?php echo wp_kses('Table Head Text Color: ','variation-monster');?></strong></label>
                                <input id="quick-table-head-text-color" name="quick-table-head-text-color" value="<?php echo esc_attr( $tableHeadTextColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="quick-table-border-color"><strong> <?php echo wp_kses('Table Border Color: ','variation-monster');?></strong></label>
                                <input id="quick-table-border-color" name="quick-table-border-color" value="<?php echo esc_attr( $tableBorderColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="quick-table-variable-title-color"><strong> <?php echo wp_kses('Variation Table Title Color: ','variation-monster');?></strong></label>
                                <input id="quick-table-variable-title-color" name="quick-table-variable-title-color" value="<?php echo esc_attr( $tableVariableTitleColor ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="quick-table-variable-bg-color-odd"><strong> <?php echo wp_kses('Variation Table Background Color(Odd): ','variation-monster');?></strong></label>
                                <input id="quick-table-variable-bg-color-odd" name="quick-table-variable-bg-color-odd" value="<?php echo esc_attr( $tableBgColorOdd ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="quick-table-variable-bg-color-even"><strong> <?php echo wp_kses('Variation Table Background Color(Even): ','variation-monster');?></strong></label>
                                <input id="quick-table-variable-bg-color-even" name="quick-table-variable-bg-color-even" value="<?php echo esc_attr( $tableBgColorEven ); ?>"  data-jscolor="{}">
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="quick-table-variable-hover-color"><strong> <?php echo wp_kses('Variation Table Background Color Hover: ','variation-monster');?></strong></label>
                                <input style="outline: none !important;" id="quick-table-variable-hover-color" name="quick-table-variable-hover-color" value="<?php echo esc_attr( $tableBgColorHover ); ?>"  data-jscolor="{}">
                            </div>
                        </div>
                    </div>

                    <!-- Table Row Pagination -->
                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper m-top">
                            <label for="table-row-pagination"><strong> <?php echo wp_kses('Table Row Pagination: ','variation-monster');?></strong></label>
                            <input id="table-row-pagination" class="table-row-pagination" type="number" min="5" name="table-row-pagination" value="<?php echo esc_attr( $tableRowPagination ); ?>"  disabled>
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="pagination-button-bg-color"><strong> <?php echo wp_kses('Pagination Button Background Color: ','product-variation-table-with-quick-cart');?></strong></label>
                            <input id="pagination-button-bg-color" name="pagination-button-bg-color" value="<?php echo esc_attr( $paginationButtonBgColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="pagination-button-hover-bg-color"><strong> <?php echo wp_kses('Pagination Button Hover Background Color: ','product-variation-table-with-quick-cart');?></strong></label>
                            <input id="pagination-button-hover-bg-color" name="pagination-button-hover-bg-color" value="<?php echo esc_attr( $paginationButtonHoverBgColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="pagination-button-text-color"><strong> <?php echo wp_kses('Pagination Button Text Color: ','product-variation-table-with-quick-cart');?></strong></label>
                            <input id="pagination-button-text-color" name="pagination-button-text-color" value="<?php echo esc_attr( $paginationButtonTextColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="pagination-button-text-hover-color"><strong> <?php echo wp_kses('Pagination Button Text Hover Color: ','product-variation-table-with-quick-cart');?></strong></label>
                            <input id="pagination-button-text-hover-color" name="pagination-button-text-hover-color" value="<?php echo esc_attr( $paginationButtonTextHoverColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <!-- Variation Table Position Select -->
                    <div class="quick-selections quick-selections-style">
                        <h4><?php echo wp_kses('Variation Table Position: ','variation-monster');?></h4>

                        <div style="display: flex; gap: 30px;">
                            <select id="table-position" class="quick-table-position">

                                <?php
                                $variation_table_position = [
                                    'woocommerce_before_single_product_summary',
                                    'woocommerce_after_single_product_summary',
                                    'woocommerce_after_single_product',
                                ];

                                $variation_table_position_hook_final = apply_filters('variation_table_position', $variation_table_position);

                                foreach ($variation_table_position_hook_final as $table_position_hook_final) {

                                    $formatted_table_hook_name = ucwords(str_replace('_', ' ', str_replace('woocommerce_', '', $table_position_hook_final)));

                                    ?>
                                    <option value="<?php echo esc_attr($table_position_hook_final); ?>" <?php selected($quickTablePosition, $table_position_hook_final); ?>>
                                        <?php echo esc_html($formatted_table_hook_name); ?>
                                    </option>
                                    <?php
                                }
                                ?>

                            </select>

                            <!-- Help Start -->
                            <a href="https://www.wooxperto.com/woocommerce-single-product-page-all-hook/"
                               class="help-button variation-cart-carousel-setting-help"
                               target="_blank"
                               rel="noopener noreferrer"
                               style="text-decoration: none; color: white;"
                               onmouseover="this.style.color='wheat';"
                               onmouseout="this.style.color='white';">
                                ?
                            </a>

                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="bulk-add-cart-bg-color"><strong> <?php echo wp_kses('Bulk Add to Cart Background Color: ','variation-monster');?></strong></label>
                            <input id="bulk-add-cart-bg-color" name="bulk-add-cart-bg-color" value="<?php echo esc_attr( $bulkAddCartBgColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="bulk-add-cart-text-color"><strong> <?php echo wp_kses('Bulk Add to Cart Text Color: ','variation-monster');?></strong></label>
                            <input id="bulk-add-cart-text-color" name="bulk-add-cart-text-color" value="<?php echo esc_attr( $bulkAddCartTextColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="bulk-add-cart-hover-bg-color"><strong> <?php echo wp_kses('Bulk Add to Cart Hover Background Color: ','variation-monster');?></strong></label>
                            <input id="bulk-add-cart-hover-bg-color" name="bulk-add-cart-hover-bg-color" value="<?php echo esc_attr( $bulkAddCartHoverBgColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper">
                            <label for="bulk-add-cart-hover-text-color"><strong> <?php echo wp_kses('Bulk Add to Cart Hover Text Color: ','variation-monster');?></strong></label>
                            <input id="bulk-add-cart-hover-text-color" name="bulk-add-cart-hover-text-color" value="<?php echo esc_attr( $bulkAddCartHoverTextColor ); ?>"  data-jscolor="{}">
                        </div>
                    </div>


                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper m-top">
                            <label for="on-sale-name-change"><strong> <?php echo wp_kses('On Sale Name Change: ','variation-monster');?></strong></label>
                            <input id="on-sale-name-change" class="on-sale-name-change" type="text" name="on-sale-name-change" value="<?php echo esc_attr( $onSaleNameChange ); ?>"  >
                        </div>
                    </div>

                    <div class="quick-selections">
                        <div class="quick-selectors-wrapper m-top">
                            <label for="search-option-text-change"><strong> <?php echo wp_kses('Search Option Text Change: ','variation-monster');?></strong></label>
                            <input id="search-option-text-change" class="search-option-text-change" type="text" name="search-option-text-change" value="<?php echo esc_attr( $searchOptionTextChange ); ?>"  >
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 30.2%; align-items: center">
                        <h4><?php echo wp_kses('Show Popup Image: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="show-popup-image">
                                <label class="switch">
                                    <input type="checkbox" name="show-popup-image" <?php if( $showPopUpImage == "true" ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="" class="quick-selections" style="display: flex; gap: 5%; align-items: center">
                        <h4><?php echo wp_kses('Show Gallery Image into Popup: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="">
                                <label class="switch">
                                    <input type="checkbox" name="" disabled>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="quick-selections" style="display: flex; gap: 28.3%; align-items: center">
                        <h4><?php echo wp_kses('Show Bulk Selection: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="bulk-selection-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="bulk-selection-hide-show"  disabled>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 44.3%; align-items: center">
                        <h4><?php echo wp_kses('Show Image: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="image-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="image-hide-show" <?php if( $imageHideShow == "true" || empty($imageHideShow)): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 48.5%; align-items: center">
                        <h4><?php echo wp_kses('Show SKU: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="sku-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="sku-hide-show" <?php if( $skuHideShow == "true" || empty($skuHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 47.5%; align-items: center">
                        <h4><?php echo wp_kses('Show Title: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="title-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="title-hide-show" <?php if( $titleHideShow == "true" || empty($titleHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 33.3%; align-items: center">
                        <h4><?php echo wp_kses('Show Description: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="description-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="description-hide-show" <?php if( $descriptionHideShow == "true" || empty($descriptionHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 12.5%; align-items: center">
                        <h4><?php echo wp_kses('Show Weight & Dimensions: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="weight-dimension-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="weight-dimension-hide-show" <?php if( $weightDimensionsHideShow == "true" || empty($weightDimensionsHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 37.5%; align-items: center">
                        <h4><?php echo wp_kses('Show Attribute: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="all-attribute-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="all-attribute-hide-show" <?php if( $allAttributeHideShow == "true" || empty($allAttributeHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 45.5%; align-items: center">
                        <h4><?php echo wp_kses('Show Price: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="price-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="price-hide-show" <?php if( $priceHideShow == "true" || empty($priceHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="quick-selections" style="display: flex; gap: 37.6%; align-items: center">
                        <h4><?php echo wp_kses('Show Quantity: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="quantity-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="quantity-hide-show" <?php if( $quantityHideShow == "true" || empty($quantityHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 30.8%; align-items: center">
                        <h4><?php echo wp_kses('Show Stock Status: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="stock-status-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="stock-status-hide-show" <?php if( $stockStatusHideShow == "true" || empty($stockStatusHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 41.8%; align-items: center">
                        <h4><?php echo wp_kses('Show Action: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="action-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="action-hide-show" <?php if( $actionHideShow == "true" || empty($actionHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 26.6%; align-items: center">
                        <h4><?php echo wp_kses('Show Search Option: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="search-option-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="search-option-hide-show" <?php if( $searchOptionHideShow == "true" || empty($searchOptionHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections" style="display: flex; gap: 24.6%; align-items: center">
                        <h4><?php echo wp_kses('Show On Sale Option: ','variation-monster');?></h4>
                        <div class="quick-selectors-wrapper">
                            <div class="on-sale-hide-show">
                                <label class="switch">
                                    <input type="checkbox" name="on-sale-hide-show" <?php if( $onSaleHideShow == "true" || empty($onSaleHideShow) ): echo esc_attr("checked"); endif; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="quick-selections quick-selections-style">
                        <h4><?php echo wp_kses('Bulk Add to Cart Position: ','variation-monster');?></h4>

                        <div >
                            <select id="table-position" class="bulk-add-to-cart-position" disabled>
                                <option value="before" <?php selected($bulkAddToCartPosition, 'before'); ?>>Before Table</option>
                                <option value="after" <?php selected($bulkAddToCartPosition, 'after'); ?>>After Table</option>
                                <option value="both" <?php selected($bulkAddToCartPosition, 'both'); ?>>Both</option>
                            </select>

                        </div>
                    </div>

                    <div class="quick-selections quick-selections-style" style="display: flex; gap: 50%">

                        <div>
                            <h4><?php echo wp_kses('Design for Mobile Single Product Page: ','variation-monster');?></h4>
                            <div >
                                <select id="select-design" class="design-single-product-page-mobile" style="outline: none" disabled>
                                    <option value="template_1" <?php selected($designSingleProductPageMobile, 'template_1'); ?>><?php echo wp_kses('Template 1','variation-monster');?></option>
                                    <option value="template_2" <?php selected($designSingleProductPageMobile, 'template_2'); ?>><?php echo wp_kses('Template 2','variation-monster');?></option>
                                    <option value="template_3" <?php selected($designSingleProductPageMobile, 'template_3'); ?>><?php echo wp_kses('Template 3','variation-monster');?></option>
                                    <option value="template_4" <?php selected($designSingleProductPageMobile, 'template_4'); ?>><?php echo wp_kses('Template 4','variation-monster');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div>

                    <div style="display: flex; align-items: end">
                        <div id="show-design-variation-table-template"></div>
                    </div>

                    <div id="variation-table-template2-cart-design" style="display: none;">
                        <div style="display: flex; align-items: end; margin-top: 20px">
                            <div id="show-design-add-cart-table-template2"></div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: end; position: absolute; bottom: 150px; left: 700px">
                        <div id="show-template-image"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="select-variation" class="tabcontent" style="">

        <div id="quickAuthenticateWrapper">
            <h2><?php echo esc_html('Variation Swatches for Single Product and Archive Page','variation-monster'); ?></h2>

                <div class="quick-selections" style="display: flex; gap: 10%; align-items: center">
                    <h4><?php echo wp_kses('Variation Swatches Enable: ','variation-monster');?></h4>
                    <div class="quick-selectors-wrapper">
                        <div class="variation-select-on-off">
                            <label class="switch">
                                <input type="checkbox" name="variation-select-on-off" <?php if( $variationSelectOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="quick-selections quick-selections-style">
                    <h4><?php echo esc_html('Archive Page:','variation-monster'); ?></h4>
                    <div class="quick-selectors-wrapper">
                        <div class="show-attribute-swatches-archive">
                            <label class="switch">
                                <input type="checkbox" value="attribute-archive" <?php if($showAttributeSwatchesArchive == "attribute-archive"): echo esc_attr("checked"); endif; ?>>
                                <span class="slider round"></span>
                            </label>
                            <span><?php echo esc_html('Show Attribute into Archive (Redirect)','variation-monster');?></span>
                        </div>
                        <div class="">
                            <label class="switch">
                                <input type="checkbox"  disabled>
                                <span class="slider round"></span>
                            </label>
                            <span><?php echo esc_html('Show Swatches Quick Cart into Archive','variation-monster');?></span>
                        </div>
                        <div class="show-attribute-swatches-archive">
                            <label class="switch">
                                <input type="checkbox" value="none" <?php if($showAttributeSwatchesArchive== "none"): echo esc_attr("checked"); endif; ?>>
                                <span class="slider round"></span>
                            </label>
                            <span><?php echo esc_html('None','variation-monster');?></span>
                        </div>
                    </div>
                </div>

                <div class="quick-selections" style="display: flex; gap: 17.4%; align-items: center">
                    <h4><?php echo wp_kses('Tooltip On: ','variation-monster');?></h4>
                    <div class="quick-selectors-wrapper">
                        <div class="globally-tooltip-on-off">
                            <label class="switch">
                                <input type="checkbox" name="globally-tooltip-on-off" <?php if( $globallyTooltipOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="select-variation-tooltip-bg-color"><strong> <?php echo wp_kses('Tooltip Background Color: ','variation-monster');?></strong></label>
                        <input id="select-variation-tooltip-bg-color" name="select-variation-tooltip-bg-color" value="<?php echo esc_attr( $selectVariationTooltipBgColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="select-variation-tooltip-text-color"><strong> <?php echo wp_kses('Tooltip Text Color: ','variation-monster');?></strong></label>
                        <input id="select-variation-tooltip-text-color" name="select-variation-tooltip-text-color" value="<?php echo esc_attr( $selectVariationTooltipTextColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="select-variation-button-bg-color"><strong> <?php echo wp_kses('Button Background Color: ','variation-monster');?></strong></label>
                        <input id="select-variation-button-bg-color" name="select-variation-button-bg-color" value="<?php echo esc_attr( $selectVariationButtonBgColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="select-variation-button-text-color"><strong> <?php echo wp_kses('Button Text Color: ','variation-monster');?></strong></label>
                        <input id="select-variation-button-text-color" name="select-variation-button-text-color" value="<?php echo esc_attr( $selectVariationButtonTextColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="image-color-height"><strong> <?php echo wp_kses('Image & Color Height (px): ','variation-monster');?></strong></label>
                        <input id="image-color-height" class="image-color-height" type="text" name="image-color-height" value="<?php echo esc_attr( $imageColorHeight ); ?>"  >
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="image-color-width"><strong> <?php echo wp_kses('Image & Color Width (px): ','variation-monster');?></strong></label>
                        <input id="image-color-width" class="image-color-width" type="text" name="image-color-width" value="<?php echo esc_attr( $imageColorWidth ); ?>"  >
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="image-color-border-radius"><strong> <?php echo wp_kses('Image & Color Border Radius (px): ','variation-monster');?></strong></label>
                        <input id="image-color-border-radius" class="image-color-border-radius" type="text" name="image-color-border-radius" value="<?php echo esc_attr( $imageColorBorderRadius ); ?>"  >
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="swatches-button-border-color"><strong> <?php echo wp_kses('Button Border Color: ','variation-monster');?></strong></label>
                        <input id="swatches-button-border-color" name="swatches-button-border-color" value="<?php echo esc_attr( $swatchesButtonBorderColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper">
                        <label for="selected-variation-button-border-color"><strong> <?php echo wp_kses(' Selected Button Border Color: ','variation-monster');?></strong></label>
                        <input id="selected-variation-button-border-color" name="selected-variation-button-border-color" value="<?php echo esc_attr( $selectedVariationButtonBorderColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="button-height"><strong> <?php echo wp_kses('Button Height (px): ','variation-monster');?></strong></label>
                        <input id="button-height" class="button-height" type="text" name="button-height" value="<?php echo esc_attr( $buttonHeight ); ?>"  >
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="button-width"><strong> <?php echo wp_kses('Button Width (px): ','variation-monster');?></strong></label>
                        <input id="button-width" class="button-width" type="text" name="button-width" value="<?php echo esc_attr( $buttonWidth ); ?>"  >
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="button-border-radius"><strong> <?php echo wp_kses('Button Border Radius (px): ','variation-monster');?></strong></label>
                        <input id="button-border-radius" class="button-border-radius" type="text" name="button-border-radius" value="<?php echo esc_attr( $buttonBorderRadius ); ?>"  >
                    </div>
                </div>

        </div>
    </div>

    <div id="select-variation-ul-li" class="tabcontent">
        <h2><?php echo esc_html('Select Variation List','variation-monster'); ?></h2>
        <div style="display: flex; gap: 30%">
            <div>
                <div id="quickAuthenticateWrapper">
                    <div>
                        <div class="quick-selections" style="display: flex; gap: 23.8%; align-items: center">
                            <h4><?php echo wp_kses('Variation List Enable: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="select-variation-template-on-off">
                                    <label class="switch">
                                        <input type="checkbox" name="select-variation-template-on-off" <?php if( $selectVariationTemplateOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- List Image Size -->
                        <div class="quick-selections quick-selections-style">
                            <h4><?php echo wp_kses('List Image Size: ','variation-monster');?></h4>

                            <div style="display: flex; gap: 80px;">
                                <select id="list-image-show" class="list-image-show">


                                    <?php
                                    $list_image_size_hook = [
                                        'thumbnail',
                                        'medium',
                                        'medium_large',
                                        'large',
                                        'woocommerce_thumbnail',
                                        'woocommerce_single',
                                        'woocommerce_gallery_thumbnail'
                                    ];

                                    $list_image_size_final_hook = apply_filters('variable_quick_cart_list_size_hook', $list_image_size_hook);

                                    foreach ($list_image_size_final_hook as $list_image_final_hook) {

                                        $formatted_list_image_size_hook_name = ucwords(str_replace('_', ' ', $list_image_final_hook));

                                        ?>
                                        <option value="<?php echo esc_attr($list_image_final_hook); ?>" <?php selected($listImageShow, $list_image_final_hook); ?>>
                                            <?php echo esc_html($formatted_list_image_size_hook_name); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>



                        <h3 style="color: red; margin-top: 20px;"><?php echo wp_kses('Variation list is enable, variation swatches ','variation-monster'); ?>
                        <br><?php echo wp_kses('will not work in single product page ','variation-monster'); ?></br>
                        </h3>

                        <div class="quick-selections quick-selections-style" style="display: flex; gap: 50%">
                            <div>
                                <h4><?php echo wp_kses('Variation List Template: ','variation-monster');?></h4>
                                <div >
                                    <select id="select-design-list" class="variation-list-template" style="outline: none" disabled>
                                        <option value="template_1" <?php selected($variationListTemplate, 'template_1'); ?>><?php echo wp_kses('Template 1','variation-monster');?></option>
                                        <option value="template_2" <?php selected($variationListTemplate, 'template_2'); ?>><?php echo wp_kses('Template 2','variation-monster');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="list-pagination"><strong> <?php echo wp_kses('Items Per Pages: ','variation-monster');?></strong></label>
                                <input id="list-pagination" class="list-pagination" type="number" min="1" name="list-pagination" value="<?php echo esc_attr( $listPagination ); ?>"  disabled>
                            </div>
                        </div>

                        <div class="quick-selections">
                            <div class="quick-selectors-wrapper m-top">
                                <label for="list-pagination-per-line-mobile"><strong> <?php echo wp_kses('Items Per Line for Mobile Version: ','variation-monster');?></strong></label>
                                <input id="list-pagination-per-line-mobile" class="list-pagination-per-line-mobile" type="number" min="1" name="list-pagination" value="<?php echo esc_attr( $listPaginationPerLineMobile ); ?>"  disabled>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 40%; align-items: center">
                            <h4><?php echo wp_kses('Show Label: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-label-show-on-off">
                                    <label class="switch">
                                        <input type="checkbox" name="list-label-show-on-off" <?php if( $listLabelOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 42%; align-items: center">
                            <h4><?php echo wp_kses('Show SKU: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-sku-show-on-off">
                                    <label class="switch">
                                        <input type="checkbox" name="list-sku-show-on-off" <?php if( $listSkuOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 40.6%; align-items: center">
                            <h4><?php echo wp_kses('Show Price: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-price-show-on-off">
                                    <label class="switch">
                                        <input type="checkbox" name="list-price-show-on-off" <?php if( $listPriceOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 34%; align-items: center">
                            <h4><?php echo wp_kses('Show Quantity: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-quantity-show-on-off">
                                    <label class="switch">
                                        <input type="checkbox" name="list-quantity-show-on-off" <?php if( $listQuantityOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 34%; align-items: center">
                            <h4><?php echo wp_kses('Show Attribute: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-attribute-show">
                                    <label class="switch">
                                        <input type="checkbox" name="list-attribute-show" <?php if( $listAttributeShow == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 42.5%; align-items: center">
                            <h4><?php echo wp_kses('Show Title: ','variation-monster');?></h4>
                            <div class="quick-selectors-wrapper">
                                <div class="list-title-show">
                                    <label class="switch">
                                        <input type="checkbox" name="list-title-show" <?php if( $listTitleShow == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="quick-selections" style="display: flex; gap: 17%; align-items: center">
                            <h4><?php echo wp_kses('Show Discount Badge: ','variation-monster');?>
                                <span class="discount-badge" data-tooltip="If discount available">?</span>
                            </h4>

                            <div class="quick-selectors-wrapper">
                                <div class="list-badge-show-on-off">
                                    <label class="switch">
                                        <input type="checkbox" id="discount-badge" name="list-badge-show-on-off" <?php if( $listBadgeShowOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="badge-all-settings" style="">
                            <div class="quick-selections" style="display: flex; gap: 15%; align-items: center">
                                <h4><?php echo wp_kses('Show Badge at Right Side: ','variation-monster');?></h4>
                                <div class="quick-selectors-wrapper">
                                    <div class="list-badge-show-right">
                                        <label class="switch">
                                            <input type="checkbox" name="list-badge-show-right" <?php if( $listBadgeShowRight == "true" ): echo esc_attr("checked"); endif; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="quick-selections" style="display: flex; gap: 13%; align-items: center">
                                <h4><?php echo wp_kses('Show Discount Price as Flat: ','variation-monster');?></h4>
                                <div class="quick-selectors-wrapper">
                                    <div class="list-badge-discount-flat-price">
                                        <label class="switch">
                                            <input type="checkbox" name="list-badge-discount-flat-price" <?php if( $listBadgeDiscountFlatPrice == "true" ): echo esc_attr("checked"); endif; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper m-top">
                                    <label for="list-for-percent"><strong> <?php echo wp_kses('For Percent Label: ','variation-monster');?></strong></label>
                                    <input id="list-for-percent" class="list-for-percent" type="text" name="list-for-percent" value="<?php echo esc_attr( $listForPercent ); ?>"  >
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper m-top">
                                    <label for="list-for-flat"><strong> <?php echo wp_kses('For Flat Label: ','variation-monster');?></strong></label>
                                    <input id="list-for-flat" class="list-for-flat" type="text" name="list-for-flat" value="<?php echo esc_attr( $listForFlat ); ?>"  >
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper">
                                    <label for="list-badge-bg-color"><strong> <?php echo wp_kses('Badge Background Color: ','variation-monster');?></strong></label>
                                    <input id="list-badge-bg-color" name="list-badge-bg-color" value="<?php echo esc_attr( $listBadgeBgColor ); ?>"  data-jscolor="{}">
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper">
                                    <label for="list-badge-text-color"><strong> <?php echo wp_kses('Badge Text Color: ','variation-monster');?></strong></label>
                                    <input id="list-badge-text-color" name="list-badge-text-color" value="<?php echo esc_attr( $listBadgeTextColor ); ?>"  data-jscolor="{}">
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper m-top">
                                    <label for="list-badge-height"><strong> <?php echo wp_kses('Badge Height (px): ','variation-monster');?></strong></label>
                                    <input id="list-badge-height" class="list-badge-height" type="text" name="list-badge-height" value="<?php echo esc_attr( $listBadgeHeight ); ?>"  >
                                </div>
                            </div>

                            <div class="quick-selections">
                                <div class="quick-selectors-wrapper m-top">
                                    <label for="list-badge-width"><strong> <?php echo wp_kses('Badge Width (px): ','variation-monster');?></strong></label>
                                    <input id="list-badge-width" class="list-badge-width" type="text" name="list-badge-width" value="<?php echo esc_attr( $listBadgeWidth ); ?>"  >
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: end; position: absolute; left: 689px">
                <div id="show-template-image-list"></div>
            </div>
        </div>
    </div>

    <div id="variation-gallery" class="tabcontent" style="">

        <div id="quickAuthenticateWrapper">
            <h2><?php echo esc_html('Variation Gallery Setting','variation-monster'); ?></h2>
            <div>
                <div class="quick-selections" style="display: flex; gap: 10%; align-items: center">
                    <h4><?php echo wp_kses('Variation Gallery On: ','variation-monster');?></h4>
                    <div class="quick-selectors-wrapper">
                        <div class="variation-gallery-on-off">
                            <label class="switch">
                                <input type="checkbox" id="variation-gallery-on-off" name="variation-gallery-on-off" <?php if( $variationGalleryOnOff == "true" ): echo esc_attr("checked"); endif; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="quick-selections quick-selections-style" style="display: flex; gap: 50%">

                    <div>
                        <h4><?php echo wp_kses('Gallery Style Template: ','variation-monster');?></h4>

                        <div >
                            <select id="gallery-style-template" class="gallery-style-template" style="outline: none" disabled>
                                <option value="template_1" <?php selected($galleryStyleTemplate, 'template_1'); ?>><?php echo wp_kses('Template 1','variation-monster');?></option>
                                <option value="template_2" <?php selected($galleryStyleTemplate, 'template_2'); ?>><?php echo wp_kses('Template 2','variation-monster');?></option>
                                <option value="template_3" <?php selected($galleryStyleTemplate, 'template_3'); ?>><?php echo wp_kses('Template 3','variation-monster');?></option>
                                <option value="template_4" <?php selected($galleryStyleTemplate, 'template_4'); ?>><?php echo wp_kses('Template 4','variation-monster');?></option>
                                <option value="template_5" <?php selected($galleryStyleTemplate, 'template_5'); ?>><?php echo wp_kses('Template 5','variation-monster');?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Gallery Image Size -->
                <div class="quick-selections quick-selections-style">
                    <h4><?php echo wp_kses('Gallery Image Size: ','variation-monster');?></h4>

                    <div style="display: flex; gap: 80px;">
                        <select id="gallery-image-show" class="gallery-image-show" disabled>

                            <?php
                            $gallery_image_size_hook = [
                                'thumbnail',
                                'medium',
                                'medium_large',
                                'large',
                                'woocommerce_thumbnail',
                                'woocommerce_single',
                                'woocommerce_gallery_thumbnail'
                            ];

                            $gallery_image_size_final_hook = apply_filters('variable_quick_cart_carousel_size_hook', $gallery_image_size_hook);

                            foreach ($gallery_image_size_final_hook as $gallery_image_final_hook) {

                                $formatted_gallery_image_size_hook_name = ucwords(str_replace('_', ' ', $gallery_image_final_hook));

                                ?>
                                <option value="<?php echo esc_attr($gallery_image_final_hook); ?>" <?php selected($galleryImageShow, $gallery_image_final_hook); ?>>
                                    <?php echo esc_html($formatted_gallery_image_size_hook_name); ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="gallery-navigation-button-icon-color"><strong> <?php echo wp_kses('Gallery Navigation Button Icon Color: ','variation-monster');?></strong></label>
                        <input id="gallery-navigation-button-icon-color" name="gallery-navigation-button-icon-color" value="<?php echo esc_attr( $galleryNavigationButtonIconColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="gallery-navigation-button-icon-hover-color"><strong> <?php echo wp_kses('Gallery Navigation Button Icon Hover Color: ','variation-monster');?></strong></label>
                        <input id="gallery-navigation-button-icon-hover-color" name="gallery-navigation-button-icon-hover-color" value="<?php echo esc_attr( $galleryNavigationButtonIconHoverColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="gallery-navigation-button-background-color"><strong> <?php echo wp_kses('Gallery Navigation Button Background Color: ','variation-monster');?></strong></label>
                        <input id="gallery-navigation-button-background-color" name="gallery-navigation-button-background-color" value="<?php echo esc_attr( $galleryNavigationButtonBgColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

                <div class="quick-selections">
                    <div class="quick-selectors-wrapper m-top">
                        <label for="gallery-navigation-button-background-hover-color"><strong> <?php echo wp_kses('Gallery Navigation Button Background Hover Color: ','variation-monster');?></strong></label>
                        <input id="gallery-navigation-button-background-hover-color" name="gallery-navigation-button-background-hover-color" value="<?php echo esc_attr( $galleryNavigationButtonBgHoverColor ); ?>"  data-jscolor="{}">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="attribute-gallery" class="tabcontent" style="">

        <div id="quickAuthenticateWrapper">
            <h2><?php echo esc_html('Attribute Gallery Setting','variation-monster'); ?></h2>
            <div>
                <div class="quick-selections" style="display: flex; gap: 10%; align-items: center">
                    <h4><?php echo wp_kses('Attribute Gallery On: ','variation-monster');?></h4>
                    <div class="quick-selectors-wrapper">
                        <div class="attribute-gallery-on-off">
                            <label class="switch">
                                <input type="checkbox" id="attribute-gallery-on-off" name="attribute-gallery-on-off" disabled>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Gallery Image Size -->
                <div class="quick-selections quick-selections-style">
                    <h4><?php echo wp_kses('Attribute Gallery Image Size: ','variation-monster');?></h4>

                    <div style="display: flex; gap: 80px;">
                        <select id="attribute-gallery-image-show" class="attribute-gallery-image-show" disabled>


                            <?php
                            $attribute_gallery_image_size_hook = [
                                'thumbnail',
                                'medium',
                                'medium_large',
                                'large',
                                'woocommerce_thumbnail',
                                'woocommerce_single',
                                'woocommerce_gallery_thumbnail'
                            ];

                            $attribute_gallery_image_size_final_hook = apply_filters('attribute_gallery_image_size_hook', $attribute_gallery_image_size_hook);

                            foreach ($attribute_gallery_image_size_final_hook as $attribute_gallery_image_final_hook) {

                                $formatted_attribute_gallery_image_size_hook_name = ucwords(str_replace('_', ' ', $attribute_gallery_image_final_hook));

                                ?>
                                <option value="<?php echo esc_attr($attribute_gallery_image_final_hook); ?>" <?php selected($attributeGalleryImageShow, $attribute_gallery_image_final_hook); ?>>
                                    <?php echo esc_html($formatted_attribute_gallery_image_size_hook_name); ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="support" class="tabcontent">
        <div id="quickAuthenticateWrapper">

            <div class="container-for-support">
                <div class="grid-support">
                    <div class="support-item">
                        <strong><i class="fas fa-globe"></i> <?php echo esc_html('Website:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://www.wooxperto.com/" target="_blank"><?php echo esc_html('wooxperto.com','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Visit our official website for live chat and more information, tutorials, and resources.','product-variation-table-with-quick-cart'); ?></p>
                    </div>

                    <div class="support-item">
                        <strong><i class="fab fa-facebook-f"></i> <?php echo esc_html('Facebook:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://www.facebook.com/wooxpertollc" target="_blank"><?php echo esc_html('Follow us','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Join our community on Facebook for support, updates, and discussions.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fab fa-whatsapp"></i> <?php echo esc_html('WhatsApp:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://wa.me/01926167151" target="_blank"><?php echo esc_html('Chat Now ','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Get instant support by chatting with us on WhatsApp. We’re here to help!','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fas fa-envelope"></i> <?php echo esc_html('Email:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="mailto:support@wooxperto.com"><?php echo esc_html('support@wooxperto.com','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Feel free to reach out to us via email for any inquiries or support requests.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fab fa-linkedin-in"></i> <?php echo esc_html('LinkedIn:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://www.linkedin.com/company/wooxpertollc/" target="_blank"><?php echo esc_html('Connect on LinkedIn','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Let’s connect on LinkedIn for networking, updates, and professional support.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fab fa-twitter"></i> <?php echo esc_html('Twitter:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://x.com/wooxpertollc" target="_blank"><?php echo esc_html('Follow us','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Stay updated with the latest news and announcements by following us on Twitter.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fab fa-youtube"></i> <?php echo esc_html('YouTube:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://www.youtube.com/@wooxpertollc" target="_blank"><?php echo esc_html('Subscribe','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('Check out our YouTube channel for video tutorials and product showcases.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                    <div class="support-item">
                        <strong><i class="fab fa-instagram"></i> <?php echo esc_html('Instagram:','product-variation-table-with-quick-cart'); ?></strong>
                        <a href="https://www.instagram.com/wooxpertollc" target="_blank"><?php echo esc_html('Follow us','product-variation-table-with-quick-cart'); ?></a>
                        <p><?php echo esc_html('See behind-the-scenes content and our latest updates on Instagram.','product-variation-table-with-quick-cart'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="license" class="tabcontent">


    </div>


<?php wp_nonce_field( 'quick_admin_nonce_action', 'quick_admin_nonce' ); ?>
  <!-- save Button -->
    <button style="position: fixed; bottom: 20px; right: 20px; display: flex; justify-content: center; align-items: center; padding: 10px 20px; background-color: #6033E7; color: white; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);" class="buttonload">
        <?php echo esc_html('Save', 'variation-monster'); ?>
    </button>

</div>
