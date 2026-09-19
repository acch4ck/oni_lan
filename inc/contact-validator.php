<?php
/**
 * Contact form validation for Oni Lana.
 * Loaded from functions.php.
 */
if ( ! defined('ABSPATH') ) exit;

function oni_lana_validate_contact_submission($raw) {
    $result = array('success'=>false,'errors'=>array(),'values'=>array(
        'name'=>'','email'=>'','subject'=>'','message'=>''
    ));

    if (!is_array($raw)) {
        $result['errors'][] = 'Invalid form submission.';
        return $result;
    }

    if (!isset($raw['ol_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($raw['ol_contact_nonce'])), 'ol_contact_form')) {
        $result['errors'][] = 'Security verification failed. Please refresh the page and try again.';
        return $result;
    }

    // Honeypot: real users should never fill this hidden field.
    if (!empty($raw['ol_website'])) {
        $result['errors'][] = 'Spam verification failed.';
        return $result;
    }

    $name = sanitize_text_field(wp_unslash($raw['ol_name'] ?? ''));
    $email = sanitize_email(wp_unslash($raw['ol_email'] ?? ''));
    $subject = sanitize_text_field(wp_unslash($raw['ol_subject'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($raw['ol_message'] ?? ''));

    $result['values'] = compact('name','email','subject','message');

    if ($name === '' || !preg_match('/^[\p{L}\p{M}\s.\-\']{2,100}$/u', $name)) {
        $result['errors'][] = 'Please enter a valid name (2–100 characters).';
    }
    if (!$email || !is_email($email) || strlen($email) > 160) {
        $result['errors'][] = 'Please enter a valid email address.';
    }
    if (strlen($subject) > 180) {
        $result['errors'][] = 'Subject must be 180 characters or fewer.';
    }
    if ($message === '' || strlen($message) < 10) {
        $result['errors'][] = 'Message must contain at least 10 characters.';
    }
    if (strlen($message) > 5000) {
        $result['errors'][] = 'Message must be 5,000 characters or fewer.';
    }

    $result['success'] = empty($result['errors']);
    return $result;
}
