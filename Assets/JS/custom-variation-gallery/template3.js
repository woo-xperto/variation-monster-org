;(function($) {
    $(document).ready(function() {

        $(document).ready(function() {

            /**
             * Initialize gallery
             */
            function initializeGallery() {
                const default_gallery_data = variation_table_ajax_localization.default_gallery_data;
                ajaxCallGallery(default_gallery_data);
            }

            /**
             * Variation gallery, term gallery
             */
            function ajaxCallGallery(allImages) {
                setTimeout(function() {
                    var galleryContainer = $('.woocommerce-product-gallery');
                    var afterAllImages = [];

                    allImages.forEach(function(image) {
                        afterAllImages.push({
                            src: image.src,
                            thumb: image.thumb,
                            w: 1200,
                            h: 1200
                        });
                    });

                    // Main Slider HTML
                    var mainSliderHtml = '<div class="variation-gallery-slider-main">';
                    // Thumbnail Slider HTML
                    var thumbnailSliderHtml = '<div class="variation-gallery-slider-thumbnails">';
                    var lightBoxHtml = '<div class="lightbox-container">';

                    afterAllImages.forEach(function (image, index) {
                        mainSliderHtml += `<div class="gallery-slide">
                                                <div class="image-container">
                                                     <img src="${image.src}" alt="Product Image">
                                                </div>
                                            </div>`;

                        thumbnailSliderHtml += `<div class="gallery-thumbnail">
                                                    <img src="${image.src}" alt="Thumbnail ${index + 1}">
                                                </div>`;
                        // lightBoxHtml container
                        lightBoxHtml += `<button role="button" class="lightbox-button" aria-haspopup="dialog" aria-label="View full-screen image gallery">
                                           <i class="fas fa-search-plus lightbox-icon"></i>
                                        </button>`;
                    });

                    mainSliderHtml += '</div>';
                    thumbnailSliderHtml += '</div>';
                    lightBoxHtml += '</div>';

                    var flexContainer = '<div class="gallery-flex-container">' + lightBoxHtml + thumbnailSliderHtml + mainSliderHtml + '</div>';

                    // Insert the flex container into the gallery container
                    galleryContainer.html(flexContainer);

                    initializeSlickSliders();
                    initializeZoomEffect(); // Reinitialize zoom on slide change
                    $('.variation-gallery-slider-main').on('afterChange', function(event, slick, currentSlide) {
                        initializeZoomEffect(); // Reinitialize zoom on slide change
                    });

                    reinitializeWooCommerceLightbox(afterAllImages);
                    if (document.querySelector('.spinner-container')){
                        document.querySelector('.spinner-container').style.display = 'none';
                    }
                    $(".woocommerce-product-gallery").css("opacity", "1");
                }, 0);
            }

            /**
             * Slick Slider Initialize
             */
            function initializeSlickSliders() {
                var thumbnailSliderHeight = $('.variation-gallery-slider-thumbnails').height();
                var thumbnailHeight = $('.variation-gallery-slider-thumbnails .gallery-thumbnail').outerHeight(true);
                var slidesToShow = Math.floor(thumbnailSliderHeight / thumbnailHeight);

                // Initialize Main Slider
                $('.variation-gallery-slider-main').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: false,
                    asNavFor: '.variation-gallery-slider-thumbnails',
                    prevArrow: '',
                    nextArrow: '',
                    infinite: true,
                    speed: 300,
                    cssEase: 'ease',
                });

                // Initialize Thumbnail Slider (horizontal)
                $('.variation-gallery-slider-thumbnails').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    asNavFor: '.variation-gallery-slider-main',
                    dots: false,
                    arrows: false,
                    focusOnSelect: true,
                    vertical: false, // Remove vertical mode
                    verticalSwiping: false, // Remove vertical swiping
                    centerMode: false,
                    variableWidth: false,
                });

                $('.variation-gallery-slider-thumbnails').on('afterChange', function(event, slick, currentSlide) {
                    // Remove the `slick-current` class from all thumbnails
                    $('.variation-gallery-slider-thumbnails .gallery-thumbnail').removeClass('slick-current');

                    // Find the original slide (not the cloned one) and add the `slick-current` class
                    $('.variation-gallery-slider-thumbnails .gallery-thumbnail').each(function() {
                        var slideIndex = $(this).data('slick-index');
                        if (slideIndex === currentSlide) {
                            $(this).addClass('slick-current');
                        }
                    });
                });

            }

            /**
             * Initialize Zoom Effect
             */
            function initializeZoomEffect() {
                // Remove any existing zoom instance
                $('.variation-gallery-slider-main img').each(function () {
                    $(this).removeData('elevateZoom');
                    $('.zoomContainer').remove();
                });

                // Apply zoom to the currently active slide
                $('.variation-gallery-slider-main .slick-current img').each(function () {
                    var zoomImageUrl = $(this).attr('src');

                    $(this).elevateZoom({
                        zoomType: "inner",
                        scrollZoom: true,
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 500,
                        cursor: "crosshair"
                    });
                });
            }

            /**
             * Woocommerce default lightbox.
             */
            function reinitializeWooCommerceLightbox(allImages) {
                // Ensure WooCommerce's built-in gallery is refreshed
                if (typeof wc_product_gallery !== 'undefined') {
                    $('.woocommerce-product-gallery').each(function () {
                        $(this).wc_product_gallery();
                    });
                }

                // Remove previous event handlers to prevent duplicate binding
                $('.lightbox-button').off('click');

                // Fetch image dimensions
                Promise.all(allImages.map(function(image) {
                    return getImageDimensions(image.src).then(function(dimensions) {
                        return {
                            src: image.src,
                            w: dimensions.w,
                            h: dimensions.h
                        };
                    });
                })).then(function(pswpItems) {
                    // Attach PhotoSwipe event handler
                    $('.lightbox-button').on('click', function(event) {
                        event.preventDefault();

                        var currentSlide = $('.variation-gallery-slider-main').slick('slickCurrentSlide');

                        // Initialize PhotoSwipe
                        var pswpElement = document.querySelectorAll('.pswp')[0];
                        var options = {
                            index: currentSlide,
                            bgOpacity: 0.7,
                            showHideOpacity: true,
                            closeOnScroll: false,
                            getThumbBoundsFn: function(index) {
                                var thumbnail = document.querySelectorAll('.variation-gallery-slider-main img')[index];
                                var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                                var rect = thumbnail.getBoundingClientRect();
                                return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
                            }
                        };

                        var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, pswpItems, options);
                        gallery.init();

                        // Cleanup on close
                        gallery.listen('close', function() {
                            document.querySelector('.pswp--open').style.display = 'none !important';

                            pswpElement.style.display = 'none';
                            setTimeout(() => {
                                pswpElement.style.display = '';
                            }, 10);

                            pswpElement.className = 'pswp';

                            const observer = new MutationObserver(mutations => {
                                mutations.forEach(mutation => {
                                    console.log('Class changed:', mutation.target.classList);
                                });
                            });

                            observer.observe(pswpElement, { attributes: true, attributeFilter: ['class'] });

                        });
                    });
                }).catch(function(error) {
                    console.error('Failed to load image dimensions:', error);
                });
            }

            /**
             * Image dimension for lightbox.
             */
            function getImageDimensions(url) {
                return new Promise(function(resolve, reject) {
                    var img = new Image();
                    img.onload = function() {
                        resolve({
                            w: this.width,
                            h: this.height
                        });
                    };
                    img.onerror = function() {
                        reject(new Error('Failed to load image: ' + url));
                    };
                    img.src = url;
                });
            }

            /**
             * Term title sanitization.
             */
            function sanitizeTitle(text) {
                return text
                    .toString()
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^a-z0-9\-]/g, '')
                    .replace(/-+/g, '-');
            }

            /**
             * Spinner load for gallery images load time
             */
            function spinnerLoad(){
                const spinnerContainer = document.createElement('div');
                spinnerContainer.className = 'spinner-container';
                spinnerContainer.innerHTML = '<i class="fa fa-spinner fa-spin spin-icon-remove"></i>';
                document.querySelector('.woocommerce-product-gallery').appendChild(spinnerContainer);
                $(".woocommerce-product-gallery").css("opacity", "0");
                document.querySelector('.spinner-container').style.display = 'block';
            }

            /**
             * Gallery changes in the variation list template one
             */
            $(document).on('change', '.variation-list-template-one', function () {
                var variation_id = $('form.variations_form').find('input.variation_id').val();
                const variation_gallery_data = JSON.parse(variation_table_ajax_localization.variation_gallery_data);

                if (variation_id in variation_gallery_data) {
                    let variationImages = variation_gallery_data[variation_id];
                    spinnerLoad();
                    ajaxCallGallery(variationImages);
                } else {
                    console.warn("No gallery data found for", variation_id, "this variation id's");
                }
            });

            /**
             * Gallery changes in the variation list template two
             */
            $(document).on('click', '.variation-list-template-two', function () {
                var variation_id = $('form.variations_form').find('input.variation_id').val();
                const variation_gallery_data = JSON.parse(variation_table_ajax_localization.variation_gallery_data);

                if (variation_id in variation_gallery_data) {
                    let variationImages = variation_gallery_data[variation_id];
                    spinnerLoad();
                    ajaxCallGallery(variationImages);
                } else {
                    console.warn("No gallery data found for", variation_id, "this variation id's");
                }
            });

            /**
             * Gallery changes in the variation select fields
             */
            $('form.variations_form').on('change', 'select', function() {
                var form = $(this).closest('form.variations_form');
                var variation_id = form.find('input.variation_id').val();

                // If variation more and more that time issue create for time. start
                // form.on('found_variation', function(event, variation) {
                //     var variation_id = variation.variation_id;
                //     const variation_gallery_data = JSON.parse(variation_table_ajax_localization.variation_gallery_data);
                //     if (variation_id in variation_gallery_data) {
                //         let variationImages = variation_gallery_data[variation_id];
                //         ajaxCallGallery(variationImages);
                //     } else {
                //         console.warn("No gallery data found for", variation_id, "this variation id's");
                //     }
                // })
                // If variation more and more that time issue create for time. End


                // Check if any attribute is selected
                var allAttributesDeselected = true;
                var selectedAttributes = {};

                form.find('select').each(function() {
                    var attributeName = $(this).attr('name');
                    var selectedTermName = $(this).val();
                    if (selectedTermName) {
                        allAttributesDeselected = false;
                        selectedAttributes[attributeName] = selectedTermName;
                    }
                });

                if (allAttributesDeselected) {
                    const default_gallery_data = variation_table_ajax_localization.default_gallery_data;
                    spinnerLoad()
                    ajaxCallGallery(default_gallery_data);

                } else {
                    if (variation_id && (variation_id !== '0')) {
                        const variation_gallery_data = JSON.parse(variation_table_ajax_localization.variation_gallery_data);

                        if (variation_id in variation_gallery_data) {
                            let variationImages = variation_gallery_data[variation_id];
                            if (variationImages){
                                spinnerLoad()
                                ajaxCallGallery(variationImages);
                            }
                        } else {
                            console.warn("No gallery data found for", variation_id, "this variation id's");
                        }
                    } else {

                        var selectedTermName    = $(this).val();
                        const term_gallery_data = JSON.parse(variation_table_ajax_localization.term_gallery_data);
                        let termSlug            = sanitizeTitle(selectedTermName);

                        if (termSlug in term_gallery_data) {
                            let images = term_gallery_data[termSlug];
                            if (images){
                                spinnerLoad()
                                ajaxCallGallery(images);
                            }
                        } else {
                            console.warn("No gallery data found for", termSlug);
                        }
                    }
                }
            });

            initializeGallery();
        });

    });
})(jQuery);