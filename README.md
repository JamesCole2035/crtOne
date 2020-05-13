задание не выполнил, ошибки ERROR: Version in ".\docker-compose.yml" is unsupported. You might be seeing this error because you're using the wrong Compose file version. Either specify a supported version ("2.0", "2.1", "3.0") and place your service definitions under the `services` key, or omit the `version` key and place your service definitions at the root of the file to use version 1.
For more on the Compose file format versions, see https://docs.docker.com/compose/compose-file/
#поправил версию на 3.0, вроде заработало, но выпадает ошибка
Step 1/14 : FROM composer:latest as composer
ERROR: Service 'app' failed to build: Error parsing reference: "composer:latest as composer" is not a valid repository/tag: invalid reference format
