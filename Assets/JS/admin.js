jQuery(document).ready(function ($) {


    // Variation  Gallery start
    function initializeSortable() {
        $(".variation-gallery-container").each(function () {
            const container = $(this);

            container.sortable({
                items: ".variation-gallery-item",
                cursor: "move",
                placeholder: "sortable-placeholder",
                forcePlaceholderSize: true,
                tolerance: "pointer",
                stop: function (event, ui) {
                    const variationId = container.attr("id").split("-").pop();
                    const inputField = $(`#variation-gallery-input-${variationId}`);

                    const updatedOrder = container.find(".variation-gallery-item").map(function () {
                        return $(this).data("image-id");
                    }).get();

                    inputField.val(updatedOrder.join(","));
                },
            });
        });
    }

// Use a delay to ensure dynamic content is loaded
    setTimeout(initializeSortable, 500);

// Alternatively, listen for changes in the DOM
    const observer = new MutationObserver((mutationsList, observer) => {
        initializeSortable(); // Re-initialize sortable on DOM changes
    });
    observer.observe(document.body, { childList: true, subtree: true });


    // Upload images
    $(document).on("click", ".upload-variation-gallery-image", function (e) {
        e.preventDefault();

        const button = $(this);
        const variationId = button.data("variation-id");
        const inputField = $(`#variation-gallery-input-${variationId}`);
        const galleryContainer = $(`#gallery-container-${variationId}`);

        const mediaUploader = wp.media({
            title: "Select Images",
            button: { text: "Add to Gallery" },
            multiple: true,
        }).on("select", function () {
            const attachments = mediaUploader.state().get("selection").toJSON();
            let imageIds = inputField.val().split(",").filter(Boolean); // Get current image IDs

            attachments.forEach(attachment => {
                if (!imageIds.includes(String(attachment.id))) {
                    imageIds.push(attachment.id); // Add new ID
                    galleryContainer.append(`
                    <li class="variation-gallery-item" data-image-id="${attachment.id}">
                        <img src="${attachment.url}" alt="" width="60" height="60">
                        <button type="button" class="variation-gallery-remove" data-image-id="${attachment.id}">&times;</button>
                    </li>
                `);
                }
            });

            inputField.val(imageIds.join(",")); // Update the input field
        });

        mediaUploader.open();
    });


    // Remove image
    $(document).on("click", ".variation-gallery-remove", function () {
        const button = $(this);
        const imageId = button.data("image-id");
        const container = button.closest(".variation-gallery-item");
        const inputField = button.closest(".form-row").find("input[type=hidden][id^=variation-gallery-input-]");


        // Remove image ID from input value
        let imageIds = inputField.val().split(",").filter(Boolean); // Ensure array
        imageIds = imageIds.filter(id => String(id) !== String(imageId)); // Remove the selected ID
        inputField.val(imageIds.join(",")); // Update the input field value

        // Remove the image from the DOM
        container.remove();
    });


    // Variation  Gallery End

    // Attribute Section Start

    jQuery(document).ready(function ($) {

        var previewDiv = $('#term_image_preview_render_from_js');
        var imageUrl = previewDiv.data('image-url');

        if (imageUrl){
            previewDiv.html('<img id="term_image_preview" src="' + imageUrl + '" alt="Selected Image" style="max-width: 70px; height: auto; display: block; margin-bottom: 10px; border: 1px solid lightgrey; border-radius: 5px">');
        }

        // Remove Image
        $(document).on('click', '#upload_image_button_remove', function (e) {
            e.preventDefault();

            // Clear the hidden input value
            $('#term_image').val('');

            // Hide the preview image
            $('#term_image_preview').attr('src', '').hide();
        });

        // Upload Image
        $('#upload_image_button').on('click', function (e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open()
                .on('select', function () {
                    var uploaded_image = image.state().get('selection').first().toJSON();
                    var image_url = uploaded_image.url;

                    // Update the hidden input value
                    $('#term_image').val(image_url);

                    // Update or show the preview image
                    var previewDiv = $('#term_image_preview_render_from_js');
                    previewDiv.html('<img id="term_image_preview" src="' + image_url + '" alt="Selected Image" style="max-width: 70px; height: auto; display: block; margin-bottom: 10px; border: 1px solid lightgrey; border-radius: 5px">');
                });
        });
    });



    jQuery(document).ready(function ($) {
        $('#upload_image_button_add_new').on('click', function (e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open()
                .on('select', function () {
                    var uploaded_image = image.state().get('selection').first().toJSON();
                    var image_url = uploaded_image.url;

                    // Set the image URL to the hidden input field
                    $('#term_image_add_new').val(image_url);

                    // Update or show the preview image
                    var previewDiv = $('#term_image_preview_add_new_render_from_js');
                    previewDiv.html('<img src="' + image_url + '" alt="Selected Image" style="max-width: 70px; height: auto; border: 1px solid lightgrey; border-radius: 5px;">');
                });
        });
    });


    // Attribute Section End

    // Meta Section Start

    jQuery(document).ready(function($) {

        // Cart Show Hide.
        function toggleCartSectionTemplate() {
            var selectedCartTemplate = $('#_variation_table_template').val();
            var tableMetaTemplate = $('#_variation_table_meta').val();

            if (selectedCartTemplate === 'template_2' && tableMetaTemplate === 'true') {
                $('._table_template2_cart_section_style_template_field').show();
            } else {
                $('._table_template2_cart_section_style_template_field').hide();
            }
        }

        // Table Show Hide.
        function toggleTableSectionTemplate() {
            var tableMetaTemplate = $('#_variation_table_meta').val();

            if (tableMetaTemplate === 'true') {
                $('._variation_table_template_field').show();
            } else {
                $('._variation_table_template_field').hide();
            }
            toggleCartSectionTemplate();
        }

        // Initial calls to set the correct visibility for cart table
        toggleTableSectionTemplate();
        toggleCartSectionTemplate();

        // Event Listeners for Cart Table
        $('#_variation_table_template, #_variation_table_meta').on('change', function () {
            toggleTableSectionTemplate();
            toggleCartSectionTemplate();
        });

        // List Show Hide.
        function toggleListSectionTemplate() {
            var selectedTemplateList = $('#_variation_list_meta').val();
            if (selectedTemplateList === 'true') {
                $('._variation_list_template_meta_field').show();
            } else {
                $('._variation_list_template_meta_field').hide();
            }
        }
        toggleListSectionTemplate();
        $('#_variation_list_meta').on('change', function() {
            toggleListSectionTemplate();
        });

        // redirect single product page, Show in archive show hide

        function toggleRedirectSingleProductPage() {
            var selectedTemplateList = $('#_variation_swatches_archive_page_meta').val();
            if (selectedTemplateList === 'attribute-archive') {
                $('.show-in-archive-page-attribute-select-option').css('visibility', 'visible');
            } else {
                $('.show-in-archive-page-attribute-select-option').css('visibility', 'hidden');
            }
        }
        toggleRedirectSingleProductPage();
        $('#_variation_swatches_archive_page_meta').on('change', function() {
            toggleRedirectSingleProductPage();
        });

    });


    jQuery(document).ready(function ($) {

        $('.attribute-settings').hide();

        $('.attribute-toggle-btn').on('click', function (event) {
            event.stopPropagation(); // Prevents the full row from toggling

            const rowId = $(this).data('row-id');
            const targetRow = $('#attribute-settings-' + rowId);
            const icon = $(this).find('.dashicons');

            $('.attribute-settings').not(targetRow).slideUp();
            $('.attribute-toggle-btn .dashicons').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');

            if (targetRow.is(':visible')) {
                targetRow.slideUp();
                icon.removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
            } else {
                targetRow.slideDown();
                icon.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
            }
        });

        // Toggle visibility of meta sections based on display type
        // $('select[name^="attribute_display_type"]').on('change', function () {
        //     const selectedValue = $(this).val();
        //     const parentRow = $(this).closest('tr');
        //     const colorMeta = parentRow.find('.color-meta');
        //     const imageMeta = parentRow.find('.image-meta');
        //
        //     if (selectedValue === 'color') {
        //         colorMeta.show();
        //         imageMeta.hide();
        //     } else if (selectedValue === 'image') {
        //         imageMeta.show();
        //         colorMeta.hide();
        //     } else {
        //         colorMeta.hide();
        //         imageMeta.hide();
        //     }
        // }).trigger('change');

        // Image Upload
        $(document).on('click', '.meta_upload_image_button', function (e) {
            e.preventDefault();

            // Get the parent row for this button
            const parentRow = $(this).closest('tr');
            const inputField = parentRow.find('.meta_term_image');
            const previewImage = parentRow.find('.meta_term_image_preview');

            // Open the WordPress media uploader
            var image = wp.media({
                title: 'Upload Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).open().on('select', function () {
                var uploaded_image = image.state().get('selection').first().toJSON();
                var image_url = uploaded_image.url;

                // Update the hidden input value and preview image
                inputField.val(image_url);
                previewImage.attr('src', image_url).show();
            });
        });


        // Remove Image
        $(document).on('click', '.meta_image_button_remove', function (e) {
            e.preventDefault();

            // Get the parent row for this button
            const parentRow = $(this).closest('tr');
            const inputField = parentRow.find('.meta_term_image');
            const previewImage = parentRow.find('.meta_term_image_preview');

            // Clear the hidden input value and hide the preview image
            inputField.val('');
            previewImage.attr('src', '').hide();
        });
    });

    /**
     * Display Type change color or image that time show color or image section based on attribute.
     */
    jQuery(document).ready(function($) {
        function handleDisplayTypeChange() {
            var $select = $(this);
            var attributeSlug = $select.data('rowslug-displaytype');
            var selectedValue = $select.val();

            $('.display-typeShow-color-' + attributeSlug).hide();
            $('.display-typeShow-image-' + attributeSlug).hide();

            if (selectedValue === 'color') {
                $('.display-typeShow-color-' + attributeSlug).show();
            } else if (selectedValue === 'image') {
                $('.display-typeShow-image-' + attributeSlug).show();
            }
        }

        $('select[name^="attribute_display_type"]').each(function() {
            handleDisplayTypeChange.call(this);

            $(this).on('change', handleDisplayTypeChange);
        });
    });

    // Meta Section End

    /**
     * Color Picker show.
     */
    jQuery(document).ready(function ($) {
        if ($('.wvs-color-picker').length) {
            $('.wvs-color-picker').wpColorPicker();
        } else {

        }
    });


    // Ajax notice start

    jQuery(document).ready(function($) {
        $('.qvt-dismiss-btn').on('click', function() {
            const data = {
                action: 'quick_variable_review_dismissed_ajax',
                _nonce: qvt_notice_obj.nonce
            };
            const ajaxURL = qvt_notice_obj.ajax_url;
            $.post(ajaxURL, data, function(response) {
                console.log("response",response)
                if (response.success) {
                    console.log("work");
                    $('#qvt-review-notice').hide(); // Hide the review notice
                } else {
                    console.log(response.data);
                }
            });
        });

        var imgURL = qvt_notice_obj.logo_url;
        // Check if the target .logo span exists before appending
        if ($("#qvt-review-notice .logo").length > 0) {
            // Create an <img> element
            var imgElement = $("<img>", {
                src: imgURL,
                alt: "Plugin Logo",
                class: "custom-logo", // Add your custom class if needed
            });

            // Append the image to the .logo span inside the admin notice
            $("#qvt-review-notice .logo").append(imgElement);
        }
    });

    //  Ajax notice end

    /**
     * Variation monster image into dashboard.
     */
    jQuery(document).ready(function ($) {
        const imageUrl = $('#variation-monster-admin-dashboard-image').data('image-url-variaion-monter');

        if (imageUrl) {
            const imgElement = $('<img>', {
                src: imageUrl,
                alt: 'Variation Monster',
                css: {
                    width: '100%'
                }
            });

            $('#variation-monster-admin-dashboard-image').append(imgElement);
        }
    });


});


