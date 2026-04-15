<?php
/**
 * Custom Admin Pages for Fusion College Theme
 * Provides admin interface for managing contact messages and email settings
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Add custom admin menu
 */
function fusion_college_admin_menu() {
    // Main menu
    add_menu_page(
        'Contact Messages',
        'Contact Messages',
        'manage_options',
        'fusion-college-contacts',
        'fusion_college_contacts_admin_page',
        'dashicons-email-alt',
        30
    );

    // Submenu: All Contact Messages
    add_submenu_page(
        'fusion-college-contacts',
        'All Messages',
        'All Messages',
        'manage_options',
        'fusion-college-contacts',
        'fusion_college_contacts_admin_page'
    );

    // Submenu: Email Settings
    add_submenu_page(
        'fusion-college-contacts',
        'Email Settings',
        'Email Settings',
        'manage_options',
        'fusion-college-email-settings',
        'fusion_college_email_settings_page'
    );
}
add_action('admin_menu', 'fusion_college_admin_menu');

/**
 * Register contact message custom post type
 */
function fusion_college_register_contact_message_cpt() {
    register_post_type('contact_message', array(
        'labels' => array(
            'name' => 'Contact Messages',
            'singular_name' => 'Contact Message',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Contact Message',
            'edit_item' => 'Edit Contact Message',
            'new_item' => 'New Contact Message',
            'view_item' => 'View Contact Message',
            'search_items' => 'Search Contact Messages',
            'not_found' => 'No contact messages found',
            'not_found_in_trash' => 'No contact messages found in trash',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => false, // Hide from main menu, we have custom menu
        'supports' => array('title', 'custom-fields'),
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'register_meta_box_cb' => 'fusion_college_contact_message_meta_boxes',
    ));
}
add_action('init', 'fusion_college_register_contact_message_cpt');

/**
 * Add meta boxes for contact message
 */
function fusion_college_contact_message_meta_boxes() {
    remove_meta_box('submitdiv', 'contact_message', 'side');
    remove_meta_box('slugdiv', 'contact_message', 'normal');
}

/**
 * Contact Messages Admin Page
 */
function fusion_college_contacts_admin_page() {
    // Handle delete
    if (isset($_POST['delete_message']) && current_user_can('manage_options')) {
        $message_id = intval($_POST['message_id']);
        if (wp_delete_post($message_id, true)) {
            echo '<div class="notice notice-success is-dismissible"><p>Message deleted successfully!</p></div>';
        }
    }

    // Handle mark as read
    if (isset($_POST['mark_read']) && current_user_can('manage_options')) {
        $message_id = intval($_POST['message_id']);
        update_post_meta($message_id, '_is_read', '1');
        echo '<div class="notice notice-success is-dismissible"><p>Message marked as read!</p></div>';
    }

    $messages = get_posts(array(
        'post_type' => 'contact_message',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'orderby' => 'date',
        'order' => 'DESC',
    ));

    $unread_count = 0;
    foreach ($messages as $msg) {
        if (!get_post_meta($msg->ID, '_is_read', true)) {
            $unread_count++;
        }
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Contact Messages 
            <?php if ($unread_count > 0): ?>
                <span class="update-plugins"><span class="plugin-count"><?php echo $unread_count; ?></span></span>
            <?php endif; ?>
        </h1>
        
        <hr class="wp-header-end">

        <?php if (empty($messages)): ?>
            <div class="notice notice-info">
                <p>No contact messages yet. Messages submitted through the contact form will appear here.</p>
            </div>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th class="check-column"><input type="checkbox" id="cb-select-all-1"></th>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 150px;">Name</th>
                        <th style="width: 200px;">Email</th>
                        <th style="width: 120px;">Phone</th>
                        <th style="width: 150px;">Subject</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 100px;">Date</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): 
                        $name = get_post_meta($message->ID, '_contact_name', true);
                        $email = get_post_meta($message->ID, '_contact_email', true);
                        $phone = get_post_meta($message->ID, '_contact_phone', true);
                        $subject = get_post_meta($message->ID, '_contact_subject', true);
                        $message_content = get_post_meta($message->ID, '_contact_message', true);
                        $is_read = get_post_meta($message->ID, '_is_read', true);
                    ?>
                    <tr <?php echo !$is_read ? 'style="background-color: #f0f6ff;"' : ''; ?>>
                        <th scope="row" class="check-column">
                            <input type="checkbox" name="message_ids[]" value="<?php echo $message->ID; ?>">
                        </th>
                        <td><?php echo $message->ID; ?></td>
                        <td>
                            <strong><?php echo esc_html($name ?: 'N/A'); ?></strong>
                            <?php if (!$is_read): ?>
                                <span class="dashicons dashicons-marker" style="color: #0073aa;"></span>
                            <?php endif; ?>
                        </td>
                        <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email ?: 'N/A'); ?></a></td>
                        <td><?php echo esc_html($phone ?: '-'); ?></td>
                        <td><?php echo esc_html($subject ?: 'N/A'); ?></td>
                        <td>
                            <?php if (!$is_read): ?>
                                <span class="label label-unread" style="background: #2271b1; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px;">Unread</span>
                            <?php else: ?>
                                <span class="label label-read" style="background: #00a32a; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px;">Read</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo get_the_date('M d, Y', $message->ID); ?><br><small><?php echo get_the_time('g:i a', $message->ID); ?></small></td>
                        <td>
                            <button type="button" class="button button-small view-message-btn" 
                                data-name="<?php echo esc_attr($name); ?>"
                                data-email="<?php echo esc_attr($email); ?>"
                                data-phone="<?php echo esc_attr($phone); ?>"
                                data-subject="<?php echo esc_attr($subject); ?>"
                                data-message="<?php echo esc_attr($message_content); ?>"
                                data-date="<?php echo get_the_date('M d, Y g:i a', $message->ID); ?>">View</button>
                            
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="message_id" value="<?php echo $message->ID; ?>">
                                <?php if (!$is_read): ?>
                                    <button type="submit" name="mark_read" class="button button-small">Mark Read</button>
                                <?php endif; ?>
                            </form>
                            
                            <form method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                <input type="hidden" name="message_id" value="<?php echo $message->ID; ?>">
                                <button type="submit" name="delete_message" class="button button-small button-link-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- View Message Modal -->
        <div id="view-message-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100000;">
            <div style="position: relative; max-width: 600px; margin: 100px auto; background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                <div style="padding: 20px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="margin: 0; font-size: 20px;">Contact Message Details</h2>
                    <button id="close-modal" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
                </div>
                <div style="padding: 20px;">
                    <table class="widefat">
                        <tbody>
                            <tr>
                                <th style="width: 120px;">Name</th>
                                <td id="modal-name"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="modal-email"></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td id="modal-phone"></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td id="modal-subject"></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="modal-date"></td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td id="modal-message" style="white-space: pre-wrap;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding: 15px 20px; border-top: 1px solid #ddd; text-align: right;">
                    <button id="close-modal-btn" class="button button-primary">Close</button>
                </div>
            </div>
        </div>

        <style>
            .wp-heading-inline .update-plugins {
                display: inline-block;
                margin-left: 5px;
                vertical-align: top;
            }
            .wp-heading-inline .plugin-count {
                display: inline-block;
                padding: 2px 8px;
                background: #d63638;
                color: white;
                border-radius: 50%;
                font-size: 12px;
                font-weight: 600;
            }
            #view-message-modal {
                animation: fadeIn 0.2s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            #view-message-modal table td {
                vertical-align: top;
                padding: 10px;
            }
            #view-message-modal table th {
                padding: 10px;
            }
        </style>

        <script>
        jQuery(document).ready(function($) {
            // View message modal
            $('.view-message-btn').on('click', function() {
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var subject = $(this).data('subject');
                var message = $(this).data('message');
                var date = $(this).data('date');

                $('#modal-name').text(name);
                $('#modal-email').html('<a href="mailto:' + email + '">' + email + '</a>');
                $('#modal-phone').text(phone);
                $('#modal-subject').text(subject);
                $('#modal-message').text(message);
                $('#modal-date').text(date);
                $('#view-message-modal').fadeIn(200);
            });

            // Close modal
            $('#close-modal, #close-modal-btn').on('click', function() {
                $('#view-message-modal').fadeOut(200);
            });

            // Close on escape
            $(document).on('keyup', function(e) {
                if (e.key === 'Escape') {
                    $('#view-message-modal').fadeOut(200);
                }
            });

            // Close on background click
            $('#view-message-modal').on('click', function(e) {
                if (e.target === this) {
                    $(this).fadeOut(200);
                }
            });

            // Select all checkbox
            $('#cb-select-all-1').on('change', function() {
                $('input[name="message_ids[]"]').prop('checked', this.checked);
            });
        });
        </script>
    </div>
    <?php
}

