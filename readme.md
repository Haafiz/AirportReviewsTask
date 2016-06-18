# Airport Review Task

A small API that provides JSON data via HTTP to be consumed by a frontend-app or other services.

It use Laravel 5.2 framework and utilize CodeCeption for doing API testing. This repository can be used for learning purpose but it is intended to be utilized by only people who have rest of parts of this API.

## Assumption
It is assumed that before using this code, you already have Database for this ready.

## Installation
Simply Download, setup configurations in .env file and run `composer update`

## Testing
For testing purpose, only API tests are available at this time, as this API do nothing but have three API endpoints.

API tests are being written using CodeCeption. So to run those tests, you need to install CodeCeption first. In case you need more basic level help with CodeCeption and its installation, find it here on: [My Blog Post on Getting started with Code Ception](http://haafiz.me/development/api-testing-installing-and-using-codeception)

Or can consul [CodeCeption documentation](http://codeception.com/quickstart)

## Usage
To Run API endpoints you need to run:
http://your/server/path/public/index.php/{API_ENDPOINT}
You can skip index.php if you have mod_rewrite working on apache.

## API Endpoints
Here are available endpoints, and all of them are accessible through HTTP method GET

###/api/all/stats
