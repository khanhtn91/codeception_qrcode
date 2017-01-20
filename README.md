# codeception_qrcode

## Installation 
Use [Composer](https://getcomposer.org/):
```
composer require khanhtn/qrcode
```
### Example (`unit.suite.yml`)
 
     modules:
        enabled: [QrCode]

```
$i->seeQrCode('#contents-area-id > div > img.url', 'code');
```
## Requirements 
* PHP >= 5.3
