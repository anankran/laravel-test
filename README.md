# Laravel Test

Test using Laravel to list the closest locations to a specif place (longitude and latitude), using the great circle distance formula[https://en.wikipedia.org/wiki/Great-circle_distance].

Run Laravel:
```
php artisan serve
```

Endpoint:
```
GET /affiliates
```

If you want to test other parameters, change the variables `Affiliates.defaultLatitude` and `Affiliates.defaultLongitude` on `app/Models/`. The values used to compare are in `storage/app/affiliates.txt`.
