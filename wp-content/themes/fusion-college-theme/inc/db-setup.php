<?php
// DB Setup functionality
if (!defined('ABSPATH')) exit;

function fusion_add_db_setup_menu() {
    add_submenu_page(
        'themes.php',
        'Fusion DB Setup',
        'DB Setup',
        'manage_options',
        'fusion-db-setup',
        'fusion_db_setup_page'
    );
}
add_action('admin_menu', 'fusion_add_db_setup_menu');

function fusion_db_setup_page() {
    if (isset($_POST['test_db'])) {
        $creds = [
            'db_name' => sanitize_text_field($_POST['db_name']),
            'db_user' => sanitize_text_field($_POST['db_user']),
            'db_pass' => $_POST['db_pass'],
            'db_host' => sanitize_text_field($_POST['db_host'])
        ];
        $test_db = new wpdb($creds['db_user'], $creds['db_pass'], $creds['db_name'], $creds['db_host']);
        if ($test_db->check_connection()) {
            echo '<div class="notice notice-success"><p>DB connection successful!</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Connection failed.</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h1>Fusion College DB Setup</h1>
    <p>Verify WP DB connection. Theme uses WP posts/CPTs (no custom tables needed).</p>
        <form method="post">
            <?php wp_nonce_field('fusion_db_test'); ?>
            <table class="form-table">
                <tr><th>DB Name</th><td><input type="text" name="db_name" value="<?php echo DB_NAME; ?>"></td></tr>
                <tr><th>DB User</th><td><input type="text" name="db_user" value="<?php echo DB_USER; ?>"></td></tr>
                <tr><th>DB Password</th><td><input type="password" name="db_pass"></td></tr>
                <tr><th>DB Host</th><td><input type="text" name="db_host" value="<?php echo DB_HOST; ?>"></td></tr>
            </table>
            <p><input type="submit" name="test_db" class="button-primary" value="Test Connection"></p>
        </form>
        <?php
    }
?>

