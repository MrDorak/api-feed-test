<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### SETUP
./vendor/bin/sail up -d

./vendor/bin/sail migrate

./vendor/bin/sail yarn install

./vendor/bin/sail yarn dev

// to refresh the feed using the library
./vendor/bin/sail artisan schedule:run 
