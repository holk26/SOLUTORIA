# 1.  Iniciar el proyecto

# Configura la base de datos

importa el archivo `datos_financieros.sql en mysql`

edite el archivo `env a .env`

Edite de acuerdo a sus requerimiento

database.default.hostname = localhost <br>
atabase.default.database = datos_financieros<br>
database.default.username = root<br>
database.default.password = ''<br>
database.default.DBDriver = MySQLi<br>

ejecuta `php spark serve`

`http://localhost:8080/'`

![image](https://user-images.githubusercontent.com/23020718/226125811-d488b026-68f7-45d6-a862-f185d6a1ce71.png)

![image](https://user-images.githubusercontent.com/23020718/226124641-57233dbf-93d7-485a-b8b8-2c6f7b13b41e.png)

![image](https://user-images.githubusercontent.com/23020718/226075685-a105e97d-02f8-4766-9bf3-7d733c15550a.png)

![image](https://user-images.githubusercontent.com/23020718/226120724-da5ce167-ecc8-4808-bb0f-f0afc755d155.png)

![image](https://user-images.githubusercontent.com/23020718/226075761-f2c46291-5a6d-4316-8d4b-47882d6fbb09.png)

![image](https://user-images.githubusercontent.com/23020718/226075779-28935b0b-8009-451e-8d3e-83d77aa42e99.png)

![image](https://user-images.githubusercontent.com/23020718/226075793-219bea06-746c-4422-97ef-b1639adb5a90.png)

![image](https://user-images.githubusercontent.com/23020718/226075839-58b0f475-a2b1-40c4-bac8-7c58c06d6a6f.png)

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
