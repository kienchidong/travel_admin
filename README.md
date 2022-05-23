Project Travel: admin site
===============================
Author
------------------
```
Email: kienchidong@gmail.com
Phone: 0392123325
```

Install composer
------------------
Linux
```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```
Windown: Download https://getcomposer.org/Composer-Setup.exe

Init project
------------------

install vendor
```
composer create
---or---
composer update
---or---
composer install
```

install node_module
```
npm install
---or---
npm update
```

convert constant
```
php artisan constants:convert
```

convert i18n
```
php artisan vue-i18n:generate
```

create database
```
php artisan migrate --seed
```

start project
------------------

run serve
```
php artisan serve
```

run node
```
npm run watch
---or---
npm run dev
---or---
npm run prod
```


run admin
```
http://127.0.0.1:8000/admin

tk:
email: admin@admin.com
mk: admin
```
