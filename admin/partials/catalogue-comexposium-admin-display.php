<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page'));
}
?>

<div class="wrap">
    <h1><?= _e('Comexposium Catalogue', 'catalogue_comexposium'); ?></h1>

    <?php

    $id_salon = get_option('catalogue_comexposium_id_salon');
    $route_name = get_option('catalogue_comexposium_route_name');
    $lang = get_option('catalogue_comexposium_lang');

    if ($_REQUEST['settings-updated'] && $id_salon !== '' && $route_name !== '' && $lang !== '') {
        Catalogue_Comexposium_Admin::print_shortcode();
    }

    ?>

    <form method="post" action="options.php">
        <?php settings_errors(); ?>
        <?php settings_fields('catalogue-comexposium-settings-group'); ?>
        <?php do_settings_sections('catalogue-comexposium-settings-group'); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?= _e('Show ID', 'catalogue-comexposium'); ?>
                    <span class="red-color">*</span>
                    <p><?= _e('Enter the identifier of the show', 'catalogue-comexposium'); ?></p>
                </th>
                <td><input type="text" name="catalogue_comexposium_id_salon" placeholder="foire_de_paris" value="<?php echo esc_attr(get_option('catalogue_comexposium_id_salon')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?= _e('Page Name', 'catalogue-comexposium'); ?>
                    <span class="red-color">*</span>
                    <p><?= _e('Enter the name of the page you will display Comexposium Catalogue', 'catalogue-comexposium'); ?></p>
                </th>
                <td><input type="text" name="catalogue_comexposium_route_name" placeholder="catalogue" value="<?php echo esc_attr(get_option('catalogue_comexposium_route_name')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?= _e('Langage', 'catalogue-comexposium'); ?>
                    <span class="red-color">*</span>
                    <p><?= _e('Enter the language code', 'catalogue-comexposium'); ?><br>
                        <?= _e('Must be "fr" or "en"', 'catalogue-comexposium'); ?></p>
                </th>
                <td><input type="text" name="catalogue_comexposium_lang" placeholder="<?= _e('fr or en', 'catalogue-comexposium'); ?>" value="<?php echo esc_attr(get_option('catalogue_comexposium_lang')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?= _e('Meta Description', 'catalogue-comexposium'); ?>
                    <p><?= _e('Enter the meta description', 'catalogue-comexposium'); ?>
                </th>
                <td><input type="text" class="regular-text" name="catalogue_comexposium_meta_desc" placeholder="<?= _e('this is the meta description', 'catalogue-comexposium'); ?>" value="<?php echo esc_attr(get_option('catalogue_comexposium_meta_desc')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?= _e('Key words', 'catalogue-comexposium'); ?>
                    <p><?= _e('Enter key words separated by a comma', 'catalogue-comexposium'); ?>
                </th>
                <td><input type="text" name="catalogue_comexposium_key_words" placeholder="<?= _e('key, words', 'catalogue-comexposium'); ?>" value="<?php echo esc_attr(get_option('catalogue_comexposium_key_words')); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>