<?php

global $product;
global $post;
if (isset($product) && $product->is_type("variable")) {
    $product_id                     = $product->get_id();
    $enable_global_stock_management = $product->get_manage_stock();
    $global_stock_quantity          = $enable_global_stock_management ? $product->get_stock_quantity() : null;
    $all_attributes                 = $product->get_attributes();
    $variableSetting                = get_option('variable_all_checked', array());
    $quickTableOnOff                = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
    $imageHideShow                  = isset($variableSetting['imageHideShow']) ? $variableSetting['imageHideShow'] : 'true';
    $skuHideShow                    = isset($variableSetting['skuHideShow']) ? $variableSetting['skuHideShow'] : 'true';
    $allAttributeHideShow           = isset($variableSetting['allAttributeHideShow']) ? $variableSetting['allAttributeHideShow'] : 'true';
    $priceHideShow                  = isset($variableSetting['priceHideShow']) ? $variableSetting['priceHideShow'] : 'true';
    $quantityHideShow               = isset($variableSetting['quantityHideShow']) ? $variableSetting['quantityHideShow'] : 'true';
    $actionHideShow                 = isset($variableSetting['actionHideShow']) ? $variableSetting['actionHideShow'] : 'true';
    $onSaleHideShow                 = isset($variableSetting['onSaleHideShow']) ? $variableSetting['onSaleHideShow'] : 'true';
    $searchOptionHideShow           = isset($variableSetting['searchOptionHideShow']) ? $variableSetting['searchOptionHideShow'] : 'true';
    $designSingleProductPageMobile  = isset($variableSetting['designSingleProductPageMobile']) ? $variableSetting['designSingleProductPageMobile'] : 'template_1';
    $cartButtonText                 = isset($variableSetting['cartButtonText']) ? $variableSetting['cartButtonText'] : 'Add-to-cart';
    $onSaleNameChange               = isset($variableSetting['onSaleNameChange']) ? $variableSetting['onSaleNameChange'] : 'On Sale';
    $searchOptionTextChange         = isset($variableSetting['searchOptionTextChange']) ? $variableSetting['searchOptionTextChange'] : 'Search...';
    $showPopUpImage                 = isset($variableSetting['showPopUpImage']) ? $variableSetting['showPopUpImage'] : 'true';
    $tableTemplateTwoEnable         = isset($variableSetting['tableTemplateTwoEnable']) ? $variableSetting['tableTemplateTwoEnable'] : '';
    $titleHideShow                  = isset($variableSetting['titleHideShow']) ? $variableSetting['titleHideShow'] : 'true';
    $descriptionHideShow            = isset($variableSetting['descriptionHideShow']) ? $variableSetting['descriptionHideShow'] : 'true';
    $weightDimensionsHideShow       = isset($variableSetting['weightDimensionsHideShow']) ? $variableSetting['weightDimensionsHideShow'] : 'true';
    $designAddCartTableTemplate2    = isset($variableSetting['designAddCartTableTemplate2']) ? $variableSetting['designAddCartTableTemplate2'] : 'template_1';
    $selectAllNameChange            = isset($variableSetting['selectAllNameChange']) ? $variableSetting['selectAllNameChange'] : 'Select All';
    $showDoublePrice                = isset($variableSetting['showDoublePrice']) ? $variableSetting['showDoublePrice'] : 'true';
    $stockStatusHideShow            = isset($variableSetting['stockStatusHideShow']) ? $variableSetting['stockStatusHideShow'] : 'true';
    $quickCartIcon                  = isset($variableSetting['quickCartIcon']) ? $variableSetting['quickCartIcon'] : 'fa fa-shopping-cart';
    $quickCartIconImageLink         = isset($variableSetting['quickCartIconImageLink']) ? $variableSetting['quickCartIconImageLink'] : '';
    $popUPImageShow                 = isset($variableSetting['popUPImageShow']) ? $variableSetting['popUPImageShow'] : 'thumbnail';
    $tableRowPagination             = isset($variableSetting['tableRowPagination']) ? $variableSetting['tableRowPagination'] : '5';
    $metaTableTemplate2Enable       = get_post_meta($post->ID, '_table_template2_is_enabled', true);
    $metaTableTemplate2CartStyle    = get_post_meta($post->ID, '_table_template2_cart_section_style_template', true);
    $variations                     = $product->get_available_variations();
    $variation_count                = count($variations);

    ?>
    <div class="table-template-max-width template-one-table">

        <div id="loading-spinner-pagination-table" style="display: none; text-align: center;">
            <i class="fa fa-spinner fa-spin "></i>
        </div>

        <div class="table-before" >

            <?php if ($onSaleHideShow === "true"){
                ?>
                <div style="display: inline-flex; align-items: baseline; gap: 10px ; margin-right: 10px; margin-left: 10px">
                    <input id="stock_status" type="checkbox"  name=""  style="outline: none">
                    <p for="stock_status" ><?php echo esc_html($onSaleNameChange); ?></p>
                </div>
                <?php
            }?>

            <?php if ($searchOptionHideShow === "true"){
                ?>
                <div class="search_option" style="display: inline-flex; align-items: baseline; gap: 10px">
                    <input class="variation-table-search" type="text" placeholder="<?php echo esc_html($searchOptionTextChange); ?>" name="search" id="variation-search">
                </div>
                <?php
            }?>
        </div>
        <table id="quick-variable-table" class="table-template1" data-pagination-table="<?php echo esc_attr($tableRowPagination); ?>" data-Variation-count="<?php echo esc_attr($variation_count); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
            <tr>

                <?php if ($imageHideShow === "true"){
                    ?>
                    <th><?php esc_html_e('Image', 'variation-monster'); ?></th>
                    <?php
                }?>

                <?php if ($skuHideShow === "true"){
                    ?>

                    <th>
                        <span style="display: inline-block; margin-top: 9px">
                            <?php esc_html_e('SKU', 'variation-monster'); ?>
                        </span>
                        <span style=" float: right; display: grid;" id="sku-sort-arrows">
                            <span style="height: 10px" class="dashicons dashicons-arrow-up" id="sort-arrow-up"></span>
                            <span style="height: 10px" class="dashicons dashicons-arrow-down" id="sort-arrow-down"></span>
                        </span>
                    </th>

                    <?php
                }?>

                <?php if ($allAttributeHideShow === "true"){
                    foreach ($all_attributes as $attribute_name => $attribute) {

                        $reflection   = new ReflectionClass($attribute);
                        $dataProperty = $reflection->getProperty("data");
                        $dataProperty->setAccessible(true);
                        $data = $dataProperty->getValue($attribute);

                        if (taxonomy_exists($attribute_name) && isset($data["variation"]) && $data["variation"]) {
                            $taxonomy = get_taxonomy($attribute_name);
                            $label    = str_replace("Product ", "", $taxonomy->label);

                            ?>
                            <th >
                                <span style="display: inline-block; margin-top: 9px">
                                    <?php echo esc_html(ucfirst($label)); ?>
                                </span>
                                <span style="float: right; display: grid" class="attribute-sort-arrows" data-attribute="<?php echo esc_attr($attribute_name); ?>">
                                    <span style="height: 10px" class="dashicons dashicons-arrow-up" id="sort-toggle-<?php echo esc_attr($attribute_name); ?>"></span>
                                    <span style="height: 10px" class="dashicons dashicons-arrow-down" id="sort-toggle-<?php echo esc_attr($attribute_name); ?>"></span>
                                </span>
                            </th>
                            <?php
                        } elseif (isset($data["variation"]) && $data["variation"]) {
                            ?>
                            <th >
                                <span style="display: inline-block; margin-top: 9px">
                                    <?php echo esc_html(ucfirst($attribute_name)); ?>
                                </span>
                                <span style="float: right; display: grid" class="attribute-sort-arrows" data-attribute="<?php echo esc_attr($attribute_name); ?>">
                                    <span style="height: 10px" class="dashicons dashicons-arrow-up" id="sort-arrow-up-<?php echo esc_attr($attribute_name); ?>"></span>
                                    <span style="height: 10px" class="dashicons dashicons-arrow-down" id="sort-arrow-down-<?php echo esc_attr($attribute_name); ?>"></span>
                                </span>
                            </th>
                            <?php
                        }
                    }
                }
                ?>

                <?php if ($priceHideShow === "true"){
                    ?>
                    <th >
                        <span style="display: inline-block; margin-top: 9px">
                        <?php esc_html_e('Price', 'variation-monster'); ?>
                        </span>
                        <span style="float: right; display: grid" id="price-sort-arrows">
                            <span style="height: 10px" class="dashicons dashicons-arrow-up" id="price-sort-arrow-up"></span>
                            <span style="height: 10px" class="dashicons dashicons-arrow-down" id="price-sort-arrow-down"></span>
                        </span>
                    </th>
                    <?php
                }?>

                <?php if ($quantityHideShow === "true"){
                    ?>
                    <th><?php esc_html_e('Quantity', 'variation-monster'); ?></th>
                    <?php
                }?>

                <?php if ($actionHideShow === "true"){
                    ?>
                    <th><?php esc_html_e('Action', 'variation-monster'); ?></th>
                    <?php
                }?>

            </tr>

            <?php
            $variations = $product->get_available_variations();

            usort($variations, function($a, $b) {
                $skuA = $a['sku'];
                $skuB = $b['sku'];
                return strcmp($skuA, $skuB);
            });

            usort($variations, function($a, $b) {

                $variationA = new WC_Product_Variation($a['variation_id']);
                $variationB = new WC_Product_Variation($b['variation_id']);
                $priceA     = $variationA->get_price();
                $priceB     = $variationB->get_price();

                if ($priceA === false || $priceB === false) {
                    return 0;
                }
                return $priceA - $priceB;
            });

            foreach ($all_attributes as $attribute_name => $attribute) {
                usort($variations, function($a, $b) use ($attribute_name) {

                    $attrA = $a['attributes'][$attribute_name] ?? '';
                    $attrB = $b['attributes'][$attribute_name] ?? '';

                    return strcmp($attrA, $attrB);
                });
            }

            $variations_for_pagination = $product->get_available_variations();
            $current_variation         = array_slice($variations_for_pagination, 0, $tableRowPagination);

            foreach ($current_variation as $var) {
                $variation_id             = $var['variation_id'];
                $variation                = new WC_Product_Variation($variation_id);
                $variation_stock_quantity = $variation->get_manage_stock() ? $variation->get_stock_quantity() : null;

                $gallery_images = get_post_meta($variation_id, '_variation_gallery_images', true);
                $image_ids      = $gallery_images ? explode(',', $gallery_images) : [];
                $thumbnail_id   = $variation->get_image_id();
                $thumbnail_url  = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, "thumbnail") : '';
                $stock_status   = $variation->is_on_sale();
                ?>
                <tr class="variation-row" data-variation-id="<?php echo esc_attr($variation_id); ?>" data-stock-status="<?php echo esc_attr($stock_status); ?>" data-gallery-images="<?php echo esc_attr(wp_json_encode($image_ids)); ?>">

                    <?php if ($imageHideShow === "true") { ?>
                        <td class="table_image">
                            <?php
                            echo wp_get_attachment_image(
                                $thumbnail_id,
                                esc_attr($popUPImageShow),
                                false,
                                array(
                                    'alt' => esc_attr($variation->get_name()),
                                    'class' => 'gallery-trigger',
                                    'style' => 'cursor: pointer; ',
                                    'data-gallery' => esc_attr(wp_json_encode(array_map(function ($image_id) use ($popUPImageShow) {
                                        $image_size = in_array($popUPImageShow, ['thumbnail', 'medium', 'large', 'full']) ? $popUPImageShow : 'thumbnail';
                                        return wp_get_attachment_image_src($image_id, $image_size)[0] ?? '';
                                    }, $image_ids))),

                                )
                            );
                            ?>
                        </td>

                        <!-- Modal Image Popup -->
                        <?php if ($showPopUpImage === "true"){
                            ?>
                            <div id="imagePopup" class="popup-container">
                                <div class="popup-content">
                                    <span class="close-btn">&times;</span>
                                    <button style="outline: none;" id="prevImage" class="lightbox-nav prev">⟨</button>

                                    <button style="outline: none" id="nextImage" class="lightbox-nav next">⟩</button>
                                </div>
                            </div>
                            <?php
                        }?>

                        <?php
                    }?>

                    <?php if ($skuHideShow === "true"){
                        ?>
                        <td style="padding: 20px; text-align: center" class="quick-variable-title variable-sku"><?php echo esc_html($variation->get_sku()); ?></td>
                        <?php
                    }?>


                    <?php if ($allAttributeHideShow === "true"){
                        foreach ($all_attributes as $attribute_name => $attribute) {
                            $attribute_value = $variation->get_attribute($attribute_name);

                            if (empty($attribute_value)) {
                                echo "<td><select class='quick-attribute-select' name='attribute_" . esc_attr($attribute_name) . "' data-attribute-name='" . esc_attr($attribute_name) . "'>";

                                if ($attribute->is_taxonomy()) {
                                    $options = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'names']);
                                } else {
                                    $options = $attribute->get_options();
                                }

                                foreach ($options as $option) {
                                    echo "<option value='" . esc_attr($option) . "'>" . esc_html($option) . "</option>";
                                }

                                echo "</select></td>";
                            } else {

                                echo "<td  class='quick-variable-title quick-attribute-text'  data-attribute-name='" . esc_attr($attribute_name) . "' name='attribute_" . esc_attr($attribute_name) . "'>" . esc_html($attribute_value) . "</td>";
                            }
                        }
                    }
                    ?>

                    <?php if ($priceHideShow === "true"){
                        ?>
                        <td class='variable-price quick-variable-title'><?php
                            if ($showDoublePrice === 'true'){
                                ?> <span><?php echo wp_kses_post($variation->get_price_html()); ?> </span> <?php
                            }else{
                                $sale_price = $variation->get_sale_price();
                                if($sale_price) {
                                    ?> <span><?php echo wp_kses_post(wc_price($sale_price)); ?> </span> <?php
                                } else {
                                    ?> <span><?php echo wp_kses_post(wc_price($variation->get_regular_price()));?> </span> <?php
                                }
                            }
                            $sale_price_available_sorting = $variation->get_sale_price();
                            if ($sale_price_available_sorting){
                                ?>
                                <span class="variable-sale-price" style="display: none">
                                    <?php
                                    echo wp_kses_post(wc_price($sale_price_available_sorting));
                                    ?>
                                </span>
                            <?php }
                            ?></td>
                        <?php
                    }?>

                    <?php if ($quantityHideShow === "true"){
                        ?>
                        <td>
                            <div class="quick-quantity-container" style="margin-bottom: 10px">
                                <button class="quick-quantity-decrease" id="decrease">-</button>
                                <input  type="text" id="quantity" autocomplete="off" class="quick-quantity-input" value="1" data-max="<?php echo esc_attr($variation_stock_quantity ?: $global_stock_quantity ?: 99); ?>">
                                <button class="quick-quantity-increase" id="increase">+</button>
                            </div>
                            <div class="quick-cart-notification quick-hidden"></div>
                        </td>
                        <?php
                    }?>

                    <?php if ($actionHideShow === "true"){
                        ?>
                        <td class="stock-notification" style="padding: 20px; text-align: center ; justify-items: center">
                            <?php if (0 === ($variation_stock_quantity) || $variation->get_stock_status() === "outofstock") : ?>
                                <p><?php esc_html_e('Out Of Stock', 'variation-monster'); ?></p>
                            <?php else : ?>
                                <button style="width: 100%; text-align: center" class="quick-add-to-cart" data-productId="<?php echo esc_attr($product->get_id()); ?>" data-variationId="<?php echo esc_attr($variation_id); ?>">
                                    <?php if (!empty($quickCartIconImageLink)): ?>
                                        <span class="add-to-cart-icon-image-render-from-js" data-add-to-cart-icon-image="<?php echo esc_url($quickCartIconImageLink); ?>"></span>
                                    <?php else: ?>
                                        <i class="<?php echo esc_attr($quickCartIcon); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <span style="margin-left: 3px"><?php echo esc_html($cartButtonText); ?></span>
                                </button>
                            <?php endif; ?>
                        </td>
                        <?php
                    }?>

                </tr>
                <?php
            }
            ?>
        </table>

        <!-- Pagination Controls -->
        <div id="pagination">
            <button style="margin-right: 5px" id="prevPage" disabled><?php esc_html_e('Previous', 'variation-monster'); ?></button>
            <button id="nextPage"><?php esc_html_e('Next', 'variation-monster'); ?></button>
        </div>
    </div>
    <?php
}

