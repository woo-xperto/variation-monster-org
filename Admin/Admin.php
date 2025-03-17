<?php
class Qucikadmin{

    /**
     * Define Constant.
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('plugins_loaded', [$this, 'attribute_section_setup_gallery_field']);
        add_action('wp_ajax_quick_variable_review_dismissed_ajax', array($this, 'quick_variable_review_dismissed_ajax'));
    }

    /**
     * Select admin menu.
     *
     * @return void
     * @since 1.0.0
     */
    public function addAdminMenu() {
        add_submenu_page(
            'edit.php?post_type=product',
            'Variation Monster',
            'Variation Monster',
            'manage_options',
            'variation-monster-setting',
            [$this, 'renderDashboard']
        );
    }


    /**
     * Dashboard setup.
     *
     * @return void
     * @since 1.0.0
     */
    public function renderDashboard() {
        require_once plugin_dir_path(__FILE__) . 'Dashboard.php';
    }

    /**
     * Variation gallery and attribute setup field all hook initialization.
     *
     * @return void
     * @since 1.0.3
     */
    public function attribute_section_setup_gallery_field() {
        $variableSetting         = get_option('variable_all_checked', array());
        $variationGalleryOnOff   = isset($variableSetting['variationGalleryOnOff']) ? $variableSetting['variationGalleryOnOff'] : '';

        add_action( 'woocommerce_after_edit_attribute_fields', array($this,'wc_custom_attribute_field'), 10 );
        add_action( 'woocommerce_after_add_attribute_fields', array($this, 'wc_custom_attribute_field') );
        add_action( 'woocommerce_attribute_added', array($this, 'wc_save_custom_attribute_field'), 10, 2 );
        add_action( 'woocommerce_attribute_updated', array($this, 'wc_save_custom_attribute_field'), 10, 3 );

        $attributes = wc_get_attribute_taxonomies();
        foreach ($attributes as $attribute) {
            $taxonomy = 'pa_' . $attribute->attribute_name;
            add_action("{$taxonomy}_add_form_fields", [$this, 'wc_custom_attribute_add_form_fields'], 10, 1);
            add_action("{$taxonomy}_edit_form_fields", [$this, 'wc_custom_attribute_edit_form_fields'], 10, 2);

            // Adding column filters and actions.
            add_filter("manage_edit-{$taxonomy}_columns", function ($columns) use ($taxonomy) {
                return $this->add_color_image_columns($columns, $taxonomy);
            }, 10, 1);

            add_action("manage_{$taxonomy}_custom_column", function ($content, $column_name, $term_id) use ($taxonomy) {
                return $this->populate_color_image_columns($content, $column_name, $term_id, $taxonomy);
            }, 10, 3);
        }

        add_action( 'created_term', array($this, 'wc_save_custom_created_term'), 10, 3 );
        add_action( 'edit_term', array($this, 'wc_save_custom_edit_term'), 10, 3);

        if ($variationGalleryOnOff === 'true'){
            add_action('woocommerce_variation_options', [$this, 'addGalleryField'], 10, 3);
            add_action('woocommerce_process_product_meta_variable', [$this, 'saveGalleryImages']);
        }

        // Product meta boxes.
        add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_data_tab' ) );
        add_action( 'woocommerce_product_data_panels', array( $this, 'add_data_panel' ) );
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_product_meta' ) );

        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    /**
     * Custom attribute field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_field( $attribute ) {

        if ( isset( $_GET['edit'] ) ){
            if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'edit_attribute_nonce' ) ) {
            }
        }

        $attribute_id       = isset( $attribute->attribute_id ) ? $attribute->attribute_id : ( isset( $_GET['edit'] ) ? intval( $_GET['edit'] ) : 0 );
        $display_type       = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $tooltip_permission = get_option( 'wc_attribute_tooltip_permission_' . $attribute_id );

        wp_nonce_field( 'save_attribute_display_type', 'attribute_display_type_nonce' );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="attribute_display_type"><?php esc_html_e( 'Display Type', 'variation-monster' ); ?></label>
            </th>
            <td>
                <select name="attribute_display_type" id="attribute_display_type">
                    <option value="select" <?php selected( $display_type, 'select' ); ?>><?php esc_html_e( 'Select', 'variation-monster' ); ?></option>
                    <option value="color" <?php selected( $display_type, 'color' ); ?>><?php esc_html_e( 'Color', 'variation-monster' ); ?></option>
                    <option value="image" <?php selected( $display_type, 'image' ); ?>><?php esc_html_e( 'Image', 'variation-monster' ); ?></option>
                    <option value="button" <?php selected( $display_type, 'button' ); ?>><?php esc_html_e( 'Button', 'variation-monster' ); ?></option>
                    <option value="radio" <?php selected( $display_type, 'radio' ); ?>><?php esc_html_e( 'Radio', 'variation-monster' ); ?></option>
                </select>
                <p class="description"><?php esc_html_e( 'Select how this attribute should be displayed on the product page.', 'variation-monster' ); ?></p>
            </td>
        </tr>

        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="attribute_tooltip_permission"><?php esc_html_e( 'Tooltip Show', 'variation-monster' ); ?></label>
            </th>
            <td>
                <input type="checkbox" id="attribute_tooltip_permission" name="attribute_tooltip_permission" value="yes"
                    <?php checked($tooltip_permission, 'yes'); ?>>
                <p class="description"><?php esc_html_e( 'If you want to show tooltip on above attribute then check it.', 'variation-monster' ); ?></p>
            </td>
        </tr>
        <?php
    }

    /**
     * Save custom attribute field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_attribute_field( $attribute_id, $attribute = null, $old_attribute = null ) {

        if ( ! isset( $_POST['attribute_display_type_nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['attribute_display_type_nonce'])), 'save_attribute_display_type' ) ) {
            return;
        }

        if ( isset( $_POST['attribute_display_type'] ) ) {
            $display_type = sanitize_text_field( wp_unslash( $_POST['attribute_display_type'] ) );
            update_option( 'wc_attribute_display_type_' . $attribute_id, $display_type );
        }

        if (isset($_POST['attribute_tooltip_permission'])) {
            $tooltip_permission = sanitize_text_field(wp_unslash($_POST['attribute_tooltip_permission']));
            update_option('wc_attribute_tooltip_permission_' . $attribute_id, $tooltip_permission);
        } else {
            // Explicitly save 'no' when the checkbox is unchecked
            update_option('wc_attribute_tooltip_permission_' . $attribute_id, 'no');
        }
    }

    /**
     * Attribute new term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_add_form_fields($taxonomy ) {

        wp_nonce_field('save_term_meta_nonce', '_wpnonce');

        $attributes   = wc_get_attribute_taxonomies();
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );

        if ($display_type === 'color') {
            ?>
            <div class="form-field product_attribute_color">
                <label for="term_color"><?php esc_html_e('Color', 'variation-monster'); ?></label>
                <input name="term_color" id="term_color" type="text" value="" class="wvs-color-picker" data-default-color="#ffffff">
                <p class="description"><?php esc_html_e('Select a color for this term.', 'variation-monster'); ?></p>
            </div>

            <div class="form-field product_attribute_color">
                <label for="term_secondary_color"><?php esc_html_e('Secondary Color', 'variation-monster'); ?></label>
                <input name="term_secondary_color" id="term_secondary_color" type="text" value="" class="wvs-color-picker" data-default-color="#ffffff">
                <p class="description"><?php esc_html_e('Select a secondary color for this term.', 'variation-monster'); ?></p>
            </div>
            <?php
        }elseif ($display_type === 'image') {
            ?>
            <div class="form-field">
                <label for="term_image_add_new"><?php esc_html_e('Image', 'variation-monster'); ?></label>
                <input type="hidden" name="term_image_add_new" id="term_image_add_new" value="">
                <div style="display: flex; gap: 20px; align-items: center" >
                    <button type="button" class="button" id="upload_image_button_add_new"><?php esc_html_e('Upload Image', 'variation-monster'); ?></button>
                    <div id="term_image_preview_add_new_render_from_js"></div>
                </div>
                <p class="description">Upload an image for this term.</p>
            </div>
            <?php
        }
        ?>
        <div class="form-field">
            <label for="add_term_tooltip">Tool Tip</label>
            <input type="text" name="add_term_tooltip" id="add_term_tooltip" value="<?php echo esc_attr($term_name ?? ''); ?>">
            <p class="description">Add your custom Tooltip or it will default to the term name.</p>
        </div>
        <?php
    }

    /**
     * Attribute edit term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_edit_form_fields($term, $taxonomy) {

        $attributes   = wc_get_attribute_taxonomies();
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $term_id      = $term->term_id;
        $color        = get_term_meta($term_id, 'term_color', true);
        $secondaryColor        = get_term_meta($term_id, 'term_secondary_color', true);
        $image        = get_term_meta($term_id, 'term_image', true);
        $tooltip      = get_term_meta($term_id, 'term_tooltip', true);

        if ($display_type === 'color') {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_color">Color</label></th>
                <td>
                    <input class="wvs-color-picker" data-default-color="#ffffff" type="text" name="term_color" id="term_color" value="<?php echo esc_attr($color); ?>">
                    <p class="description">Select a color for this term.</p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_secondary_color">Secondary Color</label></th>
                <td>
                    <input class="wvs-color-picker" data-default-color="#ffffff" type="text" name="term_secondary_color" id="term_secondary_color" value="<?php echo esc_attr($secondaryColor); ?>">
                    <p class="description">Select a secondary color for this term.</p>
                </td>
            </tr>
            <?php
        }elseif ($display_type === 'image') {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_image">Image</label></th>
                <td>
                    <!-- Display the selected image -->
                    <?php if (!empty($image)): ?>
                        <div id="term_image_preview_render_from_js" data-image-url="<?php echo esc_attr($image)?>"></div>
                    <?php else: ?>
                        <div id="term_image_preview_render_from_js"></div>
                    <?php endif; ?>

                    <!-- Input field to update image -->
                    <input type="hidden" name="term_image" id="term_image" value="<?php echo esc_attr($image); ?>">
                    <div>
                        <button type="button" class="button" id="upload_image_button">Upload Image</button>
                        <button type="button" style="background-color: firebrick; color: white; border: none" class="button " id="upload_image_button_remove">Remove Image</button>
                    </div>
                    <p class="description">Upload an image.</p>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="edit_term_tooltip">Tool Tip</label></th>
            <td>
                <input type="text" name="edit_term_tooltip" id="edit_term_tooltip" value="<?php echo esc_attr($tooltip); ?>">
                <p class="description">Add your custom Tooltip or it will be default term name.</p>
            </td>
        </tr>
        <?php
    }

    /**
     * Save attribute new term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_created_term($term_id, $tt_id, $taxonomy) {

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_key($_POST['_wpnonce']), 'save_term_meta_nonce')) {
            wp_die(esc_html__('Security check failed', 'variation-monster'));
        }

        if (isset($_POST['term_color'])) {
            update_term_meta($term_id, 'term_color', sanitize_text_field(wp_unslash($_POST['term_color'])));
        }

        if (isset($_POST['term_secondary_color'])) {
            update_term_meta($term_id, 'term_secondary_color', sanitize_text_field(wp_unslash($_POST['term_secondary_color'])));
        }

        if (isset($_POST['term_image_add_new'])) {
            update_term_meta($term_id, 'term_image', esc_url_raw(wp_unslash($_POST['term_image_add_new'])));
        }

        if (isset($_POST['add_term_tooltip']) && !empty($_POST['add_term_tooltip'])) {
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field(wp_unslash($_POST['add_term_tooltip'])));
        } else {
            $term = get_term($term_id);
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($term->name));
        }
    }

    /**
     * Save attribute edit term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_edit_term($term_id, $tt_id, $taxonomy) {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_key($_POST['_wpnonce']), 'edit_term_meta_nonce')) {
        }

        if (isset($_POST['term_color'])) {
            update_term_meta($term_id, 'term_color', sanitize_text_field(wp_unslash($_POST['term_color'])));
        }

        if (isset($_POST['term_secondary_color'])) {
            update_term_meta($term_id, 'term_secondary_color', sanitize_text_field(wp_unslash($_POST['term_secondary_color'])));
        }

        if (isset($_POST['term_image'])) {
            update_term_meta($term_id, 'term_image', esc_url_raw(wp_unslash($_POST['term_image'])));
        }

        if (isset($_POST['edit_term_tooltip']) && !empty($_POST['edit_term_tooltip'])) {
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field(wp_unslash($_POST['edit_term_tooltip'])));
        } else {
            // Default to term name if tooltip is not provided
            $term = get_term($term_id);
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($term->name));
        }
    }

    /**
     * Add color image column into attribute term table.
     *
     * @return array
     * @since 1.0.3
     */
    public function add_color_image_columns($columns, $taxonomy) {
        $attributes = wc_get_attribute_taxonomies();

        // Find the attribute ID for the current taxonomy
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $new_columns  = [];
        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;
            if ($key === 'slug') {
                if ($display_type === 'color') {
                    $new_columns['color'] = __('Color', 'variation-monster');
                }elseif ($display_type === 'image') {
                    $new_columns['image'] = __('Image', 'variation-monster');
                }
            }
        }
        return $new_columns;
    }

