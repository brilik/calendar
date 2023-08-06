# 🗓 Calendar

Display Calendar with adding events for popular frameworks (Bootstrap, TailWinds...).

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brilik/calendar.svg?style=flat-square)](https://packagist.org/packages/brilik/calendar)
[![Build Status](https://img.shields.io/travis/brilik/calendar/master.svg?style=flat-square)](https://travis-ci.org/brilik/calendar)
[![Quality Score](https://img.shields.io/scrutinizer/g/brilik/calendar.svg?style=flat-square)](https://scrutinizer-ci.com/g/brilik/calendar)
[![Total Downloads](https://img.shields.io/packagist/dt/brilik/calendar.svg?style=flat-square)](https://packagist.org/packages/brilik/calendar)

## Requirements

- PHP 7.3+

## Installation

You can install the package via composer:

```bash
composer require brilik/calendar
```

## How it works

```php
use VitoBryliano\Calendar\TailWindCalendar;
use VitoBryliano\Calendar\BootstrapCalendar;

// Get date in ISO format
$date = Carbon::now()->tz('Europe/Kiev')->format('Y-m-d');
// You can create calendar in the Bootstrap styles
$calendar = new BootstrapCalendar($date);
// Or you can create calendar in the TailWind styles
$calendar = new TailWindCalendar($date);
// You can add navigate for choose month
$calendar->navigation = true;
// You can add custom name months or their translations
$calendar->setWeekDaysName([
    __('Mon'),
    __('Tue'),
    __('Wed'),
    __('Thu'),
    __('Fri'),
    __('Sut'),
    __('Sun')
]);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
