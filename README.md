# codeception_qrcode

## Installation 
Use [Composer](https://getcomposer.org/):
```
composer require vietcode/codeception-qrcode
```
### Usage (`acceptance.suite.yml`)
 ```Only run by src attribute```
     modules:
        enabled: [QrCode]

```
$i->seeQrCode(<cssSelector|xPath>, <assertText>);
```
### Example 
```
<img src='qrcodeimage.jpg' id="#qrcode" />
$i->seeQrCode("#qrcode", "Codeception Test");
```
## Requirements 
* PHP >= 5.3
