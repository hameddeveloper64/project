<?php


if(file_exists("config.php"))
	require_once('config.php');


require_once(DIR_SYSTEM . "/bootstarp.php");


//$qr = new \chillerlan\QRCode\QRCode();
//$data = 'http://www.ehsanweb.com';
//echo '<img src="'.$qr->render($data).'" alt="QR Code" / width="250" height="250">';

$qr = new \Magnet\App\Library\Qr();
$qr->setOption('imageBase64', true);
?><img src="<?php echo $qr->render("hiWEB AND Ehsanweb"); ?>" width="50" height="50"><?php