    /**
     * Show color image column into attribute term table.
     *
     * @return mixed | null | string
     * @since 1.0.3
     */
    public function populate_color_image_columns($content, $column_name, $term_id, $taxonomy) {

        $attributes   = wc_get_attribute_taxonomies();
        $attribute_id = null;

        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );

        if ($column_name === 'color' && $display_type === 'color') {
            $color = get_term_meta($term_id, 'term_color', true);
            $secondaryColor = get_term_meta($term_id, 'term_secondary_color', true);
            if ($color) {
                if ($secondaryColor) {
                    $content = '<span style="
                    display: inline-block; 
                    width: 20px; 
                    height: 20px; 
                    background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondaryColor) . ' 50%);
                    border: 1px solid #ccc; 
                    border-radius: 3px;
                "></span>';
                } else {
                    $content = '<span style="
                    display: inline-block; 
                    width: 20px; 
                    height: 20px; 
                    background-color: ' . esc_attr($color) . '; 
                    border: 1px solid #ccc; 
                    border-radius: 3px;
                "></span>';
                }
            } else {
                $content = __('—', 'variation-monster');
            }
        }
        if ($column_name === 'image' && $display_type === 'image') {
            $image    = get_term_meta($term_id, 'term_image', true);
            $image_id = attachment_url_to_postid($image);

            if ($image) {
                $content = wp_get_attachment_image($image_id, 'thumbnail', false, [
                    'alt'   => esc_attr__('Term Image', 'variation-monster'),
                    'style' => 'max-width: 50px; height: auto;',
                ]);            } else {
                $content = __('—', 'variation-monster');
            }
        }
        return $content;
    }

    /**
     * Gallery image upload for variations every product.
     *
     * @return void
     * @since 1.0.2
     */
    public function addGalleryField($loop, $variation_data, $variation) {
        $gallery_images = get_post_meta($variation->ID, '_variation_gallery_images', true);
        $image_ids      = $gallery_images ? explode(',', $gallery_images) : [];
        ?>
        <div class="form-row form-row-full" style="margin-top: 10px; margin-bottom: 10px; border: 1px solid lightgrey; padding: 5px; border-radius: 5px;">
            <label><?php esc_html_e('Gallery Images', 'variation-monster'); ?></label>
            <ul id="gallery-container-<?php echo esc_attr($variation->ID); ?>" class="variation-gallery-container" style="margin-top: 5px;">
                <?php foreach ($image_ids as $image_id): ?>
                    <li class="variation-gallery-item" data-image-id="<?php echo esc_attr($image_id); ?>">
                        <?php echo wp_get_attachment_image(
                            $image_id,
                            '',
                            false,
                            [
                                'alt'   => '',
                                'width' => '60',
                                'height' => '60',
                                'class' => 'variation-gallery-thumbnail'
                            ]
                        ); ?>
                        <button type="button" class="variation-gallery-remove" data-image-id="<?php echo esc_attr($image_id); ?>">
                            <span class="variation-gallery-remove-btn">&times;</span>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <input type="hidden" name="variation_gallery_nonce[<?php echo esc_attr($variation->ID); ?>]" value="<?php echo esc_attr(wp_create_nonce('save_variation_gallery_' . $variation->ID)); ?>" />
            <input type="hidden" name="variation_gallery_image[<?php echo esc_attr($variation->ID); ?>]" id="variation-gallery-input-<?php echo esc_attr($variation->ID); ?>" value="<?php echo esc_attr($gallery_images); ?>" />
            <button type="button" class="button upload-variation-gallery-image" data-variation-id="<?php echo esc_attr($variation->ID); ?>"><?php esc_html_e('Upload Images', 'variation-monster'); ?></button>
        </div>
        <?php
    }

    /**
     * Gallery image save for variations every product.
     *
     * @return void
     * @since 1.0.2
     */
    public function saveGalleryImages($product_id) {

        if (isset($_POST['variation_gallery_image'])) {

            $variation_gallery_images = array_map('sanitize_text_field', wp_unslash($_POST['variation_gallery_image']));
            $variation_gallery_nonce  = isset($_POST['variation_gallery_nonce'])
                ? array_map('sanitize_text_field', wp_unslash($_POST['variation_gallery_nonce']))
                : [];

            foreach ($variation_gallery_images as $variation_id => $image_ids) {

                if (!isset($variation_gallery_nonce[$variation_id]) ||
                    !wp_verify_nonce($variation_gallery_nonce[$variation_id], 'save_variation_gallery_' . $variation_id)) {
                    continue;
                }

                $image_ids_array     = array_filter(explode(',', $image_ids), 'is_numeric');
                $sanitized_image_ids = implode(',', $image_ids_array);

                update_post_meta($variation_id, '_variation_gallery_images', $sanitized_image_ids);
            }
        }
    }

    /** Add product data tab.
     *
     * @param array $tabs .
     * @since 1.0.0
     * @retun array
     */
    public function add_data_tab( $tabs ) {

        $tabs['product_preorder_woocommerce'] = array(
            'label'    => esc_html__( 'Product Variation Table with Quick Cart', 'variation-monster' ),
            'target'   => 'product_variation_product_data',
            'class'    => array( 'show_if_simple', 'show_if_variable' ),
            'priority' => 21,

        );

        return $tabs;
    }

    /**
     * Add product data panel.
     *
     * @since 1.0.0
     * @retun void
     */
    public function add_data_panel() {
        global $post;
        $product                                      = wc_get_product($post->ID);
        $attributes                                   = $product->get_attributes();
        $variableSetting                              = get_option('variable_all_checked', array());
        $quickCarouselOnOff                           = isset($variableSetting['quickCarouselOnOff']) ? $variableSetting['quickCarouselOnOff'] : '';
        $quickCarouselMeta                            = get_post_meta($post->ID, '_quick_cart_carousel_meta', true);
        $defaultValueQuickCarouselMeta                = !empty($quickCarouselMeta) ? $quickCarouselMeta : $quickCarouselOnOff;
        $selectVariationTemplateOnOff                 = isset($variableSetting['selectVariationTemplateOnOff']) ? $variableSetting['selectVariationTemplateOnOff'] : '';
        $variationListMeta                            = get_post_meta($post->ID, '_variation_list_meta', true);
        $defaultValueVariationListMeta                = !empty($variationListMeta) ? $variationListMeta : $selectVariationTemplateOnOff;
        $variationSelectOnOff                         = isset($variableSetting['variationSelectOnOff']) ? $variableSetting['variationSelectOnOff'] : '';
        $variationSwatchesMeta                        = get_post_meta($post->ID, '_variation_swatches_meta', true);
        $defaultValueVariationSwatchesMeta            = !empty($variationSwatchesMeta) ? $variationSwatchesMeta : $variationSelectOnOff;
        $quickTableOnOff                              = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
        $variationTableMeta                           = get_post_meta($post->ID, '_variation_table_meta', true);
        $defaultValueVariationTableMeta               = !empty($variationTableMeta) ? $variationTableMeta : $quickTableOnOff;
        $variationListTemplate                        = isset($variableSetting['variationListTemplate']) ? $variableSetting['variationListTemplate'] : 'template_1';
        $variationListTemplateMeta                    = get_post_meta($post->ID, '_variation_list_template_meta', true);
        $defaultValueVariationListTemplateMeta        = !empty($variationListTemplateMeta) ? $variationListTemplateMeta : $variationListTemplate;
        $variationTableTemplate                       = isset($variableSetting['variationTableTemplate']) ? $variableSetting['variationTableTemplate'] : 'template_1';
        $variationTableTemplateMeta                   = get_post_meta($post->ID, '_variation_table_template', true);
        $defaultValueVariationTableTemplateMeta       = !empty($variationTableTemplateMeta) ? $variationTableTemplateMeta : $variationTableTemplate;
        $designAddCartTableTemplate2                  = isset($variableSetting['designAddCartTableTemplate2']) ? $variableSetting['designAddCartTableTemplate2'] : 'template_1';
        $variationTable2CartTemplateMeta              = get_post_meta($post->ID, '_table_template2_cart_section_style_template', true);
        $defaultValueVariationTable2CartTemplateMeta  = !empty($variationTable2CartTemplateMeta) ? $variationTable2CartTemplateMeta : $designAddCartTableTemplate2;
        $showAttributeSwatchesArchive                 = isset($variableSetting['showAttributeSwatchesArchive'][0]) ? $variableSetting['showAttributeSwatchesArchive'][0] : '';
        $showAttributeSwatchesArchiveMeta             = get_post_meta($post->ID, '_variation_swatches_archive_page_meta', true);
        $defaultValueShowAttributeSwatchesArchiveMeta = !empty($showAttributeSwatchesArchiveMeta) ? $showAttributeSwatchesArchiveMeta : $showAttributeSwatchesArchive;

        wp_nonce_field('product_variation_table_data_meta_box_nonce', 'product_variation_meta_box_nonce');
        ?>
        <div id="product_variation_product_data" class="panel woocommerce_options_panel">

            <div style="">
                <div class='options_group'>
                    <?php

                    if ($quickCarouselOnOff === 'true'){
                        woocommerce_wp_select(
                            array(
                                'id'          => '_quick_cart_carousel_meta',
                                'label'       => __( 'Quick Cart Carousel', 'variation-monster' ),
                                'description' => __( 'Variation quick cart carousel enable disable for this product', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    'true'  => __( 'On', 'variation-monster' ),
                                    'false' => __( 'Off', 'variation-monster' ),
                                ),
                                'value'       => $defaultValueQuickCarouselMeta,  // Set the default value
                            )
                        );
                    }

                    if ($selectVariationTemplateOnOff === 'true'){
                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_list_meta',
                                'label'       => __( 'Variation List', 'variation-monster' ),
                                'description' => __( 'Variation List enable disable for this product', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    'true'  => __( 'On', 'variation-monster' ),
                                    'false' => __( 'Off', 'variation-monster' ),
                                ),
                                'value'       => $defaultValueVariationListMeta,  // Set the default value
                            )
                        );

                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_list_template_meta',
                                'label'       => __( 'Variation List Template', 'variation-monster' ),
                                'description' => __( 'Variation list template for this product. Also you can show this template from our global settings', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    ''           => __( 'Select', 'variation-monster' ),
                                    'template_1' => __( 'Template 1', 'variation-monster' ),
                                    'template_2' => __( 'Template 2', 'variation-monster' ),
                                ),
                                'value'        => $defaultValueVariationListTemplateMeta,
                            )
                        );
                    }

                    if ($variationSelectOnOff === 'true'){

                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_swatches_meta',
                                'label'       => __( 'Variation Swatches', 'variation-monster' ),
                                'description' => __( 'Variation swatches enable disable for this product', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    'true'  => __( 'On', 'variation-monster' ),
                                    'false' => __( 'Off', 'variation-monster' ),
                                ),
                                'value'       => $defaultValueVariationSwatchesMeta,  // Set the default value
                            )
                        );
                    }

                    if ($quickTableOnOff === 'true'){

                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_table_meta',
                                'label'       => __( 'Variation Table', 'variation-monster' ),
                                'description' => __( 'Variation table enable disable for this product', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    'true'  => __( 'On', 'variation-monster' ),
                                    'false' => __( 'Off', 'variation-monster' ),
                                ),
                                'value'       => $defaultValueVariationTableMeta,  // Set the default value
                            )
                        );

                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_table_template',
                                'label'       => __( 'Variation Table Template', 'variation-monster' ),
                                'description' => __( 'Variation table template for this product. Also you can show this template from our global settings', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    ''    => __( 'select', 'variation-monster' ),
                                    'template_1'    => __( 'Template 1', 'variation-monster' ),
                                    'template_2' => __( 'Template 2', 'variation-monster' ),
                                ),
                                'value'       => $defaultValueVariationTableTemplateMeta,
                            )
                        );


                        woocommerce_wp_select(
                            array(
                                'id'          => '_table_template2_cart_section_style_template',
                                'label'       => __( 'Cart Section Style Template', 'variation-monster' ),
                                'description' => __( 'Cart section style template in table template 2 for this product. Also you can show this template from our global settings', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    ''    => __( 'Select', 'variation-monster' ),
                                    'template_1'    => __( 'Template 1', 'variation-monster' ),
                                    'template_2' => __( 'Template 2', 'variation-monster' ),
                                ),
                                'value'      => $defaultValueVariationTable2CartTemplateMeta,
                            )
                        );
                    }

                    if ($showAttributeSwatchesArchive !== 'none'){
                        woocommerce_wp_select(
                            array(
                                'id'          => '_variation_swatches_archive_page_meta',
                                'label'       => __( 'Variation Swatches on Archive Page', 'variation-monster' ),
                                'description' => __( 'Enable single product variation swatches archive page settings', 'variation-monster' ),
                                'desc_tip'    => 'true',
                                'options'     => array(
                                    ''           => __( 'Select', 'variation-monster' ),
                                    'attribute-archive'   => __( 'Redirect Single Product Page', 'variation-monster' ),
                                    'attribute-swatches' => __( 'Quick Cart', 'variation-monster' ),
                                    'none'       => __( 'None', 'variation-monster' ),
                                ),
                                'value'      => $defaultValueShowAttributeSwatchesArchiveMeta,
                            )
                        );
                    }

                    ?>
                </div>
            </div>

            <h2 style="font-weight: bold"><?php esc_html_e('Extend Attribute Settings', 'variation-monster'); ?></h2>
            <table class="wp-list-table widefat fixed striped" id="attribute-table" style="cursor: pointer">
                <tbody>
                <?php
                if (!empty($attributes)) {
                    foreach ($attributes as $attribute) {
                        $attribute_name   = wc_attribute_label($attribute->get_name());
                        $attribute_slug   = sanitize_title($attribute->get_name());
                        $attribute_values = $attribute->is_taxonomy()
                            ? wc_get_product_terms($post->ID, $attribute->get_name(), ['fields' => 'names'])
                            : $attribute->get_options();

                        // Ensure $attribute_values is an array
                        $attribute_values = is_array($attribute_values) ? $attribute_values : [$attribute_values];

                        $attribute_id                   = $attribute->get_id();
                        $display_type_attribute_section = get_option( 'wc_attribute_display_type_' . $attribute_id );
                        $display_type                   = get_post_meta($post->ID, 'variation_meta_attribute_display_type_' . $attribute_slug, true);
                        $display_type                   = ($display_type === '') ? $display_type_attribute_section : $display_type;
                        $show_archive                   = get_post_meta($post->ID, 'show_attribute_archive_page_' . $attribute_slug, true);
                        ?>
                        <tr style="background-color: white" class="attribute-row" data-row-id="<?php echo esc_attr($attribute_id); ?>">
                            <td>
                                <h4 style="font-weight: bold;"><?php echo esc_html($attribute_name); ?></h4>
                            </td>
                            <td class="show-in-archive-page-attribute-select-option">
                                <label><?php esc_html_e('Show in Archive Page:', 'variation-monster'); ?></label>
                                <select name="show_attribute_archive_page[<?php echo esc_attr($attribute_slug); ?>]" id="show_attribute_archive_page_[<?php echo esc_attr($attribute_slug); ?>]">
                                    <option value="yes" <?php selected($show_archive, 'yes'); ?>><?php esc_html_e('Yes', 'variation-monster'); ?></option>
                                    <option value="" <?php selected($show_archive, ''); ?>><?php esc_html_e('No', 'variation-monster'); ?></option>
                                </select>
                            </td>
                            <td>
                                <label><?php esc_html_e('Display Type:', 'variation-monster'); ?></label>
                                <select data-rowSlug-displayType="<?php echo esc_attr($attribute_slug); ?>" name="attribute_display_type[<?php echo esc_attr($attribute_slug); ?>]" id="attribute_display_type_<?php echo esc_attr($attribute_slug); ?>">
                                    <option value="button" <?php selected($display_type, 'button'); ?>><?php esc_html_e('Button', 'variation-monster'); ?></option>
                                    <option value="color" <?php selected($display_type, 'color'); ?>><?php esc_html_e('Color', 'variation-monster'); ?></option>
                                    <option value="image" <?php selected($display_type, 'image'); ?>><?php esc_html_e('Image', 'variation-monster'); ?></option>
                                    <option value="radio" <?php selected($display_type, 'radio'); ?>><?php esc_html_e('Radio', 'variation-monster'); ?></option>
                                </select>
                                <p class="attribute-toggle-btn" data-row-id="<?php echo esc_attr($attribute_slug); ?>" style="cursor: pointer; display: inline-flex; align-items: center; margin-left: 80px">
                                    <span class="dashicons dashicons-arrow-down toggle-icon"></span>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3" style="border-top: 1px solid #000; margin: 20px 0"></td>
                        </tr>

                        <tr id="attribute-settings-<?php echo esc_attr($attribute_slug); ?>" class="attribute-settings" style="display: none;">
                            <td colspan="3">
                                <table>
                                    <tbody>
                                    <?php
                                    $term_ids = wc_get_product_terms($post->ID, $attribute->get_name(), ['fields' => 'ids']); // Retrieve term IDs
                                    $custom_attribute_values = [];

                                    if (!$attribute->is_taxonomy()) {
                                        $custom_attribute_values = $attribute->get_options();
                                    }

                                    if (!empty($term_ids)) {
                                        foreach ($term_ids as $term_id) {
                                            $color_attribute             = get_term_meta($term_id, 'term_color', true);
                                            $color_meta                  = get_post_meta($post->ID, 'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id, true);
                                            $secondary_color_attribute   = get_term_meta($term_id, 'term_secondary_color', true);
                                            $secondary_color_meta        = get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id, true);
                                            $image_attribute             = get_term_meta($term_id, 'term_image', true);
                                            $image_meta                  = get_post_meta($post->ID, 'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id, true);
                                            $image_url                   = !empty($image_meta) ? $image_meta : $image_attribute;
                                            $tooltip_meta                = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id, true);
                                            $save_tooltip_meta           = '';
                                            if (empty($tooltip_meta)){
                                                $save_tooltip_meta = get_term_meta($term_id, 'term_tooltip', true);
                                            }
                                            if (empty($save_tooltip_meta)){
                                                $save_tooltip_meta  = get_term($term_id)->name;
                                            }

                                            ?>
                                            <tr style="display: flex; gap: 200px; align-items: center; justify-content: center">
                                                <td style="min-width: 100px"><?php echo esc_html(get_term($term_id)->name); ?></td>
                                                <td>
                                                    <div class="color-meta display-typeShow-color-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-color-<?php echo esc_attr($term_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Color:', 'variation-monster'); ?></label>
                                                        <input type="text"
                                                               name="variation_meta_color[<?php echo esc_attr($term_id); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_color_<?php echo esc_attr($term_id); ?>_<?php echo esc_attr($attribute_id); ?>"
                                                               value="<?php echo esc_attr(!empty($color_meta)? $color_meta : $color_attribute); ?>"
                                                               class="wvs-color-picker" data-default-color="<?php echo esc_attr($color_attribute ?: '#ffffff'); ?>">

                                                    </div>

                                                    <div class="color-meta display-typeShow-color-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-secondary-color-<?php echo esc_attr($term_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Secondary Color:', 'variation-monster'); ?></label>
                                                        <input type="text"
                                                               name="variation_meta_secondary_color[<?php echo esc_attr($term_id); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_secondary_color_<?php echo esc_attr($term_id); ?>_<?php echo esc_attr($attribute_id); ?>"
                                                               value="<?php echo esc_attr(!empty($secondary_color_meta) ? $secondary_color_meta : $secondary_color_attribute); ?>"
                                                               class="wvs-color-picker" data-default-color="<?php echo esc_attr($secondary_color_attribute ?: '#ffffff');?>">

                                                    </div>

                                                    <div class="image-meta display-typeShow-image-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-image-<?php echo esc_attr($term_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Image:', 'variation-monster'); ?></label>
                                                        <img id="meta_term_image_preview_<?php echo esc_attr($term_id); ?>"
                                                             class="meta_term_image_preview"
                                                             src="<?php echo esc_url($image_url); ?>"
                                                             alt="Selected Image"
                                                             style="max-width: 70px; height: auto;">
                                                        <input type="hidden"
                                                               name="variation_meta_image[<?php echo esc_attr($term_id); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="meta_term_image_<?php echo esc_attr($term_id); ?>"
                                                               class="meta_term_image"
                                                               value="<?php echo esc_attr($image_url); ?>">
                                                        <div style="display: flex; gap: 10px;">
                                                            <button type="button" class="button meta_upload_image_button"><?php esc_html_e('Upload Image', 'variation-monster'); ?></button>
                                                            <button type="button" class="button meta_image_button_remove" style="background-color: firebrick; color: white;"><?php esc_html_e('Remove Image', 'variation-monster'); ?></button>
                                                        </div>
                                                    </div>
                                                    <div class="tooltip-meta" style="margin-top: 10px">
                                                        <label><?php esc_html_e('Tooltip:', 'variation-monster'); ?></label>
                                                        <input type="text" placeholder="
"
                                                               name="variation_meta_tooltip[<?php echo esc_attr($term_id); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_tooltip_<?php echo esc_attr($term_id); ?>"
                                                               value="<?php echo esc_attr(!empty($tooltip_meta)? $tooltip_meta : $save_tooltip_meta); ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: 1px solid #000; margin: 20px 0; min-width: 100px"></td>
                                            </tr>
                                            <?php
                                        }
                                    }

                                    // Display custom attributes
                                    if (!empty($custom_attribute_values)) {
                                        foreach ($custom_attribute_values as  $index => $custom_value) {

                                            $custom_value_slug   = sanitize_title($custom_value);
                                            $custom_value_id     = $index;
                                            $tooltip_meta_custom = get_post_meta($post->ID, 'variation_meta_attribute_tooltip_' . $custom_value_slug . '_' . $attribute_id, true)

                                            ?>
                                            <tr style="display: flex; gap: 200px; align-items: center; justify-content: center">
                                                <td style="min-width: 100px"><?php echo esc_html($custom_value); ?></td>
                                                <td>
                                                    <div class="color-meta display-typeShow-color-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-custom-color-<?php echo esc_attr($custom_value_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Color:', 'variation-monster'); ?></label>
                                                        <input type="text"
                                                               name="variation_meta_color[<?php echo esc_attr($custom_value_slug); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_color_<?php echo esc_attr($custom_value_slug); ?>_<?php echo esc_attr($attribute_id); ?>"
                                                               value="<?php echo esc_attr(get_post_meta($post->ID, 'variation_meta_attribute_color_' . $custom_value_slug . '_' . $attribute_id, true)); ?>"
                                                               class="wvs-color-picker" data-default-color="#ffffff">
                                                    </div>

                                                    <div class="color-meta display-typeShow-color-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-custom-secondary-color-<?php echo esc_attr($custom_value_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Secondary Color:', 'variation-monster'); ?></label>
                                                        <input type="text"
                                                               name="variation_meta_secondary_color[<?php echo esc_attr($custom_value_slug); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_secondary_color_<?php echo esc_attr($custom_value_slug); ?>_<?php echo esc_attr($attribute_id); ?>"
                                                               value="<?php echo esc_attr(get_post_meta($post->ID, 'variation_meta_attribute_secondary_color_' . $custom_value_slug . '_' . $attribute_id, true)); ?>"
                                                               class="wvs-color-picker" data-default-color="#ffffff">
                                                    </div>

                                                    <div class="image-meta display-typeShow-image-<?php echo esc_attr($attribute_slug); ?>" id="display-select-option-custom-image-<?php echo esc_attr($custom_value_id); ?>-<?php echo esc_attr($attribute_id); ?>" style="display: none;">
                                                        <label><?php esc_html_e('Image:', 'variation-monster'); ?></label>
                                                        <img id="meta_term_image_preview_<?php echo esc_attr($custom_value_slug); ?>"
                                                             class="meta_term_image_preview"
                                                             src="<?php echo esc_url(get_post_meta($post->ID, 'variation_meta_attribute_image_' . $custom_value_slug . '_' . $attribute_id, true)); ?>"
                                                             alt="Selected Image"
                                                             style="max-width: 70px; height: auto;">
                                                        <input type="hidden"
                                                               name="variation_meta_image[<?php echo esc_attr($custom_value_slug); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="meta_term_image_<?php echo esc_attr($custom_value_slug); ?>"
                                                               class="meta_term_image"
                                                               value="<?php echo esc_attr(get_post_meta($post->ID, 'variation_meta_attribute_image_' . $custom_value_slug . '_' . $attribute_id, true)); ?>">
                                                        <div style="display: flex; gap: 10px;">
                                                            <button type="button" class="button meta_upload_image_button">Upload Image</button>
                                                            <button type="button" class="button meta_image_button_remove" style="background-color: firebrick; color: white;">Remove Image</button>
                                                        </div>
                                                    </div>
                                                    <div class="tooltip-meta" style="margin-top: 10px">
                                                        <label><?php esc_html_e('Tooltip:', 'variation-monster'); ?></label>
                                                        <input type="text" placeholder="Tooltip"
                                                               name="variation_meta_tooltip[<?php echo esc_attr($custom_value_slug); ?>][<?php echo esc_attr($attribute_id); ?>]"
                                                               id="variation_meta_tooltip_<?php echo esc_attr($custom_value_slug); ?>"
                                                               value="<?php echo esc_attr(!empty($tooltip_meta_custom) ? $tooltip_meta_custom : $custom_value); ?>">
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: 1px solid #000; margin: 20px 0; min-width: 100px"></td>
                                            </tr>
                                            <?php
                                        }
                                    }

                                    if (empty($term_ids) && empty($custom_attribute_values)) {
                                        echo '<tr><td colspan="2">' . esc_html__('No attributes found for this product.', 'variation-monster') . '</td></tr>';
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="2">' . esc_html__('No attributes found.', 'variation-monster') . '</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }



    /**
     * Save product variation and quick cart metadata.
     *
     * This function handles the saving of product-specific variation and quick cart meta fields in the WooCommerce product data panel.
     * It verifies the nonce for security, sanitizes the input fields, and updates the corresponding post meta  data.
     *
     * @since 1.0.0
     *
     * @param int $post_id The ID of the product being saved.
     *
     * @throws Exception If nonce validation fails or fields contain invalid data.
     *
     * @return void|int Returns the post ID if nonce or other checks fail, otherwise saves the meta data.
     */
    public function save_product_meta($post_id) {
        // Verify nonce
        if (!isset($_POST['product_variation_meta_box_nonce']) ||
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['product_variation_meta_box_nonce'])), 'product_variation_table_data_meta_box_nonce')) {
            return $post_id;
        }

        $quick_cart_carousel_meta    = isset( $_POST['_quick_cart_carousel_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_quick_cart_carousel_meta'] ) ) : '';
        $variation_list_meta         = isset( $_POST['_variation_list_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_list_meta'] ) ) : '';
        $variation_list_template     = isset( $_POST['_variation_list_template_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_list_template_meta'] ) ) : '';
        $variation_swatches_meta     = isset( $_POST['_variation_swatches_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_swatches_meta'] ) ) : '';
        $variation_table_meta        = isset( $_POST['_variation_table_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_table_meta'] ) ) : '';
        $variation_table_template    = isset( $_POST['_variation_table_template'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_table_template'] ) ) : '';
        $cart_section_style_template = isset( $_POST['_table_template2_cart_section_style_template'] ) ? sanitize_text_field( wp_unslash( $_POST['_table_template2_cart_section_style_template'] ) ) : '';
        $swatches_archive_page_meta  = isset( $_POST['_variation_swatches_archive_page_meta'] ) ? sanitize_text_field( wp_unslash( $_POST['_variation_swatches_archive_page_meta'] ) ) : '';

        $attribute_display_type         = isset( $_POST['attribute_display_type'] ) ? array_map('sanitize_text_field', wp_unslash($_POST['attribute_display_type'])) : '';
        $show_attribute_archive_page    = isset( $_POST['show_attribute_archive_page'] ) ? array_map('sanitize_text_field', wp_unslash($_POST['show_attribute_archive_page'])) : '';
        $variation_meta_color           = isset( $_POST['variation_meta_color']) ? map_deep(wp_unslash($_POST['variation_meta_color']), 'sanitize_text_field') : [];
        $variation_meta_secondary_color = isset( $_POST['variation_meta_secondary_color']) ? map_deep(wp_unslash($_POST['variation_meta_secondary_color']), 'sanitize_text_field') : [];
        $variation_meta_image           = isset( $_POST['variation_meta_image']) ? map_deep(wp_unslash($_POST['variation_meta_image']), 'sanitize_text_field') : [];
        $variation_meta_tooltip         = isset( $_POST['variation_meta_tooltip']) ? map_deep(wp_unslash($_POST['variation_meta_tooltip']), 'sanitize_text_field') : [];
        $term_gallery_image             = isset( $_POST['term_gallery_image']) ? map_deep(wp_unslash($_POST['term_gallery_image']), 'sanitize_text_field') : [];

        update_post_meta( $post_id, '_quick_cart_carousel_meta', $quick_cart_carousel_meta );
        update_post_meta( $post_id, '_variation_list_meta', $variation_list_meta );
        update_post_meta( $post_id, '_variation_list_template_meta', $variation_list_template );
        update_post_meta( $post_id, '_variation_swatches_meta', $variation_swatches_meta );
        update_post_meta( $post_id, '_variation_table_meta', $variation_table_meta );
        update_post_meta( $post_id, '_variation_table_template', $variation_table_template );
        update_post_meta( $post_id, '_table_template2_cart_section_style_template', $cart_section_style_template );
        update_post_meta( $post_id, '_variation_swatches_archive_page_meta', $swatches_archive_page_meta );


        // Save display type
        foreach ($attribute_display_type as $attribute_slug => $display_type) {
            update_post_meta($post_id, 'variation_meta_attribute_display_type_' . $attribute_slug, sanitize_text_field($display_type));
        }


        // Save show attribute into archive page
        foreach ($show_attribute_archive_page as $attribute_slug => $archive_page) {
            update_post_meta($post_id, 'show_attribute_archive_page_' . $attribute_slug, sanitize_text_field($archive_page));
        }

        // Save color meta
        foreach ($variation_meta_color as $term_id => $colors) {
            foreach ($colors as $attribute_id => $color) {
                // Skip saving if the input was disabled (i.e., value is empty)
                if (!empty($color)) {
                    update_post_meta(
                        $post_id,
                        'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id,
                        sanitize_text_field($color)
                    );
                } else {
                    delete_post_meta(
                        $post_id,
                        'variation_meta_attribute_color_' . $term_id . '_' . $attribute_id
                    );
                }
            }
        }

        // Save secondary color meta
        foreach ($variation_meta_secondary_color as $term_id => $colors) {
            foreach ($colors as $attribute_id => $color) {
                update_post_meta(
                    $post_id,
                    'variation_meta_attribute_secondary_color_' . $term_id . '_' . $attribute_id,
                    sanitize_text_field($color)
                );
            }
        }


        // Save image meta
        foreach ($variation_meta_image as $term_id => $images) {
            foreach ($images as $attribute_id => $image) {
                update_post_meta(
                    $post_id,
                    'variation_meta_attribute_image_' . $term_id . '_' . $attribute_id,
                    esc_url_raw($image)
                );
            }
        }

        // Save tooltip meta
        foreach ($variation_meta_tooltip as $term_id => $tooltips) {
            foreach ($tooltips as $attribute_id => $tooltip) {
                update_post_meta(
                    $post_id,
                    'variation_meta_attribute_tooltip_' . $term_id . '_' . $attribute_id,
                    sanitize_text_field($tooltip)
                );
            }
        }

        // Save term images
        foreach ($term_gallery_image as $term_id => $image_ids) {
            foreach ($image_ids as $attribute_id => $image_string) {
                $image_ids_array = array_filter(explode(',', $image_string), 'is_numeric');
                $sanitized_image_ids = implode(',', $image_ids_array);
                update_post_meta($post_id, '_term_gallery_images_' . $term_id . '_' . $attribute_id, $sanitized_image_ids);
            }
        }

    }

    /**
     * Handle AJAX request dismiss review notice.
     *
     * @return void
     * @since 1.0.2
     */
    function quick_variable_review_dismissed_ajax() {

        check_ajax_referer('qvt_nonce', '_nonce');
        update_option('quick_variable_review_dismissed', true);
        wp_send_json_success(['message' => 'Notice dismissed successfully.']);
    }

    /**
     * Enqueue script.
     *
     * @return void
     * @since 1.0.2
     */
    public function enqueueAssets() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery');
        wp_enqueue_script(
            'variation-gallery-admin',
            plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/admin.js',
            ['jquery', 'wp-color-picker'],
            '1.0.0',
            true
        );

        wp_enqueue_style('main-font-awesome-css-admin', plugin_dir_url(dirname(__FILE__)) . 'Assets/CSS/font-awesome.min.css', array(), '4.7.0');

        $logo_url = esc_url(plugin_dir_url(dirname(__FILE__)) . 'Assets/images/logo.png');
        wp_localize_script( 'variation-gallery-admin', 'qvt_notice_obj', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'qvt_nonce' ),
            'logo_url' => $logo_url
        ));
    }

}

