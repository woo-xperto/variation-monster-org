jQuery(document).ready(function () {

  (function ($) {
    $(document).ready(function () {
      // Handle the click event on the "Clear" link
      $(document).on('click', '.reset_variations', function (e) {
        e.preventDefault();  // Prevent default WooCommerce behavior

        // Clear the selected state of custom buttons, radios, and images
        $('.custom-button, .custom-image-button, .custom-color-button, input[type="radio"]').removeClass('selected');
        $('.custom-button, .custom-image-button, .custom-color-button, input[type="radio"]').prop('checked', false);

        // Enable all buttons and radios after reset
        $('.custom-button, .custom-image-button, .custom-color-button, input[type="radio"]')
            .prop('disabled', false)
            .css('opacity', '1')
            .removeClass('disabled-option');

        // Reset WooCommerce variation form
        $('form.variations_form')[0].reset();

        // Reset the label text to "Choose an option"
        $('.label').each(function () {
          let labelText = $(this).text().split(':')[0];  // Extract the attribute name
          $(this).text(labelText + ' ');  // Reset the label
        });

        // Trigger WooCommerce events to ensure proper reset
        $('form.variations_form')
            .trigger('reset_data')
            .trigger('woocommerce_variation_has_reset');
      });
    });
  })(jQuery);


  // Label show dynamically into single product page.
  (function ($) {
    $(document).ready(function () {
      // Handle button clicks and update label dynamically
      $(document).on('click', '.custom-button, .custom-image-button, .custom-color-button', function () {
        const button = $(this);
        const container = button.closest('tr');
        const variationName = button.data('variation-name');
        const value = button.data('value');
        const labelName = button.data('label-name');

        // Locate the label using the `for` attribute
        const label = container.find('.label');

        if (button.hasClass('selected')) {
          if (label.length) {
            // Update the label text with the selected value
            const attributeName = label.text().split(':')[0].trim();
            // const tooltipText = button.data('tooltip');
            label.text(attributeName + ': ' + (labelName));
          }

          // Update WooCommerce select box
          const selectBox = $('select[name="' + variationName + '"]');
          if (selectBox.length) {
            selectBox.val(value).trigger('change');
          }
        }else{
          if (label.length) {
            // Update the label text with the selected value
            const attributeName = label.text().split(':')[0].trim();
            // const tooltipText = button.data('tooltip');
            label.text(attributeName + ' ' );
          }
        }



        // Trigger WooCommerce events
        $('form.variations_form')
            .trigger('woocommerce_variation_select_change')
            .trigger('check_variations');
      });
    });
  })(jQuery);


  // Show tooltip into single product page by select variation
  (function ($) {
    $(document).ready(function () {
      // Create a tooltip element
      const tooltip = $('<div class="custom-tooltip"></div>').appendTo('body').hide();

      // Show tooltip on hover
      $(document).on('mouseenter', '.custom-button, .custom-image-button, .custom-color-button', function () {
        const tooltipText = $(this).data('tooltip');
        const tooltipLabel = $(this).data('tooltip-label');
        const tooltipBackGroundColor = $(this).data('tooltip-bg-color');
        const tooltipTextColor = $(this).data('tooltip-text-color');

        if (tooltipText) {
          const finalTooltipText = tooltipLabel
              ? `${tooltipLabel} : ${tooltipText}`
              : tooltipText;

          tooltip
              .text(finalTooltipText)
              .css({
                'background-color': tooltipBackGroundColor,
                'color': tooltipTextColor
              })
              .fadeIn(0);
        }
      }).on('mousemove', '.custom-button, .custom-image-button, .custom-color-button', function (e) {
        tooltip.css({
          top: e.pageY + 10,
          left: e.pageX + 10
        });
      }).on('mouseleave', '.custom-button, .custom-image-button, .custom-color-button', function () {
        tooltip.fadeOut(0);
      });
    });
  })(jQuery);

  // Radio

  (function ($) {
    $(document).ready(function () {
      let selectedAttributes = {};

      const customVariations = document.getElementsByClassName('custom-wc-variations');
      if (customVariations.length > 0) {
        Array.from(customVariations).forEach(function (variation) {
          const radios = variation.querySelectorAll('input[type=radio]');

          radios.forEach(function (radio) {
            radio.addEventListener('click', function (e) {
              e.preventDefault()
              const variationName = radio.getAttribute('data-variation-name');
              const selectBox = document.querySelector('select[name=' + variationName + ']');
              const selectedValue = radio.getAttribute('data-value');

              // Toggle logic for deselection
              if (radio.classList.contains('selected')) {
                radio.classList.remove('selected');
                selectBox.value = '';
                delete selectedAttributes[variationName];  // Remove attribute
              } else {
                // Deselect all other radios and select the clicked one
                radios.forEach(el => el.classList.remove('selected'));
                radio.classList.add('selected');
                selectBox.value = selectedValue;
                selectedAttributes[variationName] = selectedValue;
              }

              // Trigger WooCommerce events
              $(selectBox).trigger('change');
              $('form.variations_form').trigger('woocommerce_variation_select_change');
              $('form.variations_form').trigger('check_variations');
            });
          });
        });
      }
    });
  })(jQuery);


  // Color , Images and Button

  (function ($) {
    $(document).ready(function () {
      const selectors = ['.custom-wc-buttons', '.custom-wc-images', '.custom-wc-colors'];

      selectors.forEach(selector => {
        const containers = document.querySelectorAll(selector);
        containers.forEach(container => {
          const elements = container.querySelectorAll('button');
          elements.forEach(element => {
            element.addEventListener('click', function () {

              const variationName = element.getAttribute('data-variation-name');
              const value = element.getAttribute('data-value');
              const selectBox = document.querySelector('select[name="' + variationName + '"]');

              if ($(this).hasClass('selected')){
                elements.forEach(el => el.classList.remove('selected'));
                selectBox.value = '';
                $(selectBox).trigger('change');
              }else {
                elements.forEach(el => el.classList.remove('selected'));
                element.classList.add('selected');
                if (selectBox) {
                  selectBox.value = value;
                  $(selectBox).trigger('change');
                }
              }

              // Trigger WooCommerce events
              $('form.variations_form').trigger('woocommerce_variation_select_change');
              $('form.variations_form').trigger('check_variations');
            });
          });
        });
      });
    });
  })(jQuery);

  // Variation Swatches End


  // Variable slide/slick script
  var $tooltip = jQuery(".quick-variable-tooltip");
  var maxQuantity;
  var variationData;
  let autoPlay = jQuery(".quick-variable-slide").data("autoplay");

  jQuery(".quick-variable-slide").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: autoPlay,
    autoplaySpeed: 2000,
    arrows: true,
    prevArrow:
        '<button type="button" class="slick-custom-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow:
        '<button type="button" class="slick-custom-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
  });

  // Variable Tooltip script
  // Tooltip Hide
  jQuery(window).on("click", function (e) {
    if (
        !jQuery(e.target).closest($tooltip).length &&
        !jQuery(e.target).closest(".quick-slide-variable").length
    ) {
      $tooltip.addClass("quick-hidden");
    }
  });

  jQuery(".quick-variable-tooltip .closebtn").on("click", function () {
    $tooltip.addClass("quick-hidden");
  });


  //Variable Carousel
  jQuery(".quick-slide-variable").each(function () {
    var $this = jQuery(this);
    variationData = JSON.parse($this.attr("data-variation"));
    let hoverClick = variationData.variableClickHover;

    if (hoverClick === "variable-click") {
      $this.off("click touchstart").on("click touchstart", function (e) {
        e.preventDefault();
        quickVariableDetails($this);
      });
    } else {
      if (!("ontouchstart" in window)) {
        $this.off("mouseenter").on("mouseenter", function () {
          quickVariableDetails($this);
        });
      } else {
        $this.off("touchstart").on("touchstart", function () {
          quickVariableDetails($this);
        });
      }
    }


    function quickVariableDetails($element) {
      variationData = JSON.parse($element.attr("data-variation"));

      const variationId  = variationData.variationId;
      const variationURL = variationData.variationURL;

      // Update the button's data attribute
      // jQuery(".quick-add-to-cart-shop-page").attr("data-variationId", variationId);


      const $cartButton = $element.closest(".quick-variable-slide").siblings(".quick-variable-tooltip").find(".quick-add-to-cart-shop-page");

      $cartButton.attr("data-variationId", variationId);
      // if ($cartButton.length > 0) {
      //   $cartButton.attr("data-variationId", variationId);
      //   console.log("Updated variationId:", variationId);
      // }

      // Add to cart start
      variationMaxQuantity = variationData.variationQuantity;
      globalMaxQuantity    = variationData.globalStockQuantity;

      maxQuantity = 99;
      if (variationMaxQuantity) {
        maxQuantity = variationMaxQuantity;
      } else if (globalMaxQuantity) {
        maxQuantity = globalMaxQuantity;
      }
      // maxQuantity = null;
      StockManage                 = variationData.variationStockManage;
      maxQuantityforCart          = 1
      globalQuantityforOutofStock = 1
      globalStockManage           = variationData.globalStockManagement;
      if (true === StockManage){
        maxQuantityforCart = variationData.variationQuantity;
      }
      if (true === globalStockManage){
        globalQuantityforOutofStock = variationData.globalStockQuantity;
      }
      out_of_stock_show = maxQuantityforCart ? maxQuantityforCart : globalQuantityforOutofStock;
      // Add to cart end
      let cartButton        = jQuery(".quick-variable-tooltip .quick-add-to-cart-shop-page");
      let stockNotification = jQuery(".quick-variable-tooltip .quick-cart-notification");
      let toolTip           = jQuery(".quick-variable-tooltip");

      if ( 0 === out_of_stock_show) {
        cartButton.addClass("quick-hidden");
        stockNotification.removeClass("quick-hidden");
        stockNotification.text("Out Of Stock");
      } else {
        cartButton.removeClass("quick-hidden");
        stockNotification.addClass("quick-hidden");
        stockNotification.text(" ");
      }
      // Set other tooltip information
      const quickVariableImage = $element.find("img").attr("src");
      const variations = JSON.parse($element.attr("data-variationsList"));
      let variationsOutput = "";

      Object.entries(variations).forEach(([key, data]) => {
        const options = data.options;
        const label = data.label; // Access label_name directly from PHP

        const attributeValue = variationData.variation_set_attribute && variationData.variation_set_attribute.hasOwnProperty(key)
            ? variationData.variation_set_attribute[key]
            : "";

        if (!attributeValue) {
          variationsOutput += `<p><strong>${label}:</strong> <select class='quick-attribute-select' name='attribute_${key}' data-attribute-name='attribute_${key}'>`;
          options.forEach(option => {
            variationsOutput += `<option value="${option}">${option}</option>`;
          });
          variationsOutput += `</select></p>`;
        } else {
          variationsOutput += `<p><strong>${label}:</strong> <span class='quick-variable-title quick-attribute-text' name='attribute_${key}'>${attributeValue}</span></p>`;
        }
      });


      document.querySelector("#variable-product-variations").innerHTML = variationsOutput;
      jQuery(document).ready(function ($) {
        // Assuming `variationURL` is dynamically available from your logic
        $('.dynamic-variation-url').attr('href', variationData.variationURL || '#');
      });

      toolTip.attr("data-productId", variationData.product_id);
      toolTip.attr("data-variationId", variationData.variationId);
      toolTip.find("input.quick-quantity-input").attr("data-max", maxQuantity);
      toolTip.find("h4").text(variationData.name);
      toolTip.find("p.variable-sku").text(variationData.sku);
      toolTip.find("p.variation_id").text(variationData.variationId);
      toolTip.find("p.variable-short-desc").text(variationData.excerpt);
      toolTip.find("img").attr("src", quickVariableImage);
      toolTip.find("span#variable-product-price").html(variationData.variationPrice);
      toolTip.find("div#variable-product-variations").html(variationsOutput);

      jQuery(".quick-variable-tooltip ").addClass("quick-hidden");

      $element.closest(".quick-variable-slide").siblings($tooltip).removeClass("quick-hidden");
    }
  });


  //  Quantity decrease.

  jQuery("body").on("click",".quick-quantity-decrease", function () {
    let currentValue = parseInt(
        jQuery(this).siblings(".quick-quantity-input").val(),
        10
    );

    if (currentValue > 1) {
      // Prevent going below 1
      jQuery(this)
          .siblings(".quick-quantity-input")
          .val(currentValue - 1);
      jQuery(".quick-cart-notification").text("");
    }
  });


  // Quantity increase.

  jQuery("body").on("click", ".quick-quantity-increase", function () {

    maxQuantity = jQuery(this)
        .siblings(".quick-quantity-input")
        .attr("data-max");
    let currentValue = parseInt(
        jQuery(this).siblings(".quick-quantity-input").val(),
        10
    );

    if (currentValue < maxQuantity) {
      // Prevent exceeding max limit
      jQuery(this)
          .siblings(".quick-quantity-input")
          .val(currentValue + 1);
      jQuery(".quick-cart-notification").text("");
    }
  });


  // Quantity input.

  jQuery(".quick-quantity-input").on("input", function () {
    maxQuantity = jQuery(this).attr("data-max");
    let inputValue = parseInt(jQuery(this).val());
    let quantityNotification = jQuery(this)
        .closest(".quick-quantity-container")
        .siblings(".quick-cart-notification");
    if (isNaN(inputValue) || inputValue < 1) {
      jQuery(this).val(1);
      quantityNotification.text("Quantity cannot be less than 1.");
      quantityNotification.removeClass("quick-hidden");
    } else if (inputValue > maxQuantity) {
      jQuery(this).val(maxQuantity);
      quantityNotification.text(`Quantity cannot exceed ${maxQuantity}.`);
      quantityNotification.removeClass("quick-hidden");
    } else {
      quantityNotification.addClass("quick-hidden");
    }
  });


  // Add to cart option. All add to cart here for table data.

  jQuery(document).ready(function($) {
    $('body').on('click','.quick-add-to-cart', function() {
      // e.preventDefault();

      function isMobile() {
        return /Mobi|Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent);
      }

      var $button = $(this);
      var productId = $button.data('productid');
      var variationId = $button.data('variationid');
      var quantity;

      $button.prop('disabled', true);
      $button.find('i, span').hide();

      if (!$button.hasClass('loading')) {
        $button.append('<i class="fa fa-spinner fa-spin spin-icon-remove"></i>');
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

      // Perform the AJAX request
      $.post(quick_front_ajax_obj.ajax_url, data, function(response) {

        if (response.success) {
          $button.find('.spin-icon-remove').remove();
          $button.append('<span class="updated-check-add-to-cart"><i class="fa fa-check"></i></span>');

          // Show success message and reset button after 3 seconds
          setTimeout(function() {
            $button.find('.updated-check-add-to-cart').remove();
            $button.prop('disabled', false);
            $button.find('i, span').show(); // Show icon and text
          }, 2000);

          // Update cart totals and item count
          $( document.body).trigger('wc_fragment_refresh');

        } else {
          console.error('Failed to add product: ', response);
          $button.prop('disabled', false);
          $button.find('i, span').show(); // Show icon and text
        }
      });
    });
  });


  // Add to cart option. All add to cart here for shop page.

  jQuery(document).ready(function($) {
    $('.quick-add-to-cart-shop-page').on('click', function(e) {
      e.preventDefault();

      var $button = $(this);
      var productId = $button.data('productid');
      var variationId = $button.attr('data-variationid');
      var quantity = $button.closest('.quick-quantity-container').find(".quick-quantity-input").val();
      var selectedAttributes = {};

      if (!variationId || variationId === "") {
        alert("Please select a product variation.");
        return;
      }

      $button.prop('disabled', true);
      $button.find('i, span').hide();

      if (!$button.hasClass('loading')) {
        $button.append('<i class="fa fa-spinner fa-spin spin-icon-remove"></i>');
      }

      // Collect selected attributes, including dropdowns and static text spans
      $button.closest('.quick-variable-tooltip').find('.quick-attribute-select, .quick-attribute-text').each(function() {
        var attributeKey = $(this).attr('name'); // Get attribute name

        // If it's a dropdown, get the selected value; otherwise, get the text from the span
        var attributeValue = $(this).is('select') ? $(this).val() : $(this).text().trim();

        if (attributeValue && attributeKey) {
          selectedAttributes[attributeKey] = attributeValue;
        }
      });

      // Verify all required attributes are selected
      var allAttributesSelected = true;
      $.each(selectedAttributes, function(key, value) {
        if (value === "") {
          allAttributesSelected = false;
          alert(`Please select a value for ${key}`);
        }
      });
      if (!allAttributesSelected) return;

      // Data for AJAX request
      const data = {
        action: 'woocommerce_ajax_add_to_cart',
        product_id: productId,
        quantity: quantity,
        variation_id: variationId,  // Pass correct variation ID
        variation: selectedAttributes,
        _wpnonce: quick_front_ajax_obj.nonce, // Add the nonce here

      };

      // Disable button and show loading state
      $button.prop('disabled', true);
      $button.find('span').hide();

      // Perform AJAX request
      $.post(quick_front_ajax_obj.ajax_url, data, function(response) {
        if (response.success) {
          $button.find('.spin-icon-remove').remove();
          $button.append('<span class="updated-check-add-to-cart"><i class="fa fa-check"></i></span>');
          $('.shop-page-show-success-message').html(`
                    <div class="success-message" style="color: ${response.color}">
                        <p>${response.message}</p>
                    </div>
                `).fadeIn();

          // Hide the message after 3 seconds
          setTimeout(function () {
            $button.find('.updated-check-add-to-cart').remove();
            $('.shop-page-show-success-message').fadeOut();
            $button.prop('disabled', false);
            $button.find('i, span').show(); // Show icon and text
          }, 1000);

          // Update cart totals and item count
          $( document.body).trigger('wc_fragment_refresh');
        } else {
          $('.shop-page-show-failed-message').html(`
                    <div class="failed-message" style="color: ${response.color}">
                        <p>${response.message}</p>
                    </div>
                `).fadeIn();

          // Hide the message after 3 seconds
          setTimeout(function () {
            $('.shop-page-show-failed-message').fadeOut();
            $button.prop('disabled', false);
            $button.find('i, span').show();
          }, 1000);
        }
      });
    });
  });


  // Bulk Add to Cart in Single Product Page

  jQuery(document).ready(function ($) {
    $("body").on("click", ".bulk-add-to-cart", function (e) {
      e.preventDefault();

      let button = $(this);
      let cartIcon = button.data("carticon");

      // Avoid adding another spinner if one is already present
      if (!button.hasClass('loading')) {
        // Replace the cart-plus icon with a spinner
        button.find("i.fa").remove();
        button.prepend('<i class="fa fa-spinner fa-spin"></i>');

      }

      let selectedProductID = [];
      let selectedVariationID = [];
      let selectedQuantity = [];
      let selectedAttributes = [];


      // Loop through checked checkboxes and gather their details
      $("input[name='bulk_cart[]']:checked").each(function () {
        let $row = $(this).closest("tr");
        let variation_id = $(this).val();
        let product_id = $(".bulk-add-to-cart").data("productid");

        let quantity = $row.find(".quick-quantity-input").val();
        let attributes = {};

        $row.find(".quick-attribute-select, .quick-attribute-text").each(function () {
          let attr_name = $(this).attr("name");
          let attr_value = $(this).is("select") ? $(this).val() : $(this).text().trim();
          if (attr_name && attr_value) {
            attributes[attr_name] = attr_value;
          }
        });

        selectedProductID.push({
          product_id: product_id,
        });
        selectedVariationID.push({
          variation_id: variation_id,
        });
        selectedQuantity.push({
          quantity: quantity,
        });
        selectedAttributes.push({
          attributes: attributes,
        });

      });



      // Disable button and show loading state
      button.prop('disabled', true);

      if (selectedProductID.length > 0) {
        $.ajax({
          url: bulk_add_to_cart_params.ajax_url,
          type: "POST",
          data: {
            action: "bulk_add_to_cart",
            // variations: selectedVariations,
            product_id: selectedProductID,
            variation_id: selectedVariationID,
            quantity: selectedQuantity,
            arrayLength: selectedProductID.length,
            attributes: selectedAttributes,
            _wpnonce: quick_front_ajax_obj.nonce, // Add the nonce here
          },
          success: function (response) {
            if (response.success) {
              // Replace spinner with a check icon
              button.find("i.fa-spinner").remove();
              button.prepend('<i class="fa fa-check"></i>');

              // Restore the original cart-plus icon after a delay
              setTimeout(function () {
                button.find("i.fa-check").remove();
                button.prepend('<i class="' + cartIcon + '"></i>');
                button.prop('disabled', false);
                button.removeClass('loading');
              }, 3000);

              // Update cart totals and item count
              $(document.body).trigger('wc_fragment_refresh');
            } else {
              alert(response.message || "Failed to add products to cart.");
              button.find("i.fa-spinner").remove();
              button.prepend('<i class="' + cartIcon + '"></i>');
              button.prop('disabled', false);
              button.removeClass('loading');
            }
          },
          error: function () {
            alert("An error occurred. Please try again.");
            button.find("i.fa-spinner").remove();
            button.prepend('<i class="' + cartIcon + '"></i>');
            button.prop('disabled', false);
            button.removeClass('loading');
          }
        });
      } else {
        alert("Please select at least one product.");
        button.find("i.fa-spinner").remove();
        button.prepend('<i class="' + cartIcon + '"></i>');
        button.prop('disabled', false);
        button.removeClass('loading');
      }
    });
  });

  jQuery(document).ready(function ($) {
    function replaceAddToCartIcons() {
      $('.add-to-cart-icon-image-render-from-js').each(function () {
        const imageUrl = $(this).data('add-to-cart-icon-image');
        if (imageUrl) {
          const imgElement = $('<img>', {
            src: imageUrl,
            alt: 'Cart Icon',
            css: {
              height: '20px',
              width: '20px'
            }
          });
          $(this).replaceWith(imgElement);
        }
      });
    }

    // Run on page load
    replaceAddToCartIcons();

    // Run after AJAX calls
    $(document).on('ajaxComplete', function () {
      replaceAddToCartIcons();
    });
  });


});
