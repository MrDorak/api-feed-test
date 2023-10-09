<?php

namespace App\Http\Controllers;

use App\Models\InstagramProfile;
use Dymantic\InstagramFeed\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class InstagramAuthController extends BaseController
{

    // using the https://laravelpackages.net/ralphmorris/laravel-instagram-feed library

    public function index() {
        $feed = Profile::for('dorian')->feed();

        return view('lib-instagram-feed-page', compact('feed'));
    }

    public function get() {
        $profile = Profile::where('username', 'dorian')->first();
        return redirect($profile->getInstagramAuthUrl());
    }

    public function complete() {
        return redirect()->route('lib.index');
    }




    //basic display Instagram API without using any library

    public function indexRaw(InstagramProfile $profile) {
        // use cache if it exists
        if (Cache::has($profile->cacheKey())) {
            $feed = collect(Cache::get($profile->cacheKey()));

            return view('raw-instagram-feed-page', [ 'feed' => $feed->take(10), 'feed_length' => $feed->count(), 'profile_id' => $profile->id ]);
        }

        // fetch data using the instagram api
        $feed = Http::get("https://graph.instagram.com/$profile->user_id/media", [
            "fields" => "caption,id,media_type,media_url,thumbnail_url,permalink,children{media_type,media_url},timestamp",
            "access_token" => $profile->access_token
        ])->collect('data');

        Cache::forever($profile->cacheKey(), $feed);

        return view('raw-instagram-feed-page', [ 'feed' => $feed->take(10), 'feed_length' => $feed->count(), 'profile_id' => $profile->id ]);
    }

    /*
     * Call the Instagram API and return the length of the data
     * */
    public function refreshRaw(InstagramProfile $profile) {
        // fetch data using the instagram api
        $feed = Http::get("https://graph.instagram.com/$profile->user_id/media", [
            "fields" => "caption,id,media_type,media_url,thumbnail_url,permalink,children{media_type,media_url},timestamp",
            "access_token" => $profile->access_token
        ])->collect('data');
        //$feed = collect();

        Cache::forget($profile->cacheKey());
        Cache::forever($profile->cacheKey(), $feed);

        return response()->json([ "feed_length" => $feed->count() ]);
    }

    /*
     * Authorize the app and authenticate the user
     * */
    public function getCodeRaw() {
        $client_id = config('instagram-feed.client_id');
        $redirect = (app()->isLocal() ? 'https://localhost' : '') . route('raw.callback', [], !app()->isLocal());

        return redirect("https://api.instagram.com/oauth/authorize?client_id=$client_id&redirect_uri=$redirect&scope=user_profile,user_media&response_type=code");
    }

    /*
     * Get an access token (60 days) and create a user in our db
     * */
    public function callbackRaw(Request $request) {
        $response = Http::asForm()->post("https://api.instagram.com/oauth/access_token", [
            'client_id' => config('instagram-feed.client_id'),
            'client_secret' => config('instagram-feed.client_secret'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => (app()->isLocal() ? 'https://localhost' : '') . route('raw.callback', [], !app()->isLocal()),
            'code' => $request->get('code')
        ])->json();

        $user_details = Http::get("https://graph.instagram.com/{$response["user_id"]}", [
            "fields" => "id,username",
            "access_token" => $response["access_token"],
        ])->json();

        $profile = InstagramProfile::updateOrCreate(
            [ 'username' => $user_details["username"], 'user_id' => $response["user_id"], ],
            [ 'access_token' => $response["access_token"], ]
        );

        return redirect()->route('raw.index', compact('profile'));
    }
}
