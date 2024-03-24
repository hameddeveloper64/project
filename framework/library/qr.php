<?php
namespace Magnet\App\Library;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Qr {
    private $options;

    public function __construct() {
        $this->options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'imageBase64' => true,
            'imageTransparent' => false,
			'bgColor' => [107, 30, 38]
        ]);
    }

    public function setOption($option, $value) {
        $this->options->{$option} = $value;
    }

    public function render($data) {
        $qrcode = new QRCode($this->options);
        return $qrcode->render($data);
    }
}

?>