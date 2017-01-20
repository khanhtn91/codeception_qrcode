# codeception_qrcode

## Installation 
Use [Composer](https://getcomposer.org/):
```
composer require vietcode/codeception-qrcode
```
### Usage
```Only run by src attribute```
### Example (`acceptance.suite.yml`)
 
     modules:
        enabled: [QrCode]

```
$i->seeQrCode(<cssSelector|xPath>, <assertText>);
```
## Requirements 
* PHP >= 5.3
