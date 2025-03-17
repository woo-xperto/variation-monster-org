jQuery(document).ready(function () {

    jQuery(document).ready(function ($) {
        let selectedAttributes       = {};
        let firstAttributeSelected  = null;
        let secondAttributeSelected = null;
        let thirdAttributeSelected  = null;

        function resetProductSelections(productID) {
            // Reset selected attributes, selection order, and states
            selectedAttributes = {};
            // attributeSelectionOrder = [];
            firstAttributeSelected = null;
            secondAttributeSelected = null;
            thirdAttributeSelected = null;
            // Enable all buttons and reset styling for the current product
            $(`[data-product_id="${productID}"]`)
                .removeClass('');
        }

        $('.variations-display input[type="radio"], .variations-display button').on('click', function () {
            const $currentProduct   = $(this).closest('.variations-display');
            const selectedValue     = $(this).attr('data-value');
            let availableVariations = $(this).data('available_variations');
            let attributeName       = $(this).data('variation-name');
            const selectedAttribute = $(this).attr('data-variation-name');
            const productID         = $(this).attr('data-product_id');

            if (!$currentProduct.data('product-initialized')) {
                resetProductSelections(productID);
                // Set the flag to prevent resetting for the same product
                $currentProduct.data('product-initialized', true);
            } else {
                // Now reset the current product selections
                resetProductSelections(productID);
                $currentProduct.data('product-initialized', true);
            }

            // Update selected attributes
            selectedAttributes[selectedAttribute] = selectedValue;

            function findWhichButtonDisabled() {
                setTimeout(() => {
                    const attributes = getChosenAttribute($currentProduct);
                    const currentAttributes = attributes.data;


                    $currentProduct.find('[data-variation-name]').each(function (index, el) {
                        var $select                    = $(el);
                        var attributeName   = $select.attr('data-variation-name');
                        var checkAttributes            = $.extend(true, {}, currentAttributes);
                        checkAttributes[attributeName] = '';

                        var variations = findMatchingVariations(availableVariations, checkAttributes);
                        if (attributes.count === attributes.chosenCount){
                            checkVariation(attributes, variations, productID);
                        }

                        $currentProduct.find('input[type="radio"], button').each(function () {
                            var $button = $(this);
                            if ($button.data('variation-name') === attributeName) {
                                var buttonValue = $button.data('value');
                                var isEnabled = variations.some(function (variation) {
                                    var attrValue = variation.attributes[attributeName];

                                    // Ensure proper checks for null or undefined values
                                    if (attrValue === buttonValue) {
                                        return true;
                                    } else if (attrValue === '' || attrValue === undefined) {
                                        return true;
                                    } else if (buttonValue === '') {
                                        return true;
                                    }
                                    return false;
                                });

                                $button.prop('disabled', !isEnabled);

                                if (!isEnabled) {
                                    $button.css('opacity', '0.5').addClass('disabled-option');
                                } else {
                                    $button.css('opacity', '1').removeClass('disabled-option');
                                }
                            }
                        });

                    });
                }, 50);
            }

            function findMatchingVariations(variations, attributes){
                var matching = [];
                for (var i = 0; i < variations.length; i++) {
                    var variation = variations[i];

                    if (isMatch(variation.attributes, attributes)) {
                        matching.push(variation);
                    }
                }
                return matching;
            }

            function isMatch(variation_attributes, attributes){
                var match = true;
                for (var attr_name in variation_attributes) {
                    if (variation_attributes.hasOwnProperty(attr_name)) {
                        var val1 = variation_attributes[attr_name];
                        var val2 = attributes[attr_name];
                        if (val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2) {
                            match = false;
                        }
                    }
                }
                return match;
            }


            function getChosenAttribute($currentProduct) {
                const data = {};
                let count = 0;
                let chosen = 0;

                // Get all variation attributes available for this product
                $currentProduct.find('[data-variation-name]').each(function () {
                    const attributeName = $(this).attr('data-variation-name');

                    // Initialize all attributes with empty values
                    if (!(attributeName in data)) {
                        data[attributeName] = '';
                        count++;
                    }
                });

                // Update selected values
                $currentProduct.find('input[type="radio"]:checked, button.selected').each(function () {
                    const attributeName = $(this).attr('data-variation-name');
                    const value = $(this).attr('data-value');

                    if (value) {
                        data[attributeName] = value;
                        chosen++;
                    }
                });

                return {
                    count: count,
                    chosenCount: chosen,
                    data: data
                };
            }

            let isRequestInProgress = false; // Flag to track AJAX request status

            function checkVariation(attributes, variations, productID) {
                if (isRequestInProgress) {
                    return; // If request is in progress, return and don't proceed
                }

                let selectedAttributes = {};

                selectedAttributes = attributes.data;

                // Check for variations with the attribute match
                const matchingVariation = variations.find(variation => {
                    return isMatch(variation.attributes, attributes.data);
                });

                if (matchingVariation) {
                    const variation_id = matchingVariation.variation_id;

                    if (variation_id) {
                        // Set the flag to indicate that the request is in progress
                        isRequestInProgress = true;

                        // Add the spinner
                        $currentProduct.append('<div class="spinner-quick-cart-archive"><div class="spinner-archive"></div></div>');
                        $currentProduct.find('input[type="radio"], button').prop('disabled', true);

                        $.ajax({
                            type: 'POST',
                            url: quick_front_ajax_obj.ajax_url,
                            data: {
                                action: 'add_variation_to_cart',
                                variation_id: variation_id,
                                variation: selectedAttributes,
                                product_id: productID,
                                quantity: 1,
                            },
                            success: function (response) {
                                if (response.success) {
                                    $(document.body).trigger('wc_fragment_refresh');
                                    setTimeout(() => {
                                        $currentProduct.find('.spinner-quick-cart-archive').remove();
                                        $currentProduct.append(' <div class="archive-checkmark"><div class="checkmark">✔️</div></div> ');
                                    }, 1000);
                                } else {
                                    alert(response.data.message);
                                    $currentProduct.find('.spinner-quick-cart-archive').remove();
                                }

                                selectedAttributes = {}; // Reset selection

                                setTimeout(() => {
                                    $currentProduct.find('.checkmark').remove();
                                    $currentProduct
                                        .find('input[type="radio"], button')
                                        .prop('disabled', false)
                                        .removeClass('selected')
                                        .removeClass('disabled-option')
                                        .css('opacity', '1');
                                    $currentProduct.find('.archive-checkmark').remove();
                                }, 2000);

                                // Reset the flag after the AJAX request completes
                                isRequestInProgress = false;
                            },
                            error: function () {
                                $currentProduct
                                    .find('input[type="radio"], button')
                                    .prop('disabled', false)
                                    .removeClass('selected')
                                    .removeClass('disabled-option')
                                    .css('opacity', '1');

                                // Remove the spinner
                                $currentProduct.find('.spinner-quick-cart-archive').remove();
                                alert('An error occurred. Please try again.');

                                // Reset the flag after the AJAX request fails
                                isRequestInProgress = false;
                            },
                        });
                    }
                } else {
                    console.log("No matching variation found.");
                }
            }

            findWhichButtonDisabled ()

        });
    });
});