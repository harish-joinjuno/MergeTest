<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id'                   => env('GOOGLE_CLIENT_ID'),
        'project_id'                  => env('GOOGLE_APP_ID'),
        'auth_uri'                    => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri'                   => 'https://accounts.google.com/o/oauth2/token',
        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
        'client_secret'               => env('GOOGLE_CLIENT_SECRET'),
        'redirect'                    => env('GOOGLE_REDIRECT'),
        'redirect_uris'               => [env('GOOGLE_REDIRECT')],
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => env('FACEBOOK_REDIRECT'),

        'access_token'         => env('FACEBOOK_ACCESS_TOKEN'),
        'app_id'               => env('FACEBOOK_APP_ID'),
        'system_user_id'       => env('FACEBOOK_SYSTEM_USER_ID'),
        'pixel_id'             => env('FACEBOOK_PIXEL_ID'),
        'lead_client_secret'   => env('FACEBOOK_LEAD_CLIENT_SECRET'),
        'page_ll_access_token' => env('FACEBOOK_PAGE_LONG_LIVE_ACCESS_TOKEN'),
    ],

    'doximity' => [
        'auth_url'             => env('DOXIMITY_AUTH_URL'),
        'token_url'            => env('DOXIMITY_TOKEN_URL'),
        'client_id'            => env('DOXIMITY_CLIENT_ID'),
        'client_secret'        => env('DOXIMITY_CLIENT_SECRET'),
        'redirect'             => env('DOXIMITY_REDIRECT_URL'),
        'jwt_token_verify_url' => env('DOXIMITY_JWT_TOKEN_VERIFY_URL'),
    ],

    'envoyer' => [
        'horizon_snapshot'             => env('ENVOYER_HORIZON_SNAPSHOT'),
        'prune_stale_nova_attachments' => env('ENVOYER_PRUNE_STALE_NOVA_ATTACHMENTS'),
    ],

    'google_tag_manager' => [
        'disable_tag_manager' => env('DISABLE_GOOGLE_TAG_MANAGER', false),
    ],

    'checkbook_io' => [
        'base_uri'  => env('CHECKBOOK_IO_URI'),
        'client_id' => env('CHECKBOOK_IO_CLIENT_ID'),
        'key'       => env('CHECKBOOK_IO_API_KEY'),
        'secret'    => env('CHECKBOOK_IO_API_SECRET'),
    ],

    'slack' => [
        'webhook_url'                      => env('SLACK_WEBHOOK_URL'),
        'leveredge_reward_claim_url'       => env('SLACK_LEVEREDGE_REWARD_CLAIM_URL'),
        'screenshot_reward_claim_url'      => env('SLACK_SCREENSHOT_CLAIM_URL'),
        'experiments_webhook_url'          => env('SLACK_EXPERIMENTS_CHANNEL'),
        '404_with_referrers'               => env('SLACK_404_REFERRERS'),
        'question_flow_error_notification' => env('SLACK_QUESTION_FLOW_ERROR_NOTIFICATION'),
        'ready_to_pay'                     => env('SLACK_READY_TO_PAY_NOTIFICATION'),
        'new_facebook_lead_url'            => env('SLACK_NEW_FACEBOOK_LEAD_NOTIFICATION'),
    ],

    'mailchimp' => [
        'api_key'                                => env('MAILCHIMP_API_KEY'),
        'default_list_id'                        => env('MAILCHIMP_DEFAULT_LIST_ID'),
        'gmass_list_id'                          => env('MAILCHIMP_GMASS_LIST_ID'),
        'kick_off_labs_list_id'                  => env('MAILCHIMP_KICK_OFF_LABS_LIST_ID'),
        'scholarships_app_list_id'               => env('MAILCHIMP_SCHOLARSHIP_APP_LIST_ID'),
        'removable_tags_regex'                   => env('MAILCHIMP_REMOVABLE_TAGS_REGEX'),
        'customer_list_id'                       => env('MAILCHIMP_CUSTOMER_LIST_ID'),
        'marketing_list_id'                      => env('MAILCHIMP_MARKETING_LIST_ID'),
        'server_prefix'                          => env('MAILCHIMP_SERVER_PREFIX'),
    ],

    'twilio' => [
        'sid'              => env('TWILIO_SID'),
        'token'            => env('TWILIO_TOKEN'),
        'phone_number'     => env('TWILIO_PHONE_NUMBER'),
        'phone_number_sid' => env('TWILIO_PHONE_NUMBER_SID'),
    ],

    'bold' => [
        'secret_key'      => env('BOLD_SECRET_KEY', 'bold_org_secret_key_value'),
        'secret_key_name' => env('BOLD_SECRET_KEY_NAME', 'bold_org_secret_key'),
        'host'            => env('BOLD_HOST', 'prodbe.bold.org'),
        'bold_ping_url'   => env('BOLD_HTTP_PING_URL', 'devbe.bold.org/api/v1/affiliate/register'),
    ],

    'hubspot' => [
        'api_key' => env('HUBSPOT_API_KEY'),
    ],

    'helpscout' => [
        'app_id'     => env('HELPSCOUT_APP_ID'),
        'app_secret' => env('HELPSCOUT_APP_SECRET'),
        'mailbox_id' => env('HELPSCOUT_MAILBOX_ID'),
        'signature'  => env('HELPSCOUT_SIGNATURE'),
    ],

    'aws_gift_card' => [
        'endpoint'   => env('GIFT_CARD_ENDPOINT'),
        'access_key' => env('GIFT_CARD_ACCESS_KEY'),
        'secret_key' => env('GIFT_CARD_SECRET_KEY'),
        'partner_id' => env('GIFT_CARD_PARTNER_ID'),
    ],

    'google_analytics' => [
        'tracking_id' => env('GA_TRACKING_ID'),
    ],

    'mailcoach_email' => [
        'url'                     => env('MAILCOACH_BASE_URL'),
        'scholarship_list_id'     => env('MAILCOACH_SCHOLARSHIP_LIST_ID'),
        'federal_tracker_list_id' => env('MAILCOACH_FEDERAL_TRACKER_LIST_ID'),
        'robo_refi_list_id'       => env('MAILCOACH_ROBO_REFI_LIST_ID'),
        'token'                   => env('MAILCOACH_TOKEN'),
    ],

    'socially_powered' => [
        'base_url' => env('SOCIALLY_POWERED_BASE_URL', 'https://sociallypowered.org'),
    ],

];