?>

<script>
    jQuery(document).ready(function ($) {
        if($('.table-template2').length === 0){
            var $table        = $("#quick-variable-table");
        }
        const rowsPerPage = $table.data('pagination-table') || 5;
        const totalRows   = $table.data('variation-count');
        var currentPage   = 1;
        var totalPages    = 1;
        var productId     = $table.data('product-id');

        if (totalRows <= rowsPerPage) {
            $("#pagination").hide();
        }

        function loadPage(page) {
            $.ajax({
                url: quick_front_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_variations',
                    product_id: productId,
                    page: page,
                    pagination_nonce: quick_front_ajax_obj.nonce,
                },
                success: function (response) {
                    if (response.success) {
                        $("#loading-spinner-pagination-table").hide();
                        $table.find('tr.variation-row').remove();
                        $table.append(response.data.html);
                        totalPages = response.data.total_pages;
                        currentPage = response.data.current_page;
                        updatePaginationControls();
                        reapplySorting();
                    } else {
                        alert('Failed to load variations.');
                    }
                },
                error: function () {
                    alert('Failed to load variations.');
                }
            });
        }

        function updatePaginationControls() {
            $("#prevPage").prop("disabled", currentPage === 1);
            $("#nextPage").prop("disabled", currentPage === totalPages);
            $("#pageInfo").text(`Page ${currentPage} of ${totalPages}`);
        }

        $("#prevPage").click(function () {

            $("#loading-spinner-pagination-table").show();
            $(".table-template-max-width").css("opacity", "0.5");

            setTimeout(function() {
                $("#loading-spinner-pagination-table").hide();
                $(".table-template-max-width").css("opacity", "1");
            }, 1000);


            if (currentPage > 1) {
                currentPage--;
                resetCheckboxes()
                loadPage(currentPage);
            }
        });

        $("#nextPage").click(function () {

            $("#loading-spinner-pagination-table").show();
            $("#quick-variable-table").css("opacity", "0.5");

            setTimeout(function() {
                $("#loading-spinner-pagination-table").hide();
                $("#quick-variable-table").css("opacity", "1");
            }, 1000);

            if (currentPage) {
                currentPage++;
                resetCheckboxes()
                loadPage(currentPage);
            }
        });

        function reapplySorting() {
            const headers = $table.find("th");
            headers.each(function () {
                const header = $(this);
                header.off("click");
                header.on("click", function () {
                    const column = getColumn(header);
                    let currentSort = header.attr("data-sort");

                    headers.each(function () {
                        resetHeader($(this)); // Ensure this function exists
                    });

                    if (currentSort === "asc") {
                        sortByColumn(column, "desc");
                        setActiveHeader(header, "desc");
                    } else if (currentSort === "desc") {
                        resetSortOrder();
                    } else {
                        sortByColumn(column, "asc");
                        setActiveHeader(header, "asc");
                    }
                });
            });

            resetSortOrder();
        }

        function sortByColumn(column, order) {
            const rows = $table.find(".variation-row").toArray();
            rows.sort((a, b) => {
                let cellA, cellB;
                if (column === "sku") {
                    cellA = $(a).find(".variable-sku").text().trim();
                    cellB = $(b).find(".variable-sku").text().trim();
                    return order === "asc" ? cellA.localeCompare(cellB, undefined, { numeric: true }) : cellB.localeCompare(cellA, undefined, { numeric: true });
                } else if (column === "price") {
                    let salePriceA    = a.querySelector('.variable-sale-price')?.textContent.trim();
                    let regularPriceA = a.querySelector('.variable-price')?.textContent.trim();
                    let salePriceB    = b.querySelector('.variable-sale-price')?.textContent.trim();
                    let regularPriceB = b.querySelector('.variable-price')?.textContent.trim();

                    // Convert prices to numbers, prioritize sale price if available
                    cellA = parseFloat(salePriceA?.replace(/[^0-9.]/g, '') || regularPriceA?.replace(/[^0-9.]/g, '') || 0);
                    cellB = parseFloat(salePriceB?.replace(/[^0-9.]/g, '') || regularPriceB?.replace(/[^0-9.]/g, '') || 0);

                    // cellA = parseFloat($(a).find(".variable-price").text().replace(/[^0-9.-]+/g, "")) || 0;
                    // cellB = parseFloat($(b).find(".variable-price").text().replace(/[^0-9.-]+/g, "")) || 0;
                    return order === "asc" ? cellA - cellB : cellB - cellA;
                } else {
                    cellA = $(a).find(`[data-attribute-name="${column}"]`).text().trim() || "";
                    cellB = $(b).find(`[data-attribute-name="${column}"]`).text().trim() || "";
                    return order === "asc" ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                }
            });

            rows.forEach(row => $table.append(row));
        }

        function getColumn(header) {
            const attributeSort = header.find("[data-attribute]").attr("data-attribute");
            if (attributeSort) {
                return attributeSort;
            }
            if (header.find("#sku-sort-arrows").length) {
                return "sku";
            }
            if (header.find("#price-sort-arrows").length) {
                return "price";
            }
            return null;
        }

        function setActiveHeader(header, order) {
            resetAllHeaders();
            header.attr("data-sort", order);
            const arrows = header.find(".dashicons");

            if (arrows.length > 1) {
                $(arrows[0]).css("color", order === "asc" ? "#B2B2B2" : "#E5E5E5");
                $(arrows[1]).css("color", order === "desc" ? "#B2B2B2" : "#E5E5E5");
            }
        }

        function resetAllHeaders() {
            $table.find("th").each(function () {
                $(this).attr("data-sort", "none");
                $(this).find(".dashicons").css("color", "#E5E5E5");
            });
        }

        function resetSortOrder() {
            sortByColumn("sku", "asc");
            const skuHeader = $table.find("#sku-sort-arrows").closest("th");
            if (skuHeader.length) {
                setActiveHeader(skuHeader, "asc");
            }
        }

        function resetHeader(header) {
            header.attr("data-sort", "none");
            header.find(".dashicons").css("color", "#E5E5E5");
        }

        function updateBulkCheckbox() {
            if ($('.bulk_cart:checked').length > 0) {
                $('.bulk-add-to-cart').show();
            } else {
                $('.bulk-add-to-cart').hide();
            }
        }

        function resetCheckboxes() {
            $('#bulk_checkbox_select_all').prop('checked', false);
            $('.bulk_cart').prop('checked', false);
            updateBulkCheckbox();
        }

        $('#bulk_checkbox_select_all').on('change', function () {
            var isChecked = $(this).prop('checked');
            $('.bulk_cart').prop('checked', isChecked);
            updateBulkCheckbox();
        });

        $(document).on('change', '.bulk_cart', function () {
            var allChecked = $('.bulk_cart').length === $('.bulk_cart:checked').length;
            $('#bulk_checkbox_select_all').prop('checked', allChecked);
            updateBulkCheckbox();
        });


        reapplySorting();

        // if ($table.length > 0) {
        //     loadPage(currentPage);
        // }
    });
</script>
