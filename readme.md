## Github issues

[![Build Status](https://travis-ci.org/luknei/github-issues.svg)](https://travis-ci.org/luknei/github-issues)

## Tools

* Backend - Laravel 5
* Testing
 * PHPUnit
 * AspectMock
* Frontend
 * AngularJS
 * jQuery
 * bootstrap
 * SASS
* Asset management
 * bower
 * Gulp
 * browserify

## Requirements

* \> php 5.5
* composer
* npm
* bower

## Setup

* git clone https://github.com/luknei/github-issues.git
* cd github-issues
* composer install
* bower install
* cd public
* php -S localhost:8000
* visit http://localhost:8000/
* navigate to http://localhost:8000/#/login
* or or http://localhost:8000/#/issues/{vendor}/{repo} e.g. http://localhost:8000/#/issues/luknei/github-issues

## Features

* Login/logout to github
* List repository issues (filter by state)
* Read issue and issue comments
* Update issue
* Close issue

## TODO

* display errors to end user
* write tests for front end
* write acceptance tests
* improve UI