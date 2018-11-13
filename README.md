# Demir Config

## Introduction
Tiny configuration management in PHP

## Features
* Tiny size
* Simple getter and setter methods
* Array dot notation
* Helper function

## Installation
```bash
$ composer require yidemir/config
```

## Test
```bash
composer test
```

## Usage
```php
use Demir\Config\Config;

$config = [
  'foo' => 'bar',
  'app' => [
    'name' => 'baz'
  ]
];

new Config($config);

// getter
$foo = Config::get('foo'); // bar
$name = Config::get('app.name'); // baz

// setter
Config::set('foo', 'qux');
Config::set('app.name', 'mux');

// helper
config(['app.name' => 'data']); // setter
config('app.name'); // getter, result: data
```
