<?php /**
  * Create taxonomy
  */
function taxonomy_brand()
{
    $label = [
        'name' => 'Brands',
        'singular_name' => 'Brand',
        'menu_name' => 'Brands',
        'all_items' => 'All Brands',
        'parent_item' => 'Parent Brand',
        'parent_item_colon' => 'Parent Brand: ',
        'add_new_item' => 'Add New Brand',
        'new_item_name' => 'New Brand Name',
        'edit_item' => 'Edit Item',
        'update_item' => 'Update Item',
        'separate_items_with_commas' => 'Separate Brand with commas',
        'search_items' => 'Search Brands',
        'add_or_remove_items' => 'Add or remove Brands',
        'choose_from_most_used' => 'Choose from the most use Brand'
    ];
    $args = [
        'labels' => $label,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    ];
    register_taxonomy('item', 'product', $args);
}
add_action('init', 'taxonomy_brand');
add_action('item_add_form_fields', 'add_term_fields');

function add_term_fields($taxonomy)
{
    $image_id = get_option('my_image');
    $image = wp_get_attachment_image_url($image_id);
    if ($image): ?>
        <a href="#" class="rudr-upload">
            <img width="40" height="40" src="<?php echo esc_url($image) ?>" />
        </a>
        <a href="#" class="rudr-remove">Remove image</a>
        <input type="hidden" name="rudr_img" value="<?php echo absint($image_id) ?>">
    <?php else: ?>
        <a href="#" class="button rudr-upload">Upload image</a>
        <a href="#" class="rudr-remove" style="display:none">Remove image</a>
        <input type="hidden" name="rudr_img" value="">
    <?php endif;
}
add_action('admin_enqueue_scripts', 'include_js');
function include_js()
{

    // I recommend to add additional conditions here
    // because we probably do not need the scripts on every admin page, right?

    // WordPress media uploader scripts
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }
    // our custom JS
    wp_enqueue_script(
        'upload',
        get_stylesheet_directory_uri() . '/assets/js/customizer.js',
        array('jquery')
    );
}
add_filter('simple_register_option_pages', 'option_page');

add_action('item_edit_form_fields', 'rudr_edit_term_fields', 10, 2);
function rudr_edit_term_fields($term, $taxonomy)
{

    // get meta data value
    $text_field = get_term_meta($term->term_id, 'rudr_text', true);
    $image_id = get_term_meta($term->term_id, 'rudr_img', true);

    ?>
    <tr class="form-field">
        <th><label for="rudr_text">Text Field</label></th>
        <td>
            <input name="rudr_text" id="rudr_text" type="text" value="<?php echo esc_attr($text_field) ?>" />
            <p class="description">Field description may go here.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th>
            <label for="rudr_img">Image Field</label>
        </th>
        <td>
            <?php if ($image = wp_get_attachment_image_url($image_id, 'medium')): ?>
                <a href="#" class="rudr-upload">
                    <img width="50" height="50" src="<?php echo esc_url($image) ?>" />
                </a>
                <a href="#" class="rudr-remove">Remove image</a>
                <input type="hidden" name="rudr_img" value="<?php echo absint($image_id) ?>">
            <?php else: ?>
                <a href="#" class="button rudr-upload">Upload image</a>
                <a href="#" class="rudr-remove" style="display:none">Remove image</a>
                <input type="hidden" name="rudr_img" value="">
            <?php endif; ?>
        </td>
    </tr>
    <?php
}
add_action('created_item', 'rudr_save_term_fields');
add_action('edited_item', 'rudr_save_term_fields');
function rudr_save_term_fields($term_id)
{

    update_term_meta(
        $term_id,
        'rudr_text',
        sanitize_text_field($_POST['rudr_text'])
    );
    update_term_meta(
        $term_id,
        'rudr_img',
        absint($_POST['rudr_img'])
    );

}
function option_page($option_pages)
{

    $option_pages[] = array(
        'id' => 'settings',
        'title' => 'My Page Settings',
        'menu_name' => 'My page',
        'fields' => array(
            array(
                'id' => 'my_field',
                'label' => 'Text Field',
                'type' => 'text',
            ),
            array(
                'id' => 'my_checkbox',
                'label' => 'Checkbox',
                'type' => 'checkbox',
                'short_description' => 'Yes, absolutely'
            ),
            array(
                'id' => 'my_image',
                'label' => 'Image',
                'type' => 'image',
            )
        ),
    );

    return $option_pages;

}