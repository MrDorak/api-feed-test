<?php

return [
    /*
     * The client_id from registering the app on Instagram
     */
    'client_id'           => env("INSTAGRAM_CLIENT_ID"),

    /*
     * The client secret from registering the app on Instagram
     */
    'client_secret'       => env("INSTAGRAM_CLIENT_SECRET"),

    /*
     * The base url used to generate to auth callback route for instagram.
     */
    'base_url' => 'https://localhost/',

    /*
     * The route that will respond to the Instagram callback during the OAuth process.
     */
    'auth_callback_route' => 'lib/instagram-auth/callback',

    /*
     * On success of the OAuth process you will be redirected to this route.
     */
    'success_redirect_to' => 'lib/instagram-auth/success',

    /*
     * If the OAuth process fails for some reason you will be redirected to this route.
     */
    'failure_redirect_to' => 'lib/instagram-auth/failure',

    'ignore_video' => false,

    'notify_on_error' => null,
];
