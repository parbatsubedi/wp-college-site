<?php
/**
 * SMTP Configuration for WordPress
 * Configures wp_mail to use SMTP settings for reliable email delivery
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Configure PHPMailer to use SMTP when enabled
 */
function fusion_college_smtp_mailer($phpmailer) {
    $smtp_enabled = get_option('fusion_smtp_enabled', '0');
    
    // If SMTP is not enabled, use default WordPress mail
    if ($smtp_enabled !== '1') {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host = get_option('fusion_smtp_host', 'smtp.gmail.com');
    $phpmailer->Port = get_option('fusion_smtp_port', '587');
    
    $encryption = get_option('fusion_smtp_encryption', 'tls');
    if ($encryption === 'tls') {
        $phpmailer->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    } elseif ($encryption === 'ssl') {
        $phpmailer->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    } else {
        $phpmailer->SMTPSecure = '';
        $phpmailer->SMTPAutoTLS = false;
    }
    
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = get_option('fusion_smtp_username', '');
    $phpmailer->Password = get_option('fusion_smtp_password', '');
    
    // Set from address
    $from_email = get_option('fusion_smtp_from_email', get_option('admin_email'));
    $from_name = get_option('fusion_smtp_from_name', get_bloginfo('name'));
    $phpmailer->setFrom($from_email, $from_name);
    
    // Enable SMTP debugging if WP_DEBUG is on
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $phpmailer->SMTPDebug = 0; // Set to 1 or 2 for debugging
    }
}
add_action('phpmailer_init', 'fusion_college_smtp_mailer');

/**
 * Set default from email for all WordPress emails
 */
function fusion_college_set_from_email($original_email_address) {
    $from_email = get_option('fusion_smtp_from_email', $original_email_address);
    if (empty($from_email)) {
        $from_email = $original_email_address;
    }
    return $from_email;
}
add_filter('wp_mail_from', 'fusion_college_set_from_email');

/**
 * Set default from name for all WordPress emails
 */
function fusion_college_set_from_name($original_name) {
    $from_name = get_option('fusion_smtp_from_name', $original_name);
    if (empty($from_name)) {
        $from_name = $original_name;
    }
    return $from_name;
}
add_filter('wp_mail_from_name', 'fusion_college_set_from_name');
