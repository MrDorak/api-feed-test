<?php

namespace App\Http\Controllers;

use Dymantic\InstagramFeed\InstagramFeed;
use Dymantic\InstagramFeed\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class InstagramAuthController extends BaseController
{

    public function get() {
        $profile = Profile::where('username', 'dorian')->first();

        return view('instagram-auth-page', ['instagram_auth_url' => $profile->getInstagramAuthUrl()]);
    }

    public function complete(Request $request) {
        $feed = Profile::for('dorian')->feed();

        return view('instagram-feed-page', compact('feed'));
    }
}
