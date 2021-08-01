# PHP ScoreSaber API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A Simple PHP library to interact with ScoreSaber's API

## Install

Via Composer

``` bash
$ composer require krikrixs/php-scoresaber-api
```

## Usage

``` php
// Create the object
$ScoreSaberAPI = new ScoreSaberAPI("ApplicationName");

// Functions
// $sortBy values: 0 = Trending (Doesn't seems to work) | 1 = Ranked date | 2 = Numbers of scores set | 3 = Star rating | 4 = Author
$ScoreSaberAPI->getMaps((bool)$rankedOnly, (int)$sortBy, (int)$limit, not required (string)$mapName);   // Get Map
$ScoreSaberAPI->getGlobalLeaderboards((int)$page);                                                      // Get Global Leaderboards
$ScoreSaberAPI->getPlayerInfos((string)$playerId, (bool)$wantFullInfo);                                 // Get basic or full player's infos
$ScoreSaberAPI->getPlayerScores((string)$playerId, (bool)$wantTopScores, (int)$page);                   // Get recent or top player's scores
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please contact me on discord [OMDN | Krixs#1106](https://discordapp.com/users/220151545486901248) or by email [kylian.barusseau@omedan.com](mailto:kylian.barusseau@omedan.com) instead of using the issue tracker.

## Credits

- [Kylian "Krixs" BARUSSEAU][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/krikrixs/php-scoresaber-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/krikrixs/php-scoresaber-api.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/krikrixs/php-scoresaber-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/krikrixs/php-scoresaber-api
[link-code-quality]: https://scrutinizer-ci.com/g/krikrixs/php-scoresaber-api
[link-downloads]: https://packagist.org/packages/krikrixs/php-scoresaber-api
[link-author]: https://github.com/KriKrixs