/**
 * Email Settings Admin Page
 */
function fusion_college_email_settings_page() {
    if (isset($_POST['save_email_settings'])) {
        update_option('fusion_smtp_enabled', isset($_POST['smtp_enabled']) ? '1' : '0');
        update_option('fusion_smtp_host', sanitize_text_field($_POST['smtp_host']));
        update_option('fusion_smtp_port', sanitize_text_field($_POST['smtp_port']));
        update_option('fusion_smtp_encryption', sanitize_text_field($_POST['smtp_encryption']));
        update_option('fusion_smtp_username', sanitize_text_field($_POST['smtp_username']));
        update_option('fusion_smtp_password', sanitize_text_field($_POST['smtp_password']));
        update_option('fusion_smtp_from_email', sanitize_email($_POST['smtp_from_email']));
        update_option('fusion_smtp_from_name', sanitize_text_field($_POST['smtp_from_name']));
        update_option('fusion_notification_email', sanitize_email($_POST['notification_email']));

        echo '<div class="notice notice-success is-dismissible"><p>Email settings saved successfully!</p></div>';
    }

    // Test email functionality
    if (isset($_POST['test_email']) && current_user_can('manage_options')) {
        $test_email = sanitize_email($_POST['test_email_address']);
        if (is_email($test_email)) {
            $subject = 'Test Email from ' . get_bloginfo('name');
            $message = "This is a test email to verify your SMTP configuration.\n\n";
            $message .= "If you received this email, your email settings are working correctly!\n\n";
            $message .= "Sent from: " . home_url();
            
            $headers = array('Content-Type: text/plain; charset=UTF-8');
            
            if (wp_mail($test_email, $subject, $message, $headers)) {
                echo '<div class="notice notice-success is-dismissible"><p>Test email sent successfully to ' . esc_html($test_email) . '! Check your inbox.</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Failed to send test email. Please check your SMTP settings.</p></div>';
            }
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Please enter a valid email address.</p></div>';
        }
    }

    $smtp_enabled = get_option('fusion_smtp_enabled', '0');
    $smtp_host = get_option('fusion_smtp_host', 'smtp.gmail.com');
    $smtp_port = get_option('fusion_smtp_port', '587');
    $smtp_encryption = get_option('fusion_smtp_encryption', 'tls');
    $smtp_username = get_option('fusion_smtp_username', '');
    $smtp_password = get_option('fusion_smtp_password', '');
    $smtp_from_email = get_option('fusion_smtp_from_email', get_option('admin_email'));
    $smtp_from_name = get_option('fusion_smtp_from_name', get_bloginfo('name'));
    $notification_email = get_option('fusion_notification_email', get_option('admin_email'));

    // Common SMTP presets
    $smtp_presets = array(
        'gmail' => array('host' => 'smtp.gmail.com', 'port' => '587', 'encryption' => 'tls'),
        'outlook' => array('host' => 'smtp-mail.outlook.com', 'port' => '587', 'encryption' => 'tls'),
        'yahoo' => array('host' => 'smtp.mail.yahoo.com', 'port' => '587', 'encryption' => 'tls'),
        'office365' => array('host' => 'smtp.office365.com', 'port' => '587', 'encryption' => 'tls'),
        'sendgrid' => array('host' => 'smtp.sendgrid.net', 'port' => '587', 'encryption' => 'tls'),
        'mailgun' => array('host' => 'smtp.mailgun.org', 'port' => '587', 'encryption' => 'tls'),
    );
    ?>
    <div class="wrap">
        <h1>Email & SMTP Settings</h1>
        
        <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0;"><strong>Important:</strong> Configure SMTP to ensure reliable email delivery from your contact form and other notifications. Without SMTP, emails may fail or go to spam.</p>
        </div>

        <form method="post" action="" id="email-settings-form">
            <input type="hidden" name="action" value="save_email_settings">
            
            <div class="card" style="max-width: 800px; margin-bottom: 20px;">
                <h2 style="margin-top: 0; padding-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;">SMTP Configuration</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="label">Quick Setup Presets</th>
                        <td>
                            <select id="smtp-preset">
                                <option value="">Select Email Provider...</option>
                                <?php foreach ($smtp_presets as $key => $preset): ?>
                                    <option value="<?php echo esc_attr(json_encode($preset)); ?>"><?php echo ucfirst($key); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description">Select your email provider to auto-fill SMTP host and port settings</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_enabled">Enable SMTP</label></th>
                        <td>
                            <label style="margin-right: 20px;">
                                <input type="checkbox" name="smtp_enabled" id="smtp_enabled" value="1" <?php checked($smtp_enabled, '1'); ?>> Enable SMTP (recommended)
                            </label>
                            <p class="description">When disabled, WordPress default mail (PHP mail) will be used</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_host">SMTP Host</label></th>
                        <td><input type="text" name="smtp_host" id="smtp_host" value="<?php echo esc_attr($smtp_host); ?>" placeholder="e.g., smtp.gmail.com" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_port">SMTP Port</label></th>
                        <td><input type="text" name="smtp_port" id="smtp_port" value="<?php echo esc_attr($smtp_port); ?>" placeholder="587" class="small-text"></td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_encryption">Encryption</label></th>
                        <td>
                            <select name="smtp_encryption" id="smtp_encryption">
                                <option value="tls" <?php selected($smtp_encryption, 'tls'); ?>>TLS (recommended)</option>
                                <option value="ssl" <?php selected($smtp_encryption, 'ssl'); ?>>SSL</option>
                                <option value="" <?php selected($smtp_encryption, ''); ?>>None</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card" style="max-width: 800px; margin-bottom: 20px;">
                <h2 style="margin-top: 0; padding-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;">SMTP Authentication</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="label"><label for="smtp_username">SMTP Username</label></th>
                        <td><input type="text" name="smtp_username" id="smtp_username" value="<?php echo esc_attr($smtp_username); ?>" placeholder="your@email.com" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_password">SMTP Password</label></th>
                        <td>
                            <input type="password" name="smtp_password" id="smtp_password" value="<?php echo esc_attr($smtp_password); ?>" placeholder="Your SMTP password or app password" class="regular-text">
                            <p class="description">For Gmail, use an <a href="https://support.google.com/accounts/answer/185833" target="_blank">App Password</a> if 2FA is enabled</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card" style="max-width: 800px; margin-bottom: 20px;">
                <h2 style="margin-top: 0; padding-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;">Email Settings</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="label"><label for="smtp_from_email">From Email</label></th>
                        <td><input type="email" name="smtp_from_email" id="smtp_from_email" value="<?php echo esc_attr($smtp_from_email); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="smtp_from_name">From Name</label></th>
                        <td><input type="text" name="smtp_from_name" id="smtp_from_name" value="<?php echo esc_attr($smtp_from_name); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="label"><label for="notification_email">Notification Email</label></th>
                        <td>
                            <input type="email" name="notification_email" id="notification_email" value="<?php echo esc_attr($notification_email); ?>" class="regular-text">
                            <p class="description">Contact form submissions will be sent to this email address</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card" style="max-width: 800px; margin-bottom: 20px;">
                <h2 style="margin-top: 0; padding-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 15px;">Test Email Configuration</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="label"><label for="test_email_address">Test Email Address</label></th>
                        <td>
                            <input type="email" name="test_email_address" id="test_email_address" placeholder="test@example.com" class="regular-text">
                            <p class="description">Send a test email to verify your SMTP configuration</p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="test_email" class="button button-secondary">Send Test Email</button></td>
                    </tr>
                </table>
            </div>

            <p class="submit">
                <button type="submit" name="save_email_settings" class="button button-primary button-hero">Save Email Settings</button>
            </p>
        </form>

        <script>
        jQuery(document).ready(function($) {
            // SMTP preset selector
            $('#smtp-preset').on('change', function() {
                var preset = $(this).val();
                if (preset) {
                    var config = JSON.parse(preset);
                    $('#smtp_host').val(config.host);
                    $('#smtp_port').val(config.port);
                    $('#smtp_encryption').val(config.encryption);
                }
            });
        });
        </script>

        <style>
            .card {
                background: #fff;
                border: 1px solid #ccd0d4;
                border-radius: 4px;
                padding: 20px;
                margin-top: 20px;
                box-shadow: 0 1px 1px rgba(0,0,0,.04);
            }
            .form-table th {
                width: 200px;
                padding: 15px 10px 15px 0;
            }
            .form-table td {
                padding: 15px 10px;
            }
        </style>
    </div>
    <?php
}
