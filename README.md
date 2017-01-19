# codeception_qrcode

## Installation 
Use [Composer](https://getcomposer.org/):
```
composer require
```
### Example (`unit.suite.yml`)
 
     modules:
        enabled: [Mockery]

```
$i->seeQrCode('#contents-area-id > div > img.url', 'code');
```
## Requirements 
* PHP >= 5.3
