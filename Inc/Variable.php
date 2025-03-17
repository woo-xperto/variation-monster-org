<?php

class Quickvariables
{
    /**
     * Define Constant.
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function __construct(){

        add_action('wp', function() {
            global $post;
            $variableSetting                = get_option('variable_all_checked', array());
            $variationSelectOnOff           = isset($variableSetting['variationSelectOnOff']) ? $variableSetting['variationSelectOnOff'] : '';
            $selectVariationTemplateOnOff   = isset($variableSetting['selectVariationTemplateOnOff']) ? $variableSetting['selectVariationTemplateOnOff'] : '';
            $variationListTemplate          = isset($variableSetting['variationListTemplate']) ? $variableSetting['variationListTemplate'] : 'template_1';
            $metaVariableList         = get_post_meta($post->ID, '_variation_list_meta', true);
            $metaVariableListTemplate       = get_post_meta($post->ID, '_variation_list_template_meta', true);
            $metaVariationSwatches   = get_post_meta($post->ID, '_variation_swatches_meta', true);

            if ($variationSelectOnOff === "true" && $selectVariationTemplateOnOff === "false") {
                if ($metaVariationSwatches === 'true' || $metaVariationSwatches === ''){
                    add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'variation_select_options_swatches' ], 20, 2 );
                }
            }elseif (($variationSelectOnOff === "true" && $selectVariationTemplateOnOff === "true") || ($variationSelectOnOff === "false" && $selectVariationTemplateOnOff === "true")){
                if ($metaVariableList === 'true' || $metaVariableList === ''){
                    if ($metaVariableListTemplate !== '' ) {
                        if ($metaVariableListTemplate === "template_1"){
                            add_action( 'woocommerce_before_variations_form', function() {
                                remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
                            }, 5 );
                            add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'variation_table_variation_select_template_1' ], 20, 2 );
                            add_action( 'woocommerce_before_add_to_cart_button', function() {
                                global $product;
                                if ( $product->is_type( 'variable' ) ) {
                                    print_r (apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', '', [
                                        'attribute' => '',
                                        'options'   => wc_get_product_terms( $product->get_id(), '', [ 'fields' => 'ids' ] ),
                                        'product'   => $product,
                                    ]));
                                }
                            }, 15 );
                        }else{
                            add_action( 'woocommerce_before_variations_form', function() {
                                remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
                            }, 5 );
                            add_action( 'woocommerce_before_add_to_cart_button', function() {
                                global $product;
                                if ( $product->is_type( 'variable' ) ) {
                                    print_r(apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', '', [
                                        'attribute' => '',
                                        'options'   => wc_get_product_terms( $product->get_id(), '', [ 'fields' => 'ids' ] ),
                                        'product'   => $product,
                                    ]));
                                }
                            }, 15 );
                        }
                    }else{
                        if ($variationListTemplate === "template_1"){
                            add_action( 'woocommerce_before_variations_form', function() {
                                remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
                            }, 5 );
                            add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'variation_table_variation_select_template_1' ], 20, 2 );
                            add_action( 'woocommerce_before_add_to_cart_button', function() {
                                global $product;
                                if ( $product->is_type( 'variable' ) ) {
                                    print_r (apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', '', [
                                        'attribute' => '',
                                        'options'   => wc_get_product_terms( $product->get_id(), '', [ 'fields' => 'ids' ] ),
                                        'product'   => $product,
                                    ]));
                                }
                            }, 15 );
                        }else{
                            add_action( 'woocommerce_before_variations_form', function() {
                                remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
                            }, 5 );
                            add_action( 'woocommerce_before_add_to_cart_button', function() {
                                global $product;
                                if ( $product->is_type( 'variable' ) ) {
                                    print_r (apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', '', [
                                        'attribute' => '',
                                        'options'   => wc_get_product_terms( $product->get_id(), '', [ 'fields' => 'ids' ] ),
                                        'product'   => $product,
                                    ]));
                                }
                            }, 15 );
                        }
                    }
                }else{
                    if ($variationSelectOnOff === 'true' && ($metaVariationSwatches === 'true' || $metaVariationSwatches === '')){
                        add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'variation_select_options_swatches' ], 20, 2 );
                    }
                }
            }
        });
        $variableSetting               = get_option('variable_all_checked', array());
        $quickCarouselPosition         = isset($variableSetting['quickCarouselPosition']) ? $variableSetting['quickCarouselPosition'] : 'woocommerce_after_shop_loop_item';
        $quickTablePosition            = isset($variableSetting['quickTablePosition']) ? $variableSetting['quickTablePosition'] : 'woocommerce_after_single_product_summary';
        $showAttributeSwatchesArchive  = isset($variableSetting['showAttributeSwatchesArchive'][0]) ? $variableSetting['showAttributeSwatchesArchive'][0] : 'none';

        add_action( 'woocommerce_after_shop_loop_item_title', [$this,"variation_swatches_redirect_single_product_page_archive_loop_item",]);

        add_action( $quickCarouselPosition, [$this,"quick_display_product_variations",]);
        add_action( $quickTablePosition, [ $this,"quick_variables_single_page",]);
    }

    /**
     * Variation Swatches setup attribute for redirecting to single product page.
     *
     * @return void
     * @since 1.0.3
     */
    public function variation_swatches_redirect_single_product_page_archive_loop_item()
    {
        global $product;

        if ((is_product() || is_shop() || is_product_category()) ) {
            $term_order = $this->get_product_term_order($product);
            wp_localize_script('frontend-js', 'productTermOrder', $term_order);
        }

        if (!function_exists('variation_swatches_redirect_archive_to_single')) {
            function variation_swatches_redirect_archive_to_single( $html, $args ) {
                global $post;
                global $product;
                $variableSetting                 = get_option('variable_all_checked', array());
                $globallyTooltipOnOff            = isset($variableSetting['globallyTooltipOnOff']) ? $variableSetting['globallyTooltipOnOff'] : '';
                $selectVariationTooltipBgColor   = isset($variableSetting['selectVariationTooltipBgColor']) ? $variableSetting['selectVariationTooltipBgColor'] : '#000000';
                $selectVariationTooltipTextColor = isset($variableSetting['selectVariationTooltipTextColor']) ? $variableSetting['selectVariationTooltipTextColor'] : '#FFFFFF';
                $selectVariationButtonBgColor    = isset($variableSetting['selectVariationButtonBgColor']) ? $variableSetting['selectVariationButtonBgColor'] : '#0071a1';
                $selectVariationButtonTextColor  = isset($variableSetting['selectVariationButtonTextColor']) ? $variableSetting['selectVariationButtonTextColor'] : '#FFFFFF';
                $imageColorWidth                 = isset($variableSetting['imageColorWidth']) ? $variableSetting['imageColorWidth'] : '40';
                $imageColorHeight                = isset($variableSetting['imageColorHeight']) ? $variableSetting['imageColorHeight'] : '40';
                $imageColorBorderRadius          = isset($variableSetting['imageColorBorderRadius']) ? $variableSetting['imageColorBorderRadius'] : '50';
                $tooltip                         = '';
                $term_order = [];
                global $product;
                $attributes = $product->get_attributes();
                $productID = $product->get_id();
                $baseURL                    = get_permalink($productID);

                foreach ($attributes as $attribute_name => $attribute) {
                    if ($attribute->is_taxonomy()) {
                        $terms = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'all']);
                        foreach ($terms as $index => $term) {
                            $term_order[$attribute_name][$term->slug] = $index + 1;
                        }
                    }
                }

                /** @var array $args */
                $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), [
                    'options'          => false,
                    'attribute'        => false,
                    'product'          => false,
                    'selected'         => false,
                    'name'             => '',
                    'id'               => '',
                    'class'            => '',
                    'show_option_none' => __('Choose an option', 'variation-monster'),
                ]);

                /** @var WC_Product_Variable $product */
                $options          = $args['options'];
                $product          = $args['product'];
                $attribute        = $args['attribute'];
                $name             = $args['name'] ?: 'attribute_'.sanitize_title($attribute);
                $id               = $args['id'] ?: sanitize_title($attribute);
                $class            = $args['class'];
                $show_option_none = (bool)$args['show_option_none'];



                // Inside vb_custom_variation_buttons method
                if (!empty($attribute)) {
                    if ($product && taxonomy_exists($attribute)) {
                        $attribute_id = null;
                        $attribute_slug = null;
                        // Debugging attribute data
                        if ($product instanceof WC_Product_Variable) {
                            $attributes = $product->get_attributes();

                            if (isset($attributes[$attribute])) {
                                $attribute_data = $attributes[$attribute];

                                if ($attribute_data->is_taxonomy()) {
                                    $attribute_id = $attribute_data->get_id();
                                    $attribute_slug = sanitize_title($attribute_data->get_name());
                                }
                            }
                        }

                        $meta_display_type      = get_post_meta($post->ID, 'variation_meta_attribute_display_type_' . $attribute_slug, true);
                        $show_attribute_archive = get_post_meta($post->ID, 'show_attribute_archive_page_' . $attribute_slug, true);

                        if (empty($meta_display_type)){
                            $display_type          = get_option( 'wc_attribute_display_type_' . $attribute_id );
                        }else{
                            $display_type = $meta_display_type;
                        }
                        $show_option_none_text = $args['show_option_none'] ?: __('Choose an option', 'variation-monster');

                        // Get selected value.
//                        if ($attribute && $product instanceof WC_Product && $args['selected'] === false) {
//                            $selected_key     = 'attribute_'.sanitize_title($attribute);
//                            $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key]))
//                                : $product->get_variation_default_attribute($attribute);
//                        }

                        if (empty($options) && ! empty($product) && ! empty($attribute)) {
                            $attributes = $product->get_variation_attributes();
                            $options    = $attributes[$attribute];
                        }
                        if ($display_type === 'radio' && $show_attribute_archive ==="yes") {

                            $radios = '<div class="custom-wc-variations" style="margin-top: 10px">';

                            if ( ! empty($options)) {
                                if ($product && taxonomy_exists($attribute)) {
                                    $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                                    $variations_by_term = get_available_variations_by_term($product, $attribute);
                                    $variations         = $product->get_available_variations();

                                    foreach ($terms as $term) {

                                        $any_size_variations = array_filter($variations, function ($variation) use ($attribute) {
                                            foreach ($variation['attributes'] as $key => $value) {
                                                if (
                                                    strpos($key, 'attribute_pa_') !== false &&
                                                    (empty($value) || strpos($value, 'any') === 0)
                                                ) {
                                                    return true;
                                                }
                                            }
                                            return false;
                                        });

                                        $term_variations      = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                        $available_variations = array_merge($term_variations, $any_size_variations);
                                        $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');

                                        if (in_array($term->slug, $options, true)) {

                                            $radios .= '<input type="radio" name="custom_'.esc_attr($name).'" 
                                    data-available-variations="' . esc_attr($variations_json) . '" 
                                    data-value="'.esc_attr($term->slug).'" id="'
                                                .esc_attr($name).'_'.esc_attr($term->slug).'" data-variation-name="'.esc_attr($name).'" '
                                                .checked(sanitize_title($args['selected']), $term->slug, false).'>';
                                            $radios .= '<label for="'.esc_attr($name).'_'.esc_attr($term->slug).'">';
                                            $radios .= esc_html(apply_filters('woocommerce_variation_option_name', $term->name));
                                            $radios .= '</label>';

                                        }
                                    }
                                } else {
                                    foreach ($options as $option) {
                                        $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'],
                                            sanitize_title($option), false) : checked($args['selected'], $option, false);
                                        $radios  .= '<input type="radio" name="custom_'.esc_attr($name).'"
                                data-value="'.esc_attr($option).'" id="'
                                            .esc_attr($name).'_'.esc_attr($option).'" data-variation-name="'.esc_attr($name).'" '.$checked.'>';
                                        $radios  .= '<label for="'.esc_attr($name).'_'.esc_attr($option).'">';
                                        $radios  .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                        $radios  .= '</label>';
                                    }
                                }
                            }

                            $radios .= '</div>';

                            return $html.$radios;
                        }elseif (($display_type === 'button' || $display_type === "select" || empty($display_type)) && $show_attribute_archive ==="yes") {

                            $buttons    = '<div class="custom-wc-buttons" style="margin-top: 10px; flex-wrap: wrap">';
                            $product_id = $product->get_id();

                            if (!empty($options)) {
                                if ($product && taxonomy_exists($attribute)) {
                                    $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                                    $variations_by_term = get_available_variations_by_term($product, $attribute);
                                    $variations         = $product->get_available_variations();



                                    foreach ($terms as $term) {
                                        if (in_array($term->slug, $options, true)) {
                                            $selected            = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                            $term_id             = $term->term_id;
                                            $check_meta_tooltip  = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            $any_size_variations = array_filter($variations, function ($variation) use ($attribute) {
                                                foreach ($variation['attributes'] as $key => $value) {
                                                    if (
                                                        strpos($key, 'attribute_pa_') !== false &&
                                                        (empty($value) || strpos($value, 'any') === 0)
                                                    ) {
                                                        return true;
                                                    }
                                                }
                                                return false;
                                            });

                                            $term_variations      = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                            $available_variations = array_merge($term_variations, $any_size_variations);
                                            $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');
                                            $attribute_slug       = 'attribute_' . $term->taxonomy . '=' . $term->name;
                                            $termURL              = $baseURL . '?' . $attribute_slug;

                                            if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                                $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                if ($globallyTooltipOnOff === 'true'){
                                                    $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                                }
                                            }
                                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                                $tooltip = $term->name;
                                            }

                                            $buttons .= '<a type="button" class="custom-button ' . esc_attr($selected) . '" 
                                                data-value="' . esc_attr($term->slug) . '" 
                                                href="' . esc_attr($termURL) . '" 
                                                data-product_id="' . esc_attr($product_id) . '" 
                                                data-variation-name="' . esc_attr($name) . '" 
                                                data-tooltip="' . esc_attr($tooltip) . '" 
                                                data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                                data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                data-available_variations="' . esc_attr($variations_json) . '" 
                                                data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                                style=" background-color: ' . esc_attr($selectVariationButtonBgColor) . '; 
                                                color: ' . esc_attr($selectVariationButtonTextColor) . ';">';
                                            $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $term->name));
                                            $buttons .= '</a>';
                                        }
                                    }
                                } else {
                                    foreach ($options as $option) {
                                        $selected = sanitize_title($args['selected']) === $option ? 'selected' : '';
                                        $buttons .= '<a type="button" class="custom-button ' . esc_attr($selected) . '" 
                                data-value="' . esc_attr($option) . '" 
                                data-variation-name="' . esc_attr($name) . '">';
                                        $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                        $buttons .= '</a>';
                                    }
                                }
                            }

                            $buttons .= '</div>';

                            return $html . $buttons;
                        }elseif ($display_type === 'image' && $show_attribute_archive ==="yes") {

                            $images = '<div class="custom-wc-images" style="margin-top: 10px; flex-wrap: wrap">';

                            if (!empty($options)) {
                                if ($product && taxonomy_exists($attribute)) {
                                    $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                                    $variations_by_term = get_available_variations_by_term($product, $attribute);
                                    $variations         = $product->get_available_variations();

                                    foreach ($terms as $term) {
                                        if (in_array($term->slug, $options, true)) {
                                            $selected            = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                            $term_id             = $term->term_id;
                                            $check_meta_tooltip  = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            $check_meta_image    = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id, true);
                                            $any_size_variations = array_filter($variations, function ($variation) use ($attribute) {
                                                foreach ($variation['attributes'] as $key => $value) {
                                                    if (
                                                        strpos($key, 'attribute_pa_') !== false &&
                                                        (empty($value) || strpos($value, 'any') === 0)
                                                    ) {
                                                        return true;
                                                    }
                                                }
                                                return false;
                                            });

                                            $term_variations      = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                            $available_variations = array_merge($term_variations, $any_size_variations);
                                            $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');
                                            $attribute_slug       = 'attribute_' . $term->taxonomy . '=' . $term->name;
                                            $termURL              = $baseURL . '?' . $attribute_slug;


                                            if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                                $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                if ($globallyTooltipOnOff === 'true'){
                                                    $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                                }
                                            }
                                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                                $tooltip = $term->name;
                                            }

                                            if (!empty($check_meta_image)) {
                                                $image = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                $image   = get_term_meta($term_id, 'term_image', true);
                                            }

                                            $image_url = $image ? (is_numeric($image) ? wp_get_attachment_url($image) : esc_url($image)) : '';

                                            $images .= '<a type="button" class="custom-image-button ' . esc_attr($selected) . '" 
                                                data-value="' . esc_attr($term->slug) . '" 
                                                href="' . esc_attr($termURL) . '" 
                                                data-variation-name="' . esc_attr($name) . '" 
                                                data-tooltip="' . esc_attr($tooltip) . '" 
                                                data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                                data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                data-available_variations="' . esc_attr($variations_json) . '" 
                                                data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                                style=" height: ' . esc_attr($imageColorHeight) . 'px; 
                                                width: ' . esc_attr($imageColorWidth) . 'px; 
                                                border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;">';

                                            if ($image_url) {
                                                $image_id = attachment_url_to_postid($image_url);
                                                if ($image_id) {
                                                    $images .= wp_get_attachment_image($image_id, 'full', false, [
                                                        'alt'   => esc_attr($term->name),
                                                        'style' => 'height: ' . esc_attr($imageColorHeight) . 'px; 
                                                         width: ' . esc_attr($imageColorWidth) . 'px; 
                                                         border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;',
                                                    ]);
                                                }

                                            } else {
                                                $images .= '<span class="term-name">' . esc_html($term->name) . '</span>';
                                            }

                                            $images .= '</a>';
                                        }
                                    }
                                }
                            }

                            $images .= '</div>';

                            return $html . $images;
                        }elseif ($display_type === "color" && $show_attribute_archive ==="yes") {
                            $product_id = $product->get_id();
                            $colors = '<div class="custom-wc-colors" style="margin-top: 10px; flex-wrap: wrap">';

                            if (!empty($options)) {
                                if ($product && taxonomy_exists($attribute)) {
                                    $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                                    $variations_by_term = get_available_variations_by_term($product, $attribute);
                                    $variations         = $product->get_available_variations();


                                    foreach ($terms as $term) {
                                        if (in_array($term->slug, $options, true)) {

                                            $selected           = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                            $term_id            = $term->term_id;
                                            $check_meta_tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            $check_meta_color   = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id, true);
                                            $check_meta_secondary_color   = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id, true);
                                            $any_size_variations = array_filter($variations, function ($variation) use ($attribute) {
                                                foreach ($variation['attributes'] as $key => $value) {
                                                    if (
                                                        strpos($key, 'attribute_pa_') !== false &&
                                                        (empty($value) || strpos($value, 'any') === 0)
                                                    ) {
                                                        return true;
                                                    }
                                                }
                                                return false;
                                            });

                                            $term_variations      = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                            $available_variations = array_merge($term_variations, $any_size_variations);
                                            $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');
                                            $attribute_slug       = 'attribute_' . $term->taxonomy . '=' . $term->name;
                                            $termURL              = $baseURL . '?' . $attribute_slug;

                                            if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                                $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                if ($globallyTooltipOnOff === 'true'){
                                                    $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                                }
                                            }

                                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                                $tooltip = $term->name;
                                            }

                                            if (!empty($check_meta_color)) {
                                                $color = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                $color   = get_term_meta($term_id, 'term_color', true);
                                            }

                                            if (!empty($check_meta_secondary_color)) {
                                                $secondary_color = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id, true);
                                            }else{
                                                $secondary_color   = get_term_meta($term_id, 'term_secondary_color', true);
                                            }

                                            if (!empty($color)) {

                                                if ($secondary_color){
                                                    $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   href="' . esc_attr($termURL) . '" 
                                                   data-product_id="' . esc_attr($product_id) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '" 
                                                   data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-available_variations="' . esc_attr($variations_json) . '" 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style="background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondary_color) . ' 50%); 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                                   display: flex; 
                                                   justify-content: center; 
                                                   align-items: center;">';

                                                    $colors .= '<span class="color-label">' . esc_html($term->name) . '</span>';
                                                }else{
                                                    $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   data-product_id="' . esc_attr($product_id) . '" 
                                                   href="' . esc_attr($termURL) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '" 
                                                   data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-available_variations="' . esc_attr($variations_json) . '" 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style=" background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                                   display: flex; 
                                                   justify-content: center; 
                                                   align-items: center;">';

                                                    $colors .= '<span class="color-label">' . esc_html($term->name) . '</span>';
                                                }
                                            } else {

                                                $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   data-product_id="' . esc_attr($product_id) . '" 
                                                   href="' . esc_attr($termURL) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '" 
                                                   data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style=" background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;  
                                                   justify-content: center; align-items: center;">';

                                                $colors .= '<span class="term-name">' . esc_html($term->name) . '</span>';
                                            }
                                            $colors .= '</a>';

                                            $colors .= '</a>';
                                        }
                                    }
                                }
                            }

                            $colors .= '</div>';

                            return $html . $colors;
                        }
                    } else {
                        $attribute_id = wc_attribute_taxonomy_id_by_name($attribute);
                        $attribute_slug = null;
                        if ($attribute_id) {
                            $attribute_obj = wc_get_attribute($attribute_id);
                            if ($attribute_obj) {
                                $attribute_slug = sanitize_title($attribute_obj->name);
                            }
                        } else {
                            $attribute_slug = sanitize_title($attribute);
                        }
                        $display_type = get_post_meta($post->ID, 'variation_meta_attribute_display_type_' . $attribute_slug, true);
                        $show_attribute_archive = get_post_meta($post->ID, 'show_attribute_archive_page_' . $attribute_slug, true);

                        if (($display_type === 'button' || $display_type === "select" || empty($display_type)) && $show_attribute_archive ==="yes") {

                            $buttons = '<div class="custom-wc-buttons" style="margin-top: 10px; flex-wrap: wrap;">';
                            $product_id = $product->get_id();
                            $variations         = $product->get_available_variations();
                            $variations_json      = htmlspecialchars(wp_json_encode($variations), ENT_QUOTES, 'UTF-8');


                            if (!empty($options)) {
                                foreach ($options as $option) {

                                    $selected          = sanitize_title($args['selected']) === $option ? 'selected' : '';
                                    $custom_value_slug = sanitize_title($option);
                                    $attribute_name_redirect = str_replace('pa_', '', $name);
                                    $attribute_name_slug = sanitize_title($attribute_name_redirect);
                                    $custom_term_slug = $attribute_name_slug . '=' . sanitize_title($option);
                                    $termURL              = $baseURL . '?' . $custom_term_slug;


                                    if ($globallyTooltipOnOff === 'true'){
                                        $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                                    }

                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        if (is_object($option)) {
                                            $tooltip = $option->name;
                                        } else {
                                            $tooltip = $option;
                                        }

                                    }

                                    $buttons .= '<a type="button" class="custom-button ' . esc_attr($selected) . '" 
                                        data-value="' . esc_attr($option) . '" 
                                        href="' . esc_attr($termURL) . '" 
                                        data-variation-name="' . esc_attr($name) . '"
                                        data-tooltip="' . esc_attr($tooltip) . '" 
                                        data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                        data-product_id="' . esc_attr($product_id) . '" 
                                        data-available_variations="' . esc_attr($variations_json) . '" 
                                        data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                        data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                        data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                        style=" background-color: ' . esc_attr($selectVariationButtonBgColor) . '; 
                                        color: ' . esc_attr($selectVariationButtonTextColor) . ';">';
                                    $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                    $buttons .= '</a>';
                                }
                            }

                            $buttons .= '</div>';

                            return $html . $buttons;
                        }elseif ($display_type === 'radio' && $show_attribute_archive ==="yes") {

                            $radios = '<div class="custom-wc-variations" style="margin-top: 10px;">';

                            if ( ! empty($options)) {
                                foreach ($options as $option) {
                                    $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'],
                                        sanitize_title($option), false) : checked($args['selected'], $option, false);
                                    $radios  .= '<input type="radio" name="custom_'.esc_attr($name).'" data-value="'.esc_attr($option).'" id="'
                                        .esc_attr($name).'_'.esc_attr($option).'" data-variation-name="'.esc_attr($name).'" '.$checked.'>';
                                    $radios  .= '<label for="'.esc_attr($name).'_'.esc_attr($option).'">';
                                    $radios  .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                    $radios  .= '</label>';
                                }
                            }

                            $radios .= '</div>';

                            return $html.$radios;
                        }elseif ($display_type === 'image' && $show_attribute_archive ==="yes") {

                            $images = '<div class="custom-wc-images" style="margin-top: 10px; flex-wrap: wrap;">';

                            if (!empty($options)) {
                                foreach ($options as $option) {

                                    $product_id        = $product->get_id();
                                    $variations        = $product->get_available_variations();
                                    $variations_json   = htmlspecialchars(wp_json_encode($variations), ENT_QUOTES, 'UTF-8');
                                    $custom_value_slug = sanitize_title($option);
                                    $selected          = sanitize_title($args['selected']) === $option ? 'selected' : '';
                                    $image             = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $custom_value_slug . '_' . $attribute_id, true);
                                    $image_url         = $image ? (is_numeric($image) ? wp_get_attachment_url($image) : esc_url($image)) : '';

                                    $attribute_name_redirect = str_replace('pa_', '', $name);
                                    $attribute_name_slug = sanitize_title($attribute_name_redirect);
                                    $custom_term_slug = $attribute_name_slug . '=' . sanitize_title($option);
                                    $termURL              = $baseURL . '?' . $custom_term_slug;

                                    if ($globallyTooltipOnOff === 'true'){
                                        $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                                    }

                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        if (is_object($option)) {
                                            $tooltip = $option->name;
                                        } else {
                                            $tooltip = $option;
                                        }

                                    }

                                    $images .= '<a type="button" class="custom-image-button ' . esc_attr($selected) . '" 
                                        data-value="' . esc_attr($option) . '" 
                                        href="' . esc_attr($termURL) . '" 
                                        data-variation-name="' . esc_attr($name) . '" 
                                        data-tooltip="' . esc_attr($tooltip) . '" 
                                        data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                         data-product_id="' . esc_attr($product_id) . '" 
                                        data-available_variations="' . esc_attr($variations_json) . '" 
                                        data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                        data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                        data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                        style=" height: ' . esc_attr($imageColorHeight) . 'px; 
                                        width: ' . esc_attr($imageColorWidth) . 'px; 
                                        border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;">';

                                    if ($image_url) {
                                        $image_id = attachment_url_to_postid($image_url);
                                        if ($image_id) {
                                            $images .= wp_get_attachment_image($image_id, 'full', false, [
                                                'alt'   => esc_attr($option),
                                                'style' => 'height: ' . esc_attr($imageColorHeight) . 'px; 
                                                 width: ' . esc_attr($imageColorWidth) . 'px; 
                                                 border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;',
                                            ]);
                                        }
                                    } else {

                                        $images .= '<span class="term-name">' . esc_html($option) . '</span>';
                                    }

                                    $images .= '</a>';
                                }
                            }

                            $images .= '</div>';

                            return $html . $images;
                        }elseif ($display_type === "color" && $show_attribute_archive ==="yes") {

                            $colors = '<div class="custom-wc-colors" style="margin-top: 10px; flex-wrap: wrap;">';

                            if (!empty($options)) {
                                foreach ($options as $option) {

                                    $product_id        = $product->get_id();
                                    $variations        = $product->get_available_variations();
                                    $variations_json   = htmlspecialchars(wp_json_encode($variations), ENT_QUOTES, 'UTF-8');
                                    $custom_value_slug = sanitize_title($option);
                                    $selected          = sanitize_title($args['selected']) === $option ? 'selected' : '';
                                    $color             = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $custom_value_slug . '_' . $attribute_id, true);
                                    $secondary_color   = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $custom_value_slug . '_' . $attribute_id, true);

                                    $attribute_name_redirect = str_replace('pa_', '', $name);
                                    $attribute_name_slug = sanitize_title($attribute_name_redirect);
                                    $custom_term_slug = $attribute_name_slug . '=' . sanitize_title($option);
                                    $termURL              = $baseURL . '?' . $custom_term_slug;

                                    if ($globallyTooltipOnOff === 'true'){
                                        $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                                    }

                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        if (is_object($option)) {
                                            $tooltip = $option->name;
                                        } else {
                                            $tooltip = $option;
                                        }

                                    }

                                    if (!empty($color)) {

                                        if ($secondary_color){
                                            $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                               data-value="' . esc_attr($option) . '" 
                                               href="' . esc_attr($termURL) . '" 
                                               data-variation-name="' . esc_attr($name) . '" 
                                               data-tooltip="' . esc_attr($tooltip) . '" 
                                               data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                               data-product_id="' . esc_attr($product_id) . '" 
                                               data-available_variations="' . esc_attr($variations_json) . '" 
                                               data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                               data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                               data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                               style="background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondary_color) . ' 50%); 
                                               height: ' . esc_attr($imageColorHeight) . 'px; 
                                               width: ' . esc_attr($imageColorWidth) . 'px; 
                                               border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                               display: flex; 
                                               justify-content: center; 
                                               align-items: center;">';
                                        }else{
                                            $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                               data-value="' . esc_attr($option) . '" 
                                               href="' . esc_attr($termURL) . '" 
                                               data-variation-name="' . esc_attr($name) . '" 
                                               data-tooltip="' . esc_attr($tooltip) . '" 
                                               data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                               data-product_id="' . esc_attr($product_id) . '" 
                                               data-available_variations="' . esc_attr($variations_json) . '" 
                                               data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                               data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                               data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                               style="background-color: ' . esc_attr($color) . '; 
                                               height: ' . esc_attr($imageColorHeight) . 'px; 
                                               width: ' . esc_attr($imageColorWidth) . 'px; 
                                               border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                               display: flex; 
                                               justify-content: center; 
                                               align-items: center;">';
                                        }

                                        $colors .= '<span class="color-label">' . esc_html($option) . '</span>';
                                    } else {

                                        $colors .= '<a type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($custom_value_slug) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   href="' . esc_attr($termURL) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '"  
                                                   data-tooltip-label="' . esc_attr(wc_attribute_label($attribute, $product)) . '"
                                                   data-product_id="' . esc_attr($product_id) . '" 
                                                   data-available_variations="' . esc_attr($variations_json) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style=" background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;  
                                                   justify-content: center; align-items: center;">';

                                        $colors .= '<span class="term-name">' . esc_html($option) . '</span>';
                                    }
                                    $colors .= '</a>';

                                    $colors .= '</a>';
                                }
                            }

                            $colors .= '</div>';

                            return $html . $colors;
                        }
                    }
                }
            }
        }


        global $product;
        global $post;
        $variableSetting               = get_option('variable_all_checked', array());
        $showAttributeSwatchesArchive  = isset($variableSetting['showAttributeSwatchesArchive'][0]) ? $variableSetting['showAttributeSwatchesArchive'][0] : 'none';
        $metaVariationSwatchesArchive  = get_post_meta($post->ID, '_variation_swatches_archive_page_meta', true);
        if (($showAttributeSwatchesArchive === 'attribute-archive' || $metaVariationSwatchesArchive === 'attribute-archive') && $showAttributeSwatchesArchive !== 'none') {
            if (($metaVariationSwatchesArchive !== 'none') && ($metaVariationSwatchesArchive !== 'attribute-swatches') ) {

                if ($product->get_id() === $post->ID) {
                    echo '<style>a[data-product_id="' . esc_attr( $post->ID ) . '"].product_type_variable { display: none !important; }</style>';
                }

                if ($product->is_type('variable')) {
                    $attributes = $product->get_variation_attributes();
                    $attribute_keys = array_keys($attributes);

                    echo '<div class="variations-display-redirecting-single-product">';

                    foreach ($attribute_keys as $attribute_key) {
                        $args = [
                            'options'          => $attributes[$attribute_key],
                            'attribute'        => $attribute_key,
                            'product'          => $product,
                            'selected'         => false,
                            'name'             => 'attribute_' . sanitize_title($attribute_key),
                            'id'               => sanitize_title($attribute_key),
                            'class'            => '',
                            'show_option_none' => __('Choose an option', 'variation-monster'),
                        ];

                        // Call custom function to render the color, image, or button options.
                        echo wp_kses_post(variation_swatches_redirect_archive_to_single('', $args));
                    }

                    echo '</div>';
                }
            }
        }


    }


    /**
     * Get all variations of the variable products into shop page.
     *
     * @return void
     * @since 1.0.0
     */
    public function quick_display_product_variations()
    {
        require plugin_dir_path(__FILE__) . "/Templates/Variable-slider.php";

    }

    /**
     * Variations Table Single Product Page.
     *
     * @return void
     * @since 1.0.0
     */
    function quick_variables_single_page()
    {
        global $product;

        if (is_product() && $product->is_type('variable')) {
            $term_order = $this->get_product_term_order($product);

            // Localize the script with term order data
            wp_localize_script('frontend-js', 'productTermOrder', $term_order);

            require_once plugin_dir_path(__FILE__) . "/Templates/Variable-single-table.php";
        }
    }

    /**
     * Get the term order for product variations.
     *
     * @param WC_Product $product
     * @return array
     */
    private function get_product_term_order($product)
    {
        $term_order = [];

        $attributes = $product->get_attributes();

        foreach ($attributes as $attribute_name => $attribute) {
            if ($attribute->is_taxonomy()) {
                $terms = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'all']);
                foreach ($terms as $index => $term) {
                    $term_order[$attribute_name][$term->slug] = $index + 1;
                }
            }
        }
        return $term_order;
    }

    /**
     * Variations Slide Popup Product Page.
     *
     * @return void
     * @since 1.0.0
     */
    public function quickVariablePopup()
    {
        require plugin_dir_path(__FILE__) . "/Templates/Variable-popup.php";
    }

    /**
     * Replace dropdowns with buttons for product variations.
     *
     * @param string $html The default dropdown HTML.
     * @param array  $args The arguments for the dropdown.
     * @return string | void Modified HTML with buttons.
     * @since 1.0.3
     */
    public function variation_select_options_swatches( $html, $args ) {
        global $post;
        $variableSetting                 = get_option('variable_all_checked', array());
        $globallyTooltipOnOff            = isset($variableSetting['globallyTooltipOnOff']) ? $variableSetting['globallyTooltipOnOff'] : '';
        $selectVariationTooltipBgColor   = isset($variableSetting['selectVariationTooltipBgColor']) ? $variableSetting['selectVariationTooltipBgColor'] : '#000000';
        $selectVariationTooltipTextColor = isset($variableSetting['selectVariationTooltipTextColor']) ? $variableSetting['selectVariationTooltipTextColor'] : '#FFFFFF';
        $selectVariationButtonBgColor    = isset($variableSetting['selectVariationButtonBgColor']) ? $variableSetting['selectVariationButtonBgColor'] : '#0071a1';
        $selectVariationButtonTextColor  = isset($variableSetting['selectVariationButtonTextColor']) ? $variableSetting['selectVariationButtonTextColor'] : '#FFFFFF';
        $imageColorWidth                 = isset($variableSetting['imageColorWidth']) ? $variableSetting['imageColorWidth'] : '40';
        $imageColorHeight                = isset($variableSetting['imageColorHeight']) ? $variableSetting['imageColorHeight'] : '40';
        $imageColorBorderRadius          = isset($variableSetting['imageColorBorderRadius']) ? $variableSetting['imageColorBorderRadius'] : '50';

        $term_order = [];
        global $product;
        $attributes = $product->get_attributes();

        foreach ($attributes as $attribute_name => $attribute) {
            if ($attribute->is_taxonomy()) {
                // For taxonomy-based attributes
                $terms = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'all']);
                foreach ($terms as $index => $term) {
                    $term_order[$attribute_name][$term->slug] = $index + 1;
                }
            } else {
                // For custom attributes (non-taxonomy)
                $attribute_values = $attribute->get_options(); // Get the values of the custom attribute
                foreach ($attribute_values as $index => $value) {
                    $term_order[$attribute_name][$value] = $index + 1; // Assign an index to each custom attribute value
                }
            }
        }

        /** @var array $args */
        $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), [
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __('Choose an option', 'variation-monster'),
        ]);

        /** @var WC_Product_Variable $product */
        $options          = $args['options'];
        $product          = $args['product'];
        $attribute        = $args['attribute'];
        $name             = $args['name'] ?: 'attribute_'.sanitize_title($attribute);
        $id               = $args['id'] ?: sanitize_title($attribute);
        $class            = $args['class'];
        $show_option_none = (bool)$args['show_option_none'];



        // Inside vb_custom_variation_buttons method
        if (!empty($attribute)) {
            if ($product && taxonomy_exists($attribute)) {
                $attribute_id = null;
                $attribute_slug = null;
                // Debugging attribute data
                if ($product instanceof WC_Product_Variable) {
                    $attributes = $product->get_attributes();

                    if (isset($attributes[$attribute])) {
                        $attribute_data = $attributes[$attribute];

                        if ($attribute_data->is_taxonomy()) {
                            $attribute_id = $attribute_data->get_id();
                            $attribute_slug = sanitize_title($attribute_data->get_name());
                        }
                    }
                }

                $meta_display_type = get_post_meta($post->ID, 'variation_meta_attribute_display_type_' . $attribute_slug, true);

                if (empty($meta_display_type)){
                    $display_type          = get_option( 'wc_attribute_display_type_' . $attribute_id );
                }else{
                    $display_type = $meta_display_type;
                }

                $show_option_none_text = $args['show_option_none'] ?: __('Choose an option', 'variation-monster');

                // Get selected value.

//                if ($attribute && $product instanceof WC_Product && $args['selected'] === false) {
//                    $selected_key     = 'attribute_'.sanitize_title($attribute);
//                    $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key]))
//                        : $product->get_variation_default_attribute($attribute);
//                }

                if (empty($options) && ! empty($product) && ! empty($attribute)) {
                    $attributes = $product->get_variation_attributes();
                    $options    = $attributes[$attribute];
                }
                if ($display_type === 'radio') {
                    $radios = '<div class="custom-wc-variations">';

                    if ( ! empty($options)) {
                        if ($product && taxonomy_exists($attribute)) {
                            $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                            $variations_by_term = get_available_variations_by_term($product, $attribute);

                            foreach ($terms as $term) {
                                $available_variations = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');

                                if (in_array($term->slug, $options, true)) {

                                    $radios .= '<input type="radio" name="custom_'.esc_attr($name).'" 
                                    data-available-variations="' . esc_attr($variations_json) . '" 
                                    data-value="'.esc_attr($term->slug).'" id="'
                                        .esc_attr($name).'_'.esc_attr($term->slug).'" data-variation-name="'.esc_attr($name).'" '
                                        .checked(sanitize_title($args['selected']), $term->slug, false).'>';
                                    $radios .= '<label for="'.esc_attr($name).'_'.esc_attr($term->slug).'">';
                                    $radios .= esc_html(apply_filters('woocommerce_variation_option_name', $term->name));
                                    $radios .= '</label>';

                                }
                            }
                        } else {
                            foreach ($options as $option) {
                                $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'],
                                    sanitize_title($option), false) : checked($args['selected'], $option, false);
                                $radios  .= '<input type="radio" name="custom_'.esc_attr($name).'"
                                data-value="'.esc_attr($option).'" id="'
                                    .esc_attr($name).'_'.esc_attr($option).'" data-variation-name="'.esc_attr($name).'" '.$checked.'>';
                                $radios  .= '<label for="'.esc_attr($name).'_'.esc_attr($option).'">';
                                $radios  .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                $radios  .= '</label>';
                            }
                        }
                    }

                    $radios .= '</div>';

                    return $html.$radios;
                }elseif ($display_type === 'button' || $display_type === "select" || empty($display_type)) {

                    $buttons = '<div class="custom-wc-buttons">';

                    if (!empty($options)) {
                        if ($product && taxonomy_exists($attribute)) {
                            $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                            $variations_by_term = get_available_variations_by_term($product, $attribute);

                            foreach ($terms as $term) {
                                if (in_array($term->slug, $options, true)) {
                                    $selected             = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                    $term_id              = $term->term_id;
                                    $check_meta_tooltip   = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    $available_variations = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                    $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');

                                    if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                        $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        if ($globallyTooltipOnOff === 'true'){
                                            $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                        } else {
                                            $tooltip = '';
                                        }
                                    }
                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        $tooltip = $term->name;
                                    }

                                    $buttons .= '<button type="button" class="custom-button ' . esc_attr($selected) . '" 
                                                data-value="' . esc_attr($term->slug) . '" 
                                                data-variation-name="' . esc_attr($name) . '" 
                                                data-tooltip="' . esc_attr($tooltip) . '" 
                                                data-label-name="' . esc_attr($term->name) . '" 
                                                data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                data-available-variations="' . esc_attr($variations_json) . '" 
                                                data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                                style=" background-color: ' . esc_attr($selectVariationButtonBgColor) . '; 
                                                color: ' . esc_attr($selectVariationButtonTextColor) . ';">';
                                    $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $term->name));
                                    $buttons .= '</button>';
                                }
                            }
                        } else {
                            foreach ($options as $option) {
                                $selected = sanitize_title($args['selected']) === $option ? 'selected' : '';
                                $buttons .= '<button type="button" class="custom-button ' . esc_attr($selected) . '" 
                                data-value="' . esc_attr($option) . '" 
                                data-variation-name="' . esc_attr($name) . '">';
                                $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                                $buttons .= '</button>';
                            }
                        }
                    }

                    $buttons .= '</div>';

                    return $html . $buttons;
                }elseif ($display_type === 'image') {
                    $images = '<div class="custom-wc-images">';

                    if (!empty($options)) {
                        if ($product && taxonomy_exists($attribute)) {
                            $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                            $variations_by_term = get_available_variations_by_term($product, $attribute);

                            foreach ($terms as $term) {
                                if (in_array($term->slug, $options, true)) {
                                    $selected             = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                    $term_id              = $term->term_id;
                                    $check_meta_tooltip   = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    $check_meta_image     = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id, true);
                                    $available_variations = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                    $variations_json      = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');

                                    if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                        $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        if ($globallyTooltipOnOff === 'true'){
                                            $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                        }else {
                                            $tooltip = '';
                                        }
                                    }

                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        $tooltip = $term->name;
                                    }

                                    if (!empty($check_meta_image)) {
                                        $image = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        $image   = get_term_meta($term_id, 'term_image', true);
                                    }

                                    $image_url = $image ? (is_numeric($image) ? wp_get_attachment_url($image) : esc_url($image)) : '';

                                    $images .= '<button type="button" class="custom-image-button ' . esc_attr($selected) . '" 
                                                data-value="' . esc_attr($term->slug) . '" 
                                                data-variation-name="' . esc_attr($name) . '"
                                                data-label-name="' . esc_attr($term->name) . '"  
                                                data-tooltip="' . esc_attr($tooltip) . '" 
                                                data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                data-available-variations="' . esc_attr($variations_json) . '" 
                                                data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                                style=" height: ' . esc_attr($imageColorHeight) . 'px; 
                                                width: ' . esc_attr($imageColorWidth) . 'px; 
                                                border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;">';

                                    if ($image_url) {
                                        $image_id = attachment_url_to_postid($image_url);
                                        if ($image_id) {
                                            $images .= wp_get_attachment_image($image_id, 'full', false, [
                                                'alt'   => esc_attr($term->name),
                                                'style' => 'height: ' . esc_attr($imageColorHeight) . 'px; 
                                                            width: ' . esc_attr($imageColorWidth) . 'px; 
                                                            border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;',
                                            ]);
                                        }

                                    } else {
                                        $images .= '<span class="term-name">' . esc_html($term->name) . '</span>';
                                    }

                                    $images .= '</button>';
                                }
                            }
                        }
                    }

                    $images .= '</div>';

                    return $html . $images;
                }elseif ($display_type === "color") {
                    $colors = '<div class="custom-wc-colors">';

                    if (!empty($options)) {
                        if ($product && taxonomy_exists($attribute)) {
                            $terms              = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);
                            $variations_by_term = get_available_variations_by_term($product, $attribute);

                            foreach ($terms as $term) {
                                if (in_array($term->slug, $options, true)) {

                                    $selected                   = sanitize_title($args['selected']) === $term->slug ? 'selected' : '';
                                    $term_id                    = $term->term_id;
                                    $check_meta_tooltip         = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    $check_meta_color           = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id, true);
                                    $check_meta_secondary_color = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id, true);
                                    $available_variations       = isset($variations_by_term[$term->slug]) ? $variations_by_term[$term->slug] : [];
                                    $variations_json            = htmlspecialchars(wp_json_encode($available_variations), ENT_QUOTES, 'UTF-8');

                                    if (!empty($check_meta_tooltip) && $globallyTooltipOnOff === 'true') {
                                        $tooltip = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        if ($globallyTooltipOnOff === 'true'){
                                            $tooltip = get_term_meta($term_id, 'term_tooltip', true);
                                        }else {
                                            $tooltip = '';
                                        }
                                    }

                                    if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                        $tooltip = $term->name;
                                    }

                                    if (!empty($check_meta_color)) {
                                        $color = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        $color   = get_term_meta($term_id, 'term_color', true);
                                    }

                                    if (!empty($check_meta_secondary_color)) {
                                        $secondary_color = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id, true);
                                    }else{
                                        $secondary_color   = get_term_meta($term_id, 'term_secondary_color', true);
                                    }

                                    if (!empty($color)) {

                                        if ($secondary_color){
                                            $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '"
                                                   data-label-name="' . esc_attr($term->name) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-available-variations="' . esc_attr($variations_json) . '" 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style="background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondary_color) . ' 50%); 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                                   display: flex; 
                                                   justify-content: center; 
                                                   align-items: center;">';

                                            $colors .= '<span class="color-label">' . esc_html($term->name) . '</span>';
                                        }else{
                                            $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '"
                                                   data-label-name="' . esc_attr($term->name) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-available-variations="' . esc_attr($variations_json) . '" 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style=" background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                                   display: flex; 
                                                   justify-content: center; 
                                                   align-items: center;">';

                                            $colors .= '<span class="color-label">' . esc_html($term->name) . '</span>';
                                        }
                                    } else {

                                        $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($term->slug) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '" 
                                                   data-label-name="' . esc_attr($term->name) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\' 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style=" background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;  
                                                   justify-content: center; align-items: center;">';

                                        $colors .= '<span class="term-name">' . esc_html($term->name) . '</span>';
                                    }
                                    $colors .= '</button>';

                                    $colors .= '</button>';
                                }
                            }
                        }
                    }

                    $colors .= '</div>';

                    return $html . $colors;
                }
            } else {
                $attribute_id = wc_attribute_taxonomy_id_by_name($attribute);
                $attribute_slug = null;
                if ($attribute_id) {
                    $attribute_obj = wc_get_attribute($attribute_id);
                    if ($attribute_obj) {
                        $attribute_slug = sanitize_title($attribute_obj->name);
                    }
                } else {
                    $attribute_slug = sanitize_title($attribute);
                }
                $display_type = get_post_meta($post->ID, 'variation_meta_attribute_display_type_' . $attribute_slug, true);
                $tooltip = '';

                if ($display_type === "button" || $display_type === "select" || empty($display_type)) {
                    $buttons = '<div class="custom-wc-buttons">';

                    if (!empty($options)) {
                        foreach ($options as $option) {

                            // Sanitize and match the selected value
                            $option_value = is_object($option) ? sanitize_title($option->name) : sanitize_title($option);
                            $selected = $option_value === sanitize_title($args['selected']) ? 'selected' : '';

                            $custom_value_slug = sanitize_title($option);
                            if ($globallyTooltipOnOff === 'true'){
                                $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                            }

                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                if (is_object($option)) {
                                    $tooltip = $option->name;
                                } else {
                                    $tooltip = $option;
                                }

                            }

                            $buttons .= '<button type="button" class="custom-button ' . esc_attr($selected) . '" 
                                        data-value="' . esc_attr($option) . '" 
                                        data-variation-name="' . esc_attr($name) . '"
                                        data-tooltip="' . esc_attr($tooltip) . '" 
                                        data-label-name="' . esc_attr($option) . '" 
                                        data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                        data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                        data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                        style=" background-color: ' . esc_attr($selectVariationButtonBgColor) . '; 
                                        color: ' . esc_attr($selectVariationButtonTextColor) . ';">';
                            $buttons .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                            $buttons .= '</button>';
                        }
                    }

                    $buttons .= '</div>';

                    return $html . $buttons;
                }elseif ($display_type === 'radio') {
                    $radios = '<div class="custom-wc-variations">';

                    if ( ! empty($options)) {
                        foreach ($options as $option) {
                            $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'],
                                sanitize_title($option), false) : checked($args['selected'], $option, false);
                            $radios  .= '<input type="radio" name="custom_'.esc_attr($name).'" data-value="'.esc_attr($option).'" id="'
                                .esc_attr($name).'_'.esc_attr($option).'" data-variation-name="'.esc_attr($name).'" '.$checked.'>';
                            $radios  .= '<label for="'.esc_attr($name).'_'.esc_attr($option).'">';
                            $radios  .= esc_html(apply_filters('woocommerce_variation_option_name', $option));
                            $radios  .= '</label>';
                        }
                    }

                    $radios .= '</div>';

                    return $html.$radios;
                }elseif ($display_type === 'image') {
                    $images = '<div class="custom-wc-images">';

                    if (!empty($options)) {
                        foreach ($options as $option) {

                            $custom_value_slug = sanitize_title($option);
                            // Sanitize and match the selected value
                            $option_value = is_object($option) ? sanitize_title($option->name) : sanitize_title($option);
                            $selected = $option_value === sanitize_title($args['selected']) ? 'selected' : '';

                            $image             = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $custom_value_slug . '_' . $attribute_id, true);
                            $image_url         = $image ? (is_numeric($image) ? wp_get_attachment_url($image) : esc_url($image)) : '';

                            if ($globallyTooltipOnOff === 'true'){
                                $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                            }

                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                if (is_object($option)) {
                                    $tooltip = $option->name;
                                } else {
                                    $tooltip = $option;
                                }
                            }

                            $images .= '<button type="button" class="custom-image-button ' . esc_attr($selected) . '" 
                                        data-value="' . esc_attr($option) . '" 
                                        data-variation-name="' . esc_attr($name) . '" 
                                        data-tooltip="' . esc_attr($tooltip) . '" 
                                        data-label-name="' . esc_attr($option) . '" 
                                        data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                        data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                        data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '"
                                        style=" height: ' . esc_attr($imageColorHeight) . 'px; 
                                        width: ' . esc_attr($imageColorWidth) . 'px; 
                                        border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;">';

                            if ($image_url) {

                                $image_id = attachment_url_to_postid($image_url);
                                if ($image_id) {
                                    $images .= wp_get_attachment_image($image_id, 'full', false, [
                                        'alt'   => esc_attr($option),
                                        'style' => 'height: ' . esc_attr($imageColorHeight) . 'px; 
                                                 width: ' . esc_attr($imageColorWidth) . 'px; 
                                                 border-radius: ' . esc_attr($imageColorBorderRadius) . 'px;',
                                    ]);
                                }

                            } else {

                                $images .= '<span class="term-name">' . esc_html($option) . '</span>';
                            }

                            $images .= '</button>';
                        }
                    }

                    $images .= '</div>';

                    return $html . $images;
                }elseif ($display_type === "color") {
                    $colors = '<div class="custom-wc-colors">';

                    if (!empty($options)) {
                        foreach ($options as $option) {

                            $custom_value_slug = sanitize_title($option);
                            // Sanitize and match the selected value
                            $option_value = is_object($option) ? sanitize_title($option->name) : sanitize_title($option);
                            $selected = $option_value === sanitize_title($args['selected']) ? 'selected' : '';

                            $color             = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $custom_value_slug . '_' . $attribute_id, true);
                            $secondary_color   = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $custom_value_slug . '_' . $attribute_id, true);

                            if ($globallyTooltipOnOff === 'true'){
                                $tooltip           = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true);
                            }

                            if (empty($tooltip) && $globallyTooltipOnOff === 'true'){
                                if (is_object($option)) {
                                    $tooltip = $option->name;
                                } else {
                                    $tooltip = $option;
                                }
                            }

                            if (!empty($color)) {

                                if ($secondary_color){

                                   $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                               data-value="' . esc_attr($option) . '" 
                                               data-variation-name="' . esc_attr($name) . '" 
                                               data-tooltip="' . esc_attr($tooltip) . '" 
                                               data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                               data-label-name="' . esc_attr($option) . '" 
                                               data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                               data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                               style="background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondary_color) . ' 50%); 
                                               height: ' . esc_attr($imageColorHeight) . 'px; 
                                               width: ' . esc_attr($imageColorWidth) . 'px; 
                                               border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                               display: flex; 
                                               justify-content: center; 
                                               align-items: center;">';
                                }else{

                                    $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                                   data-value="' . esc_attr($option) . '" 
                                                   data-variation-name="' . esc_attr($name) . '" 
                                                   data-tooltip="' . esc_attr($tooltip) . '" 
                                                   data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                                   data-label-name="' . esc_attr($option) . '" 
                                                   data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                                   data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                                   style="background-color: ' . esc_attr($color) . '; 
                                                   height: ' . esc_attr($imageColorHeight) . 'px; 
                                                   width: ' . esc_attr($imageColorWidth) . 'px; 
                                                   border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                                   display: flex; 
                                                   justify-content: center; 
                                                   align-items: center;">';

                                }

                                $colors .= '<span class="color-label">' . esc_html($option) . '</span>';
                            } else {

                                $colors .= '<button type="button" class="custom-color-button ' . esc_attr($selected) . '" 
                                               data-value="' . esc_attr($option) . '" 
                                               data-variation-name="' . esc_attr($name) . '" 
                                               data-tooltip="' . esc_attr($tooltip) . '" 
                                               data-term-order=\'' . esc_attr(wp_json_encode($term_order)) . '\'
                                               data-label-name="' . esc_attr($option) . '" 
                                               data-tooltip-bg-color="' . esc_attr($selectVariationTooltipBgColor) . '" 
                                               data-tooltip-text-color="' . esc_attr($selectVariationTooltipTextColor) . '" 
                                               style="background-color: ' . esc_attr($color) . '; 
                                               height: ' . esc_attr($imageColorHeight) . 'px; 
                                               width: ' . esc_attr($imageColorWidth) . 'px; 
                                               border-radius: ' . esc_attr($imageColorBorderRadius) . 'px; 
                                               display: flex; 
                                               justify-content: center; 
                                               align-items: center;">';

                                $colors .= '<span class="term-name">' . esc_html($option) . '</span>';
                            }
                            $colors .= '</button>';

                            $colors .= '</button>';
                        }
                    }

                    $colors .= '</div>';

                    return $html . $colors;
                }
            }
        }
    }

    /**
     * Replace dropdowns with buttons for product variations Template 1.
     *
     * @param string $html The default dropdown HTML.
     * @param array  $args The arguments for the dropdown.
     * @return string Modified HTML with buttons.
     * @since 1.0.3
     */
    public function variation_table_variation_select_template_1($html, $args){
        global $product;

        $variableSetting            = get_option('variable_all_checked', array());
        $listLabelOnOff             = isset($variableSetting['listLabelOnOff']) ? $variableSetting['listLabelOnOff'] : '';
        $listSkuOnOff               = isset($variableSetting['listSkuOnOff']) ? $variableSetting['listSkuOnOff'] : '';
        $listPriceOnOff             = isset($variableSetting['listPriceOnOff']) ? $variableSetting['listPriceOnOff'] : '';
        $listQuantityOnOff          = isset($variableSetting['listQuantityOnOff']) ? $variableSetting['listQuantityOnOff'] : '';
        $listBadgeShowOnOff         = isset($variableSetting['listBadgeShowOnOff']) ? $variableSetting['listBadgeShowOnOff'] : '';
        $listBadgeDiscountFlatPrice = isset($variableSetting['listBadgeDiscountFlatPrice']) ? $variableSetting['listBadgeDiscountFlatPrice'] : '';
        $listAttributeShow          = isset($variableSetting['listAttributeShow']) ? $variableSetting['listAttributeShow'] : '';
        $listTitleShow              = isset($variableSetting['listTitleShow']) ? $variableSetting['listTitleShow'] : '';
        $listForPercent             = isset($variableSetting['listForPercent']) ? $variableSetting['listForPercent'] : '% OFF';
        $listForFlat                = isset($variableSetting['listForFlat']) ? $variableSetting['listForFlat'] : 'OFF';
        $listImageShow              = isset($variableSetting['listImageShow']) ? $variableSetting['listImageShow'] : 'thumbnail';
        $listPagination             = isset($variableSetting['listPagination']) ? $variableSetting['listPagination'] : '3';

        if (!$product || !$product->is_type('variable')) {
            return $html;
        }

        $variations      = $product->get_available_variations();
        $variation_count = count($variations);
        $attributes      = $product->get_variation_attributes();

        ob_start();
        ?>
    <div class="variation-list-template-one">
        <ul id="quick-variable-list" class="variation-list" data-pagination-table="<?php echo esc_attr($listPagination); ?>" data-Variation-count="<?php echo esc_attr($variation_count); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">

            <div id="loading-spinner-pagination-list" style="display: none; text-align: center;">
                <i class="fa fa-spinner fa-spin "></i>
            </div>

            <?php

            $current_variation = array_slice($variations, 0, $listPagination);

            foreach ($current_variation as $variation) :
                $variation_obj       = wc_get_product($variation['variation_id']);
                $thumbnail_id        = $variation_obj->get_image_id();
                $regular_price       = floatval($variation_obj->get_regular_price());
                $sale_price          = floatval($variation_obj->get_sale_price());
                $discount_percentage = 0;
                $discount_flat       = 0;

                if ($sale_price && $regular_price && $regular_price > $sale_price) {
                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                    $discount_flat = ($regular_price - $sale_price) ;
                }
                ?>

                <li class="variation-item variation-list-template-one" data-variation-id="<?php echo esc_attr($variation['variation_id']); ?>"
                    data-attributes="<?php echo esc_attr(json_encode($variation['attributes'])); ?>"
                    data-variations="<?php echo esc_attr(json_encode($variations)); ?>">

                    <?php if($listBadgeShowOnOff === "true"){
                        ?>
                        <div class="badge-container">

                            <?php if ($discount_percentage > 0) : ?>
                                <?php if ($listBadgeDiscountFlatPrice === "true"){
                                    ?>
                                    <span class="sale-badge"><?php echo  wp_kses_post(wc_price($discount_flat)) . esc_attr($listForFlat) ; ?> </span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="sale-badge"><?php echo esc_html($discount_percentage) . esc_attr($listForPercent); ?></span>
                                    <?php
                                }?>
                            <?php endif; ?>
                        </div>
                        <?php
                    }?>

                    <label style="display: flex; align-items: center; justify-content: center">
                        <input type="radio" name="custom_variation"
                               value="<?php echo esc_attr($variation['variation_id']); ?>"
                               class="variation-select-radio">

                        <!-- Display Variation Image -->
                        <span class="variation-image" style="margin-left: 10px">
                                <?php
                                if ($thumbnail_id) {
                                    echo wp_get_attachment_image(
                                        $thumbnail_id, $listImageShow, false,
                                        array(
                                            'alt' => esc_attr($variation_obj->get_name()),
                                            'class' => 'gallery-trigger',
                                            'style' => 'cursor: pointer; margin-right: 15px;',
                                        )
                                    );
                                } else {
                                    echo wp_get_attachment_image(
                                        $product->get_image_id(), $listImageShow, false,
                                        array(
                                            'alt' => esc_attr($product->get_name()),
                                            'class' => 'gallery-trigger',
                                            'style' => 'cursor: pointer; margin-right: 15px;',
                                        )
                                    );
                                }
                                ?>
                        </span>

                        <span class="variation-details" style="display: flex; justify-content: center;">
                            <!-- SKU Label -->
                            <span class="variation-price" style="display: flex; flex-direction: column">
                                <strong><?php if ($listLabelOnOff === "true" && $listSkuOnOff === "true"){
                                        esc_html_e('SKU', 'variation-monster');
                                    } ?></strong>
                                <span><?php if ($listSkuOnOff === "true"){ echo wp_kses_post($variation_obj->get_sku()); } ?></span>
                            </span>

                            <!-- Display Attribute and Dropdown -->
                            <?php foreach ($attributes as $attribute_name => $options) :
                                $value = isset($variation['attributes']['attribute_' . $attribute_name]) ? $variation['attributes']['attribute_' . $attribute_name] : '';

                                if (taxonomy_exists($attribute_name)) {
                                    $term = get_term_by('slug', $value, $attribute_name);
                                    if ($term) {
                                        $value = $term->name;
                                    }
                                } else {
                                    $custom_key = 'attribute_' . strtolower($attribute_name);
                                    if (isset($variation['attributes'][$custom_key])) {
                                        $value = $variation['attributes'][$custom_key];
                                    }

                                    // Populate $options for custom attributes

                                    $product_attributes = get_post_meta($product->get_id(), '_product_attributes', true);
                                    if (isset($product_attributes[$attribute_name])) {
                                        $options = explode('|', $product_attributes[$attribute_name]['value']);
                                        $options = array_map('trim', $options);

                                    }
                                }

                                ?>

                                <?php if ($listAttributeShow === "true"){
                                ?>
                                <span class="variation-attribute" style="display: flex; flex-direction: column">
                                    <strong><?php  if ($listLabelOnOff === "true"){
                                            echo wp_kses_post(wc_attribute_label($attribute_name));
                                        } ?> </strong>
                                    <?php if ($value) : ?>
                                        <?php echo esc_html($value); ?>
                                    <?php else : ?>
                                        <span class="attribute-select-wrapper-custom" style="display: contents">
                                            <select name="attribute_<?php echo esc_attr($attribute_name); ?>" class="attribute-select">
                                                <option value="">
                                                    <?php esc_html_e('Choose', 'variation-monster'); ?> <?php echo wp_kses_post(wc_attribute_label($attribute_name)); ?>
                                                </option>
                                                <?php foreach ($options as $option) :
                                                    ?>
                                                    <option data-variation-id="<?php echo esc_attr($variation['variation_id']); ?>" value="<?php echo esc_attr($option); ?>">
                                                        <?php echo esc_html($option); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </span>
                                    <?php endif; ?>
                                </span>
                            <?php } endforeach; ?>

                            <!-- Title Label -->
                            <span class="variation-price" style="display: flex; flex-direction: column">
                                <strong><?php if ($listLabelOnOff === "true" && $listTitleShow === "true"){
                                        esc_html_e('Title', 'variation-monster');
                                    } ?></strong>
                                <span><?php if ($listTitleShow === "true"){ echo wp_kses_post($variation_obj->get_name()); } ?></span>
                            </span>

                            <!-- Price Label -->
                            <span class="variation-price" style="display: flex; flex-direction: column">
                                <strong><?php if ($listLabelOnOff === "true" && $listPriceOnOff === "true"){
                                        esc_html_e('Price', 'variation-monster');
                                    } ?></strong>
                                <span><?php if ($listPriceOnOff === "true"){ echo wp_kses_post($variation_obj->get_price_html()); } ?></span>
                            </span>

                            <!-- Quantity Label -->
                            <?php if ($variation_obj->get_stock_quantity()  ) {
                                ?>
                                <span class="variation-price" style="display: flex; flex-direction: column">
                                    <strong><?php if ($listLabelOnOff === "true" && $listQuantityOnOff === "true"){
                                            esc_html_e('Quantity', 'variation-monster');
                                        } ?></strong>
                                    <span><?php if ($listQuantityOnOff === "true"){ echo wp_kses_post($variation_obj->get_stock_quantity()); } ?></span>
                                </span>
                            <?php }?>
                        </span>
                    </label>
                </li>
            <?php
            endforeach; ?>
        </ul>

        <!-- Pagination Buttons -->
        <div class="pagination-controls-list">
            <button id="prev-page" style="margin-right: 5px" disabled><i class='fas fa-angle-left'></i></button>
            <button id="next-page"><i class='fas fa-angle-right'></i></button>
        </div>
    </div>

        <script>

            jQuery(document).ready(function($) {
                // Remove the variations table
                $('table.variations').remove();
            });


            jQuery(document).ready(function ($) {
                var $listTemplate1 = $("#quick-variable-list");
                const rowsPerPage  = $listTemplate1.data('pagination-table') || 5;
                const totalRows    = $listTemplate1.data('variation-count');
                var currentPage    = 1;
                var totalPages     = 1;
                var productId      = $listTemplate1.data('product-id');

                if (totalRows <= rowsPerPage) {
                    $(".pagination-controls-list").hide();
                }

                function loadPage(page) {
                    $.ajax({
                        url: quick_front_ajax_obj.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'load_more_variations_list_template_one',
                            product_id: productId,
                            page: page,
                            pagination_nonce: quick_front_ajax_obj.nonce,
                        },
                        success: function (response) {
                            if (response.success) {
                                $("#loading-spinner-pagination-list").hide();
                                $("#quick-variable-list").css("opacity", "1");
                                $listTemplate1.find('li.variation-item').remove();
                                $listTemplate1.append(response.data.html);
                                totalPages = response.data.total_pages;
                                currentPage = response.data.current_page;
                                updatePaginationControls();
                                initializeVariationListeners();
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
                    $("#prev-page").prop("disabled", currentPage === 1);
                    $("#next-page").prop("disabled", currentPage === totalPages);
                }

                $("#prev-page").off("click").on("click", function(event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();

                    $("#loading-spinner-pagination-list").show();
                    $("#quick-variable-list").css("opacity", "0.5");

                    if (currentPage > 1) {
                        currentPage--;
                        loadPage(currentPage);

                        // Reset variation_id when clicking "Next"
                        jQuery("input[name=variation_id]").val('0').trigger('change');
                        jQuery('form.cart').trigger('check_variations');
                    }
                });

                $("#next-page").off("click").on("click", function(event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();

                    $("#loading-spinner-pagination-list").show();
                    $("#quick-variable-list").css("opacity", "0.5");

                    if (currentPage) {
                        currentPage++;
                        loadPage(currentPage);

                        // Reset variation_id when clicking "Next"
                        jQuery("input[name=variation_id]").val('0').trigger('change');
                        jQuery('form.cart').trigger('check_variations');
                    }
                });


                if ($listTemplate1.length > 0) {
                    // loadPage(currentPage);
                }
            });

            function initializeVariationListeners(){
                const radioButtons       = document.querySelectorAll('.variation-select-radio');
                const dropdowns          = document.querySelectorAll('.attribute-select');
                const addToCartForm      = document.querySelector('form.cart');
                const addToCartButton    = document.querySelector('button.single_add_to_cart_button');

                // Initially disable the add to cart button
                addToCartButton.setAttribute('disabled', 'disabled');
                addToCartButton.classList.add('disabled')

                let lastSelectedVariationId = null;  // Track selected variation

                // Radio button logic
                radioButtons.forEach(function (radio) {
                    radio.addEventListener('change', function () {

                        const selectedVariationId = this.value;
                        lastSelectedVariationId = selectedVariationId;
                        const item = this.closest('.variation-item');
                        const attributes = JSON.parse(item.dataset.attributes);
                        updateVariationId(selectedVariationId, addToCartForm);
                        updateHiddenFields(attributes, addToCartForm);

                        disableDropdowns(attributes);  // Disable conflicting dropdowns
                        //jQuery('form.cart').trigger('check_variations');  // Force variation check
                    });
                });

                // Dropdown change logic

                dropdowns.forEach(function (dropdown) {
                    dropdown.addEventListener('change', function () {
                        const selectedAttributes = {};

                        // Collect selected attributes from all dropdowns
                        addToCartForm.querySelectorAll('.attribute-select').forEach(function (select) {
                            if (select.value) {
                                selectedAttributes[select.name] = select.value;
                            }
                        });

                        // Update hidden fields with selected attributes
                        updateHiddenFields(selectedAttributes, addToCartForm);

                        // Attempt to find a matching variation ID
                        const parentItem = dropdown.closest('.variation-item');
                        if (parentItem) {
                            const foundVariationId = parentItem.dataset.variationId;

                            // Update WooCommerce's existing variation_id input
                            const variationInput = addToCartForm.querySelector('input.variation_id');
                            if (variationInput) {
                                variationInput.value = foundVariationId;
                            }
                        }
                    });
                });



                // Disable conflicting dropdowns when a radio button is selected
                function disableDropdowns(attributes) {
                    dropdowns.forEach(function (dropdown) {
                        const attributeName = dropdown.name;
                        if (attributes[attributeName]) {
                            dropdown.disabled = true;
                        } else {
                            dropdown.disabled = false;
                        }
                    });
                }

                // Clear hidden inputs related to specific attribute (prevent duplicate)
                function clearHiddenFieldsForAttribute(attributeName) {
                    addToCartForm.querySelectorAll(`input[name="${attributeName}"]`).forEach(input => input.remove());
                }

                // Update hidden inputs dynamically
                function updateHiddenFields(attributes, form) {
                    for (const key in attributes) {
                        if (attributes[key]) {
                            clearHiddenFieldsForAttribute(key);  // Clear before adding
                            const newInput = document.createElement('input');
                            newInput.type = 'hidden';
                            newInput.name = key;
                            newInput.value = attributes[key];
                            form.appendChild(newInput);
                        }
                    }
                }

                // Update variation_id hidden input
                function updateVariationId(variationId, form) {
                    let variationInput = form.querySelector('input[name="variation_id"]');
                    if (variationInput) {
                        variationInput.value = variationId;
                        jQuery(variationInput).trigger('change');
                    } else {
                        const newInput = document.createElement('input');
                        newInput.type = 'hidden';
                        newInput.name = 'variation_id';
                        newInput.value = variationId;
                        form.appendChild(newInput);
                    }
                    jQuery('form.cart').trigger('check_variations');
                }


                // WooCommerce event to check variation and enable Add to Cart
                jQuery('form.cart').on('check_variations', function () {
                    setTimeout(function () {
                        if (addToCartForm.querySelector('.variation_id') && addToCartForm.querySelector('.variation_id').value && (addToCartForm.querySelector('.variation_id').value !== '0')) {
                            addToCartButton.removeAttribute('disabled');
                            addToCartButton.classList.remove('disabled');
                        } else {
                            addToCartButton.setAttribute('disabled', 'disabled');
                            addToCartButton.classList.add('disabled');
                        }
                    }, 200);
                });
            }

            document.addEventListener('DOMContentLoaded', initializeVariationListeners);

        </script>


        <style>

            .pagination-controls-list{
                display: flex;
                justify-content: end;
            }
            .variation-image img {
                max-width: 60px;
                height: auto;
                display: inline-block;
            }
            .variation-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .variation-item {
                border: 1px solid #ddd;
                padding: 15px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
            }
            .variation-details {
                display: flex;
                justify-content: space-between;
                flex-grow: 1;
                margin-left: 15px;
            }
            .variation-attribute,
            .variation-price {
                margin-right: 20px;
            }
            .variation-select-radio {
                cursor: pointer;
            }
            .attribute-select-wrapper-custom {
                display: inline-block;
                margin-left: 10px;
                vertical-align: middle;
            }

            .variation-item {
                position: relative;
                border: 1px solid #ddd;
                padding: 15px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
            }
            .badge-container {
                position: absolute;
                top: 5px;
                z-index: 10;
            }
            .sale-badge {
                padding: 5px 10px;
                font-size: 12px;
                font-weight: bold;
                border-radius: 3px;
            }

            /* Hide the variations table */
            table.variations {
                display: none !important;
            }

        </style>

        <?php
        $ul_html = ob_get_clean();
        return $ul_html;
    }

}

/**
 * Get all available variations for each term.
 *
 * @param WC_Product_Variable $product The product object.
 * @param string $attribute The attribute to filter variations by.
 * @return array
 */
function get_available_variations_by_term($product, $attribute) {
    $available_variations = [];

    if ($product && $product instanceof WC_Product_Variable) {
        $variations = $product->get_available_variations();
        $attribute_terms = wc_get_product_terms($product->get_id(), $attribute, ['fields' => 'all']);

        foreach ($attribute_terms as $term) {
            $term_variations = [];

            foreach ($variations as $variation) {
                $attributes = $variation['attributes'];

                // Match specific attribute or any_* attribute
                if (
                    isset($attributes['attribute_' . $attribute]) &&
                    ($attributes['attribute_' . $attribute] === $term->slug ||
                        strpos($attributes['attribute_' . $attribute], 'any') === 0)
                ) {
                    $term_variations[] = $variation;
                }
            }

            $available_variations[$term->slug] = $term_variations;
        }
    }

    return $available_variations;
}