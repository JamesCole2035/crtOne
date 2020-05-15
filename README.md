задание не выполнил, ошибки ERROR: Version in ".\docker-compose.yml" is unsupported. You might be seeing this error because you're using the wrong Compose file version. Either specify a supported version ("2.0", "2.1", "3.0") and place your service definitions under the `services` key, or omit the `version` key and place your service definitions at the root of the file to use version 1.
For more on the Compose file format versions, see https://docs.docker.com/compose/compose-file/
#поправил версию на 3.0, вроде заработало, но выпадает ошибка
Step 1/14 : FROM composer:latest as composer
ERROR: Service 'app' failed to build: Error parsing reference: "composer:latest as composer" is not a valid repository/tag: invalid reference format

UPDATE
User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ export DUID=1234

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ export DGID="frontend"

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker-compose build
Building app
Step 1/14 : FROM composer:latest as composer
 ---> 79d01906a618
Step 2/14 : FROM php:7.4.5-fpm-alpine3.11 as php
 ---> 7b0b3bc485ba
Step 3/14 : COPY --from=composer /usr/bin/composer /usr/local/bin/composer
 ---> Using cache
 ---> cb3cb856e619
Step 4/14 : ENV COMPOSER_ALLOW_SUPERUSER=1
 ---> Using cache
 ---> 3646ac85c7d7
Step 5/14 : ENV COMPOSER_MEMORY_LIMIT=-1
 ---> Using cache
 ---> 6a74e9c2b83c
Step 6/14 : ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php
 ---> Using cache
 ---> bdba651a57be
Step 7/14 : ARG UID
 ---> Using cache
 ---> 77e85a806021
Step 8/14 : ARG GID
 ---> Using cache
 ---> 3a01a8e777e2
Step 9/14 : ENV APP_TARGET_UID ${UID:-1000}
 ---> Running in de35ea950d73
Removing intermediate container de35ea950d73
 ---> 7230ef7e9915
Step 10/14 : ENV APP_TARGET_GID ${GID:-1000}
 ---> Running in 5540c681afd6
Removing intermediate container 5540c681afd6
 ---> f013eda76e4b
Step 11/14 : RUN apk --no-cache add shadow &&     usermod -u ${APP_TARGET_UID} www-data
 ---> Running in deb54c22a3c4
fetch http://dl-cdn.alpinelinux.org/alpine/v3.11/main/x86_64/APKINDEX.tar.gz
fetch http://dl-cdn.alpinelinux.org/alpine/v3.11/community/x86_64/APKINDEX.tar.gz
(1/2) Installing linux-pam (1.3.1-r1)
(2/2) Installing shadow (4.7-r1)
Executing busybox-1.31.1-r9.trigger
OK: 15 MiB in 33 packages
Removing intermediate container deb54c22a3c4
 ---> 4290c14a9166
Step 12/14 : USER www-data:www-data
 ---> Running in a3d1ffecac62
Removing intermediate container a3d1ffecac62
 ---> fc815fa71890
Step 13/14 : COPY --chown=www-data . /var/www/app
 ---> 71df89dcf719
Step 14/14 : WORKDIR /var/www/app
 ---> Running in 679a1c98e6c8
Removing intermediate container 679a1c98e6c8
 ---> 1a19146551ec
Successfully built 1a19146551ec
Successfully tagged crtone_app:latest
Building web
Step 1/5 : FROM nginx:alpine
 ---> 89ec9da68213
Step 2/5 : COPY ./docker/nginx/example.conf /etc/nginx/conf.d/default.conf
 ---> 622bccbdf963
Step 3/5 : COPY . /var/www/app
 ---> d9f0e3248ad3
Step 4/5 : ENV NGINX_HOST=docker-class.localhost
 ---> Running in a77fefacf0e8
Removing intermediate container a77fefacf0e8
 ---> 920ee40a7555
Step 5/5 : WORKDIR /var/www/app
 ---> Running in 33695d4763a6
Removing intermediate container 33695d4763a6
 ---> bf4a3e0b58dd
