<?php
session_start();

$captcha_code = '';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= rand(0, 9);
}

$_SESSION['custom_captcha'] = $captcha_code;

$width = 220;
$height = 60;
$image = imagecreatetruecolor($width, $height);

$bg_color   = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 40, 40, 40);
$noise_col  = imagecolorallocate($image, 80, 80, 80);

imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

for ($i = 0; $i < 120; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_col);
    if ($i % 10 == 0) {
        imagefilledellipse($image, rand(0, $width), rand(0, $height), rand(2, 4), rand(2, 4), $noise_col);
    }
}

for ($i = 0; $i < 2; $i++) {
    imageline($image, rand(0, 30), rand(15, 45), rand($width - 30, $width), rand(15, 45), $noise_col);
}

$font_size = 5;
$x = 20;
for ($i = 0; $i < strlen($captcha_code); $i++) {
    $y = rand(15, 25);
    imagechar($image, $font_size, $x, $y, $captcha_code[$i], $text_color);
    $x += 32;
}

header('Content-Type: image/png');
header('Cache-Control: no-cache, must-revalidate');
imagepng($image);
imagedestroy($image);