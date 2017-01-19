<?php
namespace Codeception\Module;

use Codeception\Module;
use Libern\QRCodeReader\QRCodeReader;

/**
 * Class QrCode
 * @package Codeception\Module
 */
class QrCode extends Module
{

    private $QRCodeReader;
    private $pathToQRCode;
    private $urlQRCode;
    private $base64QRCode;
    private $textQRCode;

    public function _initialize()
    {
        $this->QRCodeReader = new QRCodeReader();
        $this->pathToQRCode = 'tests/_data/acceptance/Qrcode/localfile.png';
    }

    /**
     * @param $url
     *
     * @author Khanh Tram
     */
    private function setUrlQRCode($url)
    {
        $this->urlQRCode = $url;
        if ($this->checkFileExists()) {
            $this->downloadImage();
        }
    }

    /**
     * @param $text
     *
     * @author Khanh Tram
     */
    private function setTextQRCode($text)
    {
        $this->textQRCode = $text;
    }

    /**
     * @author Khanh Tram
     */
    private function checkQRCode()
    {
        $qrcodeText = $this->QRCodeReader->decode($this->pathToQRCode);
        if ($this->textQRCode == $qrcodeText) {
            echo 'QR code right!';
        } else {
            echo 'QR code wrong!';
        }
        $this->delImage();
    }

    /**
     * @return bool
     * @author Khanh Tram
     */
    private function checkFileExists()
    {
        if (!@getimagesize($this->urlQRCode)) {
            echo "file not found!";

            return false;
        } else {
            return true;
        }
    }

    /**
     * @author Khanh Tram
     */
    private function downloadImage()
    {
        set_time_limit(0);
        $fp = fopen($this->pathToQRCode, 'w+');
        $ch = curl_init(str_replace(" ", "%20", $this->urlQRCode));
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    /**
     * @author Khanh Tram
     */
    private function delImage()
    {
        unlink($this->pathToQRCode);
    }

    /**
     * @param $code
     *
     * @author Khanh Tram
     */
    public function setBase64QRCode($code)
    {
        $this->base64QRCode = $code;
        $this->createImageBase64();
    }

    /**
     * @author Khanh Tram
     */
    private function createImageBase64()
    {
        $str = "data:image/png;base64,";
        $data = str_replace($str, "", $this->base64QRCode);
        $data = base64_decode($data);
        file_put_contents($this->pathToQRCode, $data);
    }

    /**
     * @param $cssSelector
     * @param $code
     *
     * @author Khanh Tram
     */
    public function seeQrCode($cssSelector, $code)
    {
        $webDriver = $this->getModule('WebDriver');
        $srcImage = $webDriver->grabAttributeFrom($cssSelector, 'src');
        if (strpos($srcImage, 'data:image') === false) {
            $this->setUrlQRCode($srcImage);
        } else {
            $this->setBase64QRCode($srcImage);
        }
        $this->setTextQRCode($code);
        $this->checkQRCode();
    }

}