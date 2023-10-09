<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Setup
./vendor/bin/sail up -d

./vendor/bin/sail migrate

./vendor/bin/sail yarn install

./vendor/bin/sail yarn dev

// to refresh the feed using the library
./vendor/bin/sail artisan schedule:run 

### Getting started
You need a Meta Developer account and to create an Instagram App. https://developers.facebook.com/docs/instagram-basic-display-api/getting-started (nb: the doc is slightly out of date and doesn't include the changes made from Facebook to Meta) 

Then replace the INSTAGRAM_CLIENT_ID and INSTAGRAM_CLIENT_SECRET in your `.env`
