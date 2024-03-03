<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://elivate.net
 * @since      1.0.0
 *
 * @package    Extra_Options
 * @subpackage Extra_Options/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <form method="post" action="options.php">
        <?php
        // Output nonce, action, and option_page fields for a settings page.
        settings_fields( 'extra_options' );
        // Output setting sections and their fields.
        do_settings_sections( 'extra_options' );
        // Output submit button.
        submit_button( 'Save Settings' );
        ?>
    </form>
</div>
