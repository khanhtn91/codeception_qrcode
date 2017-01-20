# codeception_qrcode

## Installation 
Use [Composer](https://getcomposer.org/):
```
composer require khanhtn/qrcode
```
### Example (`acceptance.suite.yml`)
 
     modules:
        enabled: [QrCode]

```
$i->seeQrCode('<cssSelector|xPath>', '<code>');
```
## Requirements 
* PHP >= 5.3
