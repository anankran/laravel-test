# Laravel Test

Test using Laravel to list the closest locations to a specif place (longitude and latitude), using the great circle distance formula[https://en.wikipedia.org/wiki/Great-circle_distance].

Run Laravel:
```
php artisan serve
```

If you want to test with other parameters, change the variables `Affiliates.defaultLatitude` and `Affiliates.defaultLongitude`. The values used to compare are in `storage/app/affiliates.txt`.

You can check the result on `localhost:8000`, there's a simples Bootstrap[https://getbootstrap.com/] front-end.
