# TODO app

LIVE URL : http://robinsaar.eu/TODOapp/public/index/index

## Info
This app is made for a school project. It's full of holes and is very unsafe.
It is used for collecting dummy data.

## Setup

 - git clone  <`*repository name*`>
 - set up database (see below for details)
 - set database credentials on <`config/configuration.php`>
 - go to localhost/ <`app name`> /public/index/index


## Database setup

- Table countries

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `countryCode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `countryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

- Table tasks

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `taskName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createDate` date NOT NULL,
  `dueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

- Table users

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


## Structure
* bin - executable scripts
* config - configuration files
* tmp - temporary files
* library - plugin classes
* public - publicly available files
