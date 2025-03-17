<!--Inc/Templates/Variable-single-table.php-->

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
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999999999999999999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        text-align: center;
        margin: auto;
        position: relative;
        margin-top: 10%;
    }

    .close-modal {
        position: absolute;
        top: 1px;
        right: 8px;
        font-size: 30px;
        cursor: pointer;
    }

    .load-more-description {
        color: #0071a1;
        text-decoration: underline;
        cursor: pointer;
    }

    .description-container {
        max-width: 400px; /* Adjust width to your layout */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        line-height: 1.5em;
    }

    .load-more-description {
        color: #0071a1;
        text-decoration: underline;
        cursor: pointer;
    }


</style>


<script>

    //  Table Template description modal

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('descriptionModal');
        const fullDescriptionContent = document.getElementById('fullDescriptionContent');
        const closeModal = document.querySelector('.close-modal');

        // Use event delegation for dynamically loaded elements
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('load-more-description')) {
                e.preventDefault();
                const description = e.target.getAttribute('data-description');
                fullDescriptionContent.textContent = description;
                modal.style.display = 'block';
            }
        });

        if (closeModal) {
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });



    document.addEventListener('DOMContentLoaded', () => {
        // Select the popup-content div
        const popupContentDiv = document.querySelector('.popup-content');

        // Check if the div exists
        if (popupContentDiv) {
            const imgElement = document.createElement('img');
            imgElement.id = 'popupImage';
            imgElement.alt = 'Popup Image';
            imgElement.style.objectFit = 'contain';

            // Append the img element to the popup-content div
            popupContentDiv.appendChild(imgElement);
        }
    });



    // Popup image on the table.
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('.gallery-trigger');
        const popup = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');
        const closeBtn = document.querySelector('.close-btn');
        const nextImage = document.getElementById('nextImage');
        const prevImage = document.getElementById('prevImage');
        let gallery = [];
        let currentIndex = 0;

        // Function to load an image into the popup
        function loadImage(index) {
            if (index < 0 || index >= gallery.length) return; // Avoid index out of bounds
            currentIndex = index;
            popupImage.src = gallery[currentIndex];
            updateNavigationButtons();
        }

        // Update navigation buttons visibility
        function updateNavigationButtons() {
            if (gallery.length <= 1) {
                nextImage.style.display = 'none';
                prevImage.style.display = 'none';
            } else {
                nextImage.style.display = currentIndex < gallery.length - 1 ? 'block' : 'none';
                prevImage.style.display = currentIndex > 0 ? 'block' : 'none';
            }
        }

        // Event listener for each image in the table
        document.addEventListener('click', (event) => {
            const image = event.target.closest('.gallery-trigger');

            if (image) {
                const galleryImages = JSON.parse(image.getAttribute('data-gallery')) || [];
                const galleryOnOff = image.getAttribute('data-gallery-onoff');

                if (galleryImages.length > 0 && galleryOnOff === 'true') {
                    gallery = galleryImages;
                    loadImage(0);
                } else {
                    gallery = [image.src]; // Show the clicked image if no gallery
                    loadImage(0);
                }

                popup.style.display = 'flex'; // Show the popup
            }
        });


        // Close popup when close button is clicked
        if (closeBtn){
            closeBtn.addEventListener('click', () => {
                popup.style.display = 'none';
            });
        }

        // Close popup when clicking outside the popup content
        if (popup){
            popup.addEventListener('click', (event) => {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
        }


        // Navigate to the next image
        if (nextImage){
            nextImage.addEventListener('click', () => {
                loadImage(currentIndex + 1);
            });
        }


        // Navigate to the previous image
        if (prevImage){
            prevImage.addEventListener('click', () => {
                loadImage(currentIndex - 1);
            });
        }

    });



    // Issue for On Sale Checked and Unchecked
    jQuery(document).ready(function($) {
        var removedRows = [];

        // $('.variation-row').show();

        $('#stock_status').on('change', function () {
            var isChecked = $(this).prop('checked');

            $('.variation-row').each(function () {
                var stockStatus = $(this).data('stock-status');

                if (isChecked && stockStatus === 1) {
                    $(this).show();
                    // $(this).find('.quick-add-to-cart').css('min-width', '140px');
                } else if (!isChecked) {
                    $(this).show();
                } else {
                    if (stockStatus !== 'instock') {
                        removedRows.push($(this).detach());
                    }
                }
            });

            if (!isChecked) {
                for (var i = 0; i < removedRows.length; i++) {
                    $('#quick-variable-table').append(removedRows[i].addClass('re-added'));
                    // $(this).find('.quick-add-to-cart').css('min-width', '140px');
                }

                removedRows = [];

                $('.re-added').each(function () {
                    bindAddToCart($(this));
                    $(this).removeClass('re-added');
                });

                bindQuantityButtons();
            }
        });

        // Add to cart for On Sale unchecked portion
        function bindAddToCart(row) {
            row.find('.quick-add-to-cart').off('click').on('click', function () {

                function isMobile() {
                    return /Mobi|Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent);
                }

                var $button = $(this);
                var productId = $button.data('productid');
                var variationId = $button.data('variationid');
                var quantity = row.find(".quick-quantity-input").val();

                $button.prop('disabled', true);
                $button.find('i, span').hide();

                if (!$button.hasClass('loading')) {
                    $button.append('<i class="fa fa-spinner fa-spin spin-icon-remove"></i>');

                    setTimeout(function() {
                        $button.find('.spin-icon-remove').remove();
                    }, 1000);
                }

                if (isMobile()) {
                    quantity = $button.closest('.mobile-variation-card').find('.quick-quantity-input').val();
                } else {
                    quantity = $button.closest('tr').find(".quick-quantity-input").val();
                }

                var selectedAttributes = {};
                var $container = isMobile()
                    ? $button.closest('.mobile-variation-card')
                    : $button.closest('tr');

                $container.find('.quick-attribute-select, .quick-attribute-text').each(function () {
                    var attributeKey = $(this).attr('name');
                    var attributeValue;

                    if ($(this).is('select')) {
                        attributeValue = $(this).val();
                    } else {
                        attributeValue = $(this).text().trim();
                    }

                    if (attributeValue && attributeKey) {
                        selectedAttributes[attributeKey] = attributeValue;
                    }
                });

                const data = {
                    'action': 'woocommerce_ajax_add_to_cart',
                    'product_id': productId,
                    'quantity': quantity,
                    'variation_id': variationId,
                    'variation': selectedAttributes,
                    "_wpnonce": quick_front_ajax_obj.nonce, // Add the nonce here
                };

                $button.prop('disabled', true);
                $button.find('span').hide();

                $.post(quick_front_ajax_obj.ajax_url, data, function(response) {

                    if (response.success) {
                        $button.find('.spin-icon-remove').remove();
                        $button.append('<span class="updated-check-add-to-cart"><i class="fa fa-check"></i></span>');

                        setTimeout(function() {
                            $button.find('.updated-check-add-to-cart').remove();
                            $button.prop('disabled', false);
                            $button.find('i, span').show();
                        }, 3000);

                        $( document.body).trigger('wc_fragment_refresh');

                    } else {
                        console.error('Failed to add product: ', response);
                        $button.prop('disabled', false);
                        $button.find('i, span').show();
                    }
                });
            });
        }


        // // Add search functionality (filter by SKU or attribute)
        $('#variation-search').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();

            $('.variation-row').each(function () {
                var rowContent = $(this).text().toLowerCase();
                if (rowContent.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Function to bind quantity buttons
        function bindQuantityButtons() {
            $(".quick-quantity-decrease").off("click").on("click", function () {
                let currentValue = parseInt(
                    $(this).siblings(".quick-quantity-input").val(),
                    10
                );

                if (currentValue > 1) {
                    // Prevent going below 1
                    $(this)
                        .siblings(".quick-quantity-input")
                        .val(currentValue - 1);
                    $(".quick-cart-notification").text("");
                }
            });

            $(".quick-quantity-increase").off("click").on("click", function () {
                console.log("increase");
                maxQuantity = $(this)
                    .siblings(".quick-quantity-input")
                    .attr("data-max");
                let currentValue = parseInt(
                    $(this).siblings(".quick-quantity-input").val(),
                    10
                );

                if (currentValue < maxQuantity) {
                    // Prevent exceeding max limit
                    $(this)
                        .siblings(".quick-quantity-input")
                        .val(currentValue + 1);
                    $(".quick-cart-notification").text("");
                }
            });
        }
    });

</script>


<style>

    .dashicons {
        transition: color 0.2s ease-in-out;
    }

    /* Popup container */
    .popup-container {
        display: none;
        position: fixed;
        z-index: 999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    /* Popup content (image wrapper) */
    .popup-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        border: 5px solid white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    /* Close button */
    .close-btn {
        position: absolute;
        top: 0;
        right: 0;
        color: white;
        font-size: 25px;
        font-weight: bold;
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        z-index: 1010;
    }

    .close-btn:hover{
        background-color: #d5d5d5;
        border-color: #d5d5d5;
        color: #333333;
    }

    .quick-add-to-cart.loading .fa-cart-plus,
    .quick-add-to-cart.loading span {
        display: none;
    }


    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        font-size: 2rem;
        padding: 10px;
        cursor: pointer;
        z-index: 1000;
    }

    .lightbox-nav:hover {
        background-color: #d5d5d5;
        border-color: #d5d5d5;
        color: #333333;
    }

    .lightbox-nav.prev {
        left: 10px;
    }

    .lightbox-nav.next {
        right: 10px;
    }

</style>