Successfully built bf4a3e0b58dd
Successfully tagged crtone_web:latest

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker images
REPOSITORY          TAG                    IMAGE ID            CREATED             SIZE
crtone_web          latest                 bf4a3e0b58dd        17 seconds ago      20.1MB
crtone_app          latest                 1a19146551ec        23 seconds ago      86MB
<none>              <none>                 671277640767        2 minutes ago       83.4MB
composer            latest                 79d01906a618        8 days ago          179MB
php                 7.4.5-fpm-alpine3.11   7b0b3bc485ba        8 days ago          81.4MB
nginx               alpine                 89ec9da68213        2 weeks ago         19.9MB
ubuntu              19.10                  1d654303ff59        3 weeks ago         73MB
nginx               latest                 602e111c06b6        3 weeks ago         127MB
hello-world         latest                 bf756fb1ae65        4 months ago        13.3kB

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker ps                                                                                                                                                                                           CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS               NAMES
2c402446f555        671277640767        "docker-php-entrypoi…"   3 minutes ago       Up 3 minutes        9000/tcp            blissful_elgamal
0338c8bee1ac        1a19146551ec        "docker-php-entrypoi…"   4 minutes ago       Up 4 minutes        9000/tcp            relaxed_darwin

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker exec 0338c8bee1ac composer install                                                                                                                                                           Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 42 installs, 0 updates, 0 removals
  - Installing symfony/polyfill-mbstring (v1.15.0): Downloading (100%)
  - Installing symfony/polyfill-php72 (v1.15.0): Downloading (100%)
  - Installing symfony/polyfill-intl-idn (v1.15.0): Downloading (100%)
  - Installing symfony/mime (v5.0.8): Downloading (100%)
  - Installing symfony/http-foundation (v5.0.8): Downloading (100%)
  - Installing symfony/polyfill-ctype (v1.15.0): Downloading (100%)
  - Installing symfony/inflector (v5.0.8): Downloading (100%)
  - Installing symfony/property-access (v5.0.8): Downloading (100%)
  - Installing symfony/property-info (v5.0.8): Downloading (100%)
  - Installing symfony/serializer (v5.0.8): Downloading (100%)
  - Installing twig/twig (v3.0.3): Downloading (100%)
  - Installing webmozart/assert (1.8.0): Downloading (100%)
  - Installing phpdocumentor/reflection-common (2.1.0): Downloading (100%)
  - Installing phpdocumentor/type-resolver (1.1.0): Downloading (100%)
  - Installing phpdocumentor/reflection-docblock (5.1.0): Downloading (100%)
  - Installing phpunit/php-token-stream (4.0.1): Downloading (100%)
  - Installing sebastian/version (3.0.0): Downloading (100%)
  - Installing sebastian/type (2.0.0): Downloading (100%)
  - Installing sebastian/resource-operations (3.0.0): Downloading (100%)
  - Installing sebastian/recursion-context (4.0.0): Downloading (100%)
  - Installing sebastian/object-reflector (2.0.0): Downloading (100%)
  - Installing sebastian/object-enumerator (4.0.0): Downloading (100%)
  - Installing sebastian/global-state (4.0.0): Downloading (100%)
  - Installing sebastian/exporter (4.0.0): Downloading (100%)
  - Installing sebastian/environment (5.1.0): Downloading (100%)
  - Installing sebastian/diff (4.0.1): Downloading (100%)
  - Installing sebastian/comparator (4.0.0): Downloading (100%)
  - Installing sebastian/code-unit (1.0.2): Downloading (100%)
  - Installing phpunit/php-timer (3.1.4): Downloading (100%)
  - Installing phpunit/php-text-template (2.0.0): Downloading (100%)
  - Installing phpunit/php-invoker (3.0.0): Downloading (100%)
  - Installing phpunit/php-file-iterator (3.0.1): Downloading (100%)
  - Installing theseer/tokenizer (1.1.3): Downloading (100%)
  - Installing sebastian/code-unit-reverse-lookup (2.0.0): Downloading (100%)
  - Installing phpunit/php-code-coverage (8.0.1): Downloading (100%)
  - Installing doctrine/instantiator (1.3.0): Downloading (100%)
  - Installing phpspec/prophecy (v1.10.3): Downloading (100%)
  - Installing phar-io/version (2.0.1): Downloading (100%)
  - Installing phar-io/manifest (1.0.3): Downloading (100%)
  - Installing myclabs/deep-copy (1.9.5): Downloading (100%)
  - Installing phpunit/phpunit (9.1.4): Downloading (100%)
  - Installing symfony/var-dumper (v5.0.8): Downloading (100%)
symfony/polyfill-intl-idn suggests installing ext-intl (For best performance)
symfony/property-access suggests installing psr/cache-implementation (To cache access methods.)
symfony/property-info suggests installing psr/cache-implementation (To cache results)
symfony/property-info suggests installing symfony/doctrine-bridge (To use Doctrine metadata)
symfony/serializer suggests installing doctrine/annotations (For using the annotation mapping. You will also need doctrine/cache.)
symfony/serializer suggests installing doctrine/cache (For using the default cached annotation reader and metadata cache.)
symfony/serializer suggests installing psr/cache-implementation (For using the metadata cache.)
symfony/serializer suggests installing symfony/config (For using the XML mapping loader.)
symfony/serializer suggests installing symfony/yaml (For using the default YAML mapping loader.)
sebastian/global-state suggests installing ext-uopz (*)
phpunit/php-invoker suggests installing ext-pcntl (*)
phpunit/php-code-coverage suggests installing ext-pcov (*)
phpunit/php-code-coverage suggests installing ext-xdebug (*)
phpunit/phpunit suggests installing ext-soap (*)
phpunit/phpunit suggests installing ext-xdebug (*)
symfony/var-dumper suggests installing ext-intl (To show region name in time zone dump)
symfony/var-dumper suggests installing symfony/console (To use the ServerDumpCommand and/or the bin/var-dump-server script)
Generating autoload files
18 packages you are using are looking for funding.
Use the `composer fund` command to find out more!

User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker exec 0338c8bee1ac vendor/bin/phpunit                                                                                                                                                         PHPUnit 9.1.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.4.5
Configuration: /var/www/app/phpunit.xml

.                                                                   1 / 1 (100%)

Time: 00:00.088, Memory: 6.00 MB

OK (1 test, 1 assertion)

Запуск
User@AndreaModaPC MINGW64 ~/Desktop/crtOne/crtOne (dev)
$ docker run -it -p 805:9000 1a19146551ec                                                                                                                                                             [15-May-2020 10:36:21] NOTICE: [pool www] 'user' directive is ignored when FPM is not running as root
[15-May-2020 10:36:21] NOTICE: [pool www] 'group' directive is ignored when FPM is not running as root
[15-May-2020 10:36:21] NOTICE: fpm is running, pid 1
[15-May-2020 10:36:21] NOTICE: ready to handle connections
^C[15-May-2020 10:38:51] NOTICE: Terminating ...
[15-May-2020 10:38:51] NOTICE: exiting, bye-bye!
Страница недоступна
Сайт localhost не отправил данных.
ERR_EMPTY_RESPONSE