// document.addEventListener('DOMContentLoaded', () => {
//     const attributeSelectors = document.querySelectorAll('[id^="attribute_display_type_"]');
//
//     attributeSelectors.forEach(selectElement => {
//         const attributeId = selectElement.id.split('_').pop(); // Extract attribute ID
//
//         // Scope to rows that match this specific attribute ID
//         const rows = document.querySelectorAll(`[id^="display-select-option-color-"][id$="-${attributeId}"]`);
//         const customRows = document.querySelectorAll(`[id^="display-select-option-custom-color-"][id$="-${attributeId}"]`);
//
//         rows.forEach(row => {
//
//             let termId = null;
//
//             if (row.id.includes('color-') || row.id.includes('image-')) {
//                 termId = row.id.split('-')[4];
//             }
//
//             const colorOptions = document.getElementById(`display-select-option-color-${termId}-${attributeId}`);
//             const secondaryColorOptions = document.getElementById(`display-select-option-secondary-color-${termId}-${attributeId}`);
//             const imageOptions = document.getElementById(`display-select-option-image-${termId}-${attributeId}`);
//
//             // Function to toggle display of options
//             function toggleOptions() {
//                 if (selectElement.value === 'color') {
//                     if (colorOptions) colorOptions.style.display = 'block';
//                     if (secondaryColorOptions) secondaryColorOptions.style.display = 'block';
//                 } else {
//                     if (colorOptions) colorOptions.style.display = 'none';
//                     if (secondaryColorOptions) secondaryColorOptions.style.display = 'none';
//                 }
//
//                 if (selectElement.value === 'image') {
//                     if (imageOptions) imageOptions.style.display = 'block';
//                 } else {
//                     if (imageOptions) imageOptions.style.display = 'none';
//                 }
//             }
//
//             toggleOptions();
//
//             selectElement.addEventListener('change', toggleOptions);
//         });
//
//         customRows.forEach(customRow => {
//
//             let customValueId = null;
//
//             if (customRow.id.includes('custom-color-')) {
//                 customValueId = customRow.id.split('-')[5];
//             }
//
//
//             const CustomColorOptions = document.getElementById(`display-select-option-custom-color-${customValueId}-${attributeId}`);
//             const CustomSecondaryColorOptions = document.getElementById(`display-select-option-custom-secondary-color-${customValueId}-${attributeId}`);
//             const CustomImageOptions = document.getElementById(`display-select-option-custom-image-${customValueId}-${attributeId}`);
//
//             function toggleOptions() {
//                 if (selectElement.value === 'color') {
//                     if (CustomColorOptions) CustomColorOptions.style.display = 'block';
//                     if (CustomSecondaryColorOptions) CustomSecondaryColorOptions.style.display = 'block';
//                 } else {
//                     if (CustomColorOptions) CustomColorOptions.style.display = 'none';
//                     if (CustomSecondaryColorOptions) CustomSecondaryColorOptions.style.display = 'none';
//                 }
//
//                 if (selectElement.value === 'image') {
//                     if (CustomImageOptions) CustomImageOptions.style.display = 'block';
//                 } else {
//                     if (CustomImageOptions) CustomImageOptions.style.display = 'none';
//                 }
//             }
//
//             toggleOptions();
//
//             selectElement.addEventListener('change', toggleOptions);
//         });
//     });
// });


