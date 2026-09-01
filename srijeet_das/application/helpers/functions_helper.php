<?php
defined('BASEPATH') or exit('No direct script access allowed');

function convertSeconds($seconds)
{
    $hours = floor($seconds / 3600);
    $remainingSeconds = $seconds % 3600;
    $minutes = floor($remainingSeconds / 60);
    $finalSeconds = $remainingSeconds % 60;

    return [
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $finalSeconds
    ];
}

function convertMinutesIntoHours($minutes){
	$hours = number_format(round(($minutes /60),2),2,".","");
	//$hours = str_pad(round(($minutes /60),2),2,"0",STR_PAD_LEFT);
	//$hours = str_pad(floor($minutes /60),2,"0",STR_PAD_LEFT);
	$minutes  = str_pad($minutes %60,2,"0",STR_PAD_LEFT);
	//return $hours." Hour[s] ".$minutes." Min[s]";
	//return $hours." : ".$minutes;
	return $hours;
}

function formatNumber($number) {
    return sprintf("%02d", $number);
}

function encrypt($password)
{
	$CI =& get_instance();
	$key=mb_convert_encoding($CI->config->item('key'), 'UTF-8');
	$iv =mb_convert_encoding($CI->config->item('iv'), 'UTF-8');
	
	try
	{
		$plaintext = mb_convert_encoding($password, 'UTF-8');
		$ciphertext = openssl_encrypt($plaintext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
		$encryptedText = base64_encode($ciphertext);
		return $encryptedText;
	}
	catch (Exception $ex)
	{
		return $ex->getMessage();
	}
}

function decrypt($encryptedData)
{
    $CI =& get_instance();
	$key=mb_convert_encoding($CI->config->item('key'), 'UTF-8');
	$iv =mb_convert_encoding($CI->config->item('iv'), 'UTF-8');

    try
	{
		$decryptedData = openssl_decrypt(base64_decode($encryptedData), 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
	}
	catch (Exception $ex)
	{
		return $ex->getMessage();
	}
    return $decryptedData;
}

function isWebView()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'EHSWebView/1.0') !== false) {
        return true;
    } else {
        return false;
    }
}

function bytes_to_mb($bytes, $decimals = 2) 
{
    return number_format($bytes / 1048576, $decimals);
}

function resize_image($filePath)
{
	$CI =& get_instance();
	$CI->load->library('image_lib');

	$config['image_library']  = 'gd2';
	$config['source_image']   = $filePath;
	$config['maintain_ratio'] = TRUE;
	$config['width']          = 400; // Resize width to 400px
	//$config['height']         = 400; // Auto adjust height

	$CI->image_lib->initialize($config);

	if (!$CI->image_lib->resize()) 
	{
		return $CI->image_lib->display_errors();
	} 
	else 
	{
		return true;
	}

	$CI->image_lib->clear();
}

function create_template_image($Image, $qrContent, $uidText)
{
	include APPPATH."third_party/phpqrcode.php";
	$baseImage = imagecreatefromjpeg($Image);

	ob_start();
	QRcode::png($qrContent, null, QR_ECLEVEL_H, 5); // No file path — generate to output buffer
	$qrImageData = ob_get_clean();

	// Create image resource from QR PNG data
	$qrImage = imagecreatefromstring($qrImageData);

	$qrTargetWidth = 200;
	$qrTargetHeight = 200;
	$resizedQR = imagecreatetruecolor($qrTargetWidth, $qrTargetHeight);
	imagecopyresampled($resizedQR, $qrImage, 0, 0, 0, 0, $qrTargetWidth, $qrTargetHeight, imagesx($qrImage), imagesy($qrImage));

	// Merge QR code into base image at desired location
	$qrX = 1000;  // X position
	$qrY = 191; // Y position
	imagecopy($baseImage, $resizedQR, $qrX, $qrY, 0, 0, $qrTargetWidth, $qrTargetHeight);

	// Add UID text (centered in right box)
	$fontPath = FCPATH.'assets/font/ARIALBD.TTF'; // Must be a valid TTF font
	//$uidText = $data['result']['survey_code'];
	$textColor = imagecolorallocate($baseImage, 0, 0, 0);
	$fontSize = 36;

	// UID box position
	$boxX = 225; // without pre-printed AS- it was 125
	$boxY = 473;
	$boxWidth = 750;
	$boxHeight = 100;

	// Calculate text size and position
	$bbox = imagettfbbox($fontSize, 0, $fontPath, $uidText);
	$textWidth = abs($bbox[4] - $bbox[0]);
	$textHeight = abs($bbox[5] - $bbox[1]);
	$textX = $boxX + ($boxWidth - $textWidth) / 2;
	$textY = $boxY + ($boxHeight + $textHeight) / 2;

	// Add text
	imagettftext($baseImage, $fontSize, 0, $textX, $textY, $textColor, $fontPath, $uidText);

	// Output the image directly to browser
	ob_start();
	imagejpeg($baseImage);
	$jpegData = ob_get_clean();

	// Cleanup
	imagedestroy($baseImage);
	imagedestroy($qrImage);
	imagedestroy($resizedQR);
	
	return base64_encode($jpegData);
}

function create_idcard_qrcode($Image, $qrContent, $uidText)
{
	include APPPATH."third_party/phpqrcode.php";
	
}
