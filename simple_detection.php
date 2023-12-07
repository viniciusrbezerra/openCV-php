<?php

declare(strict_types=1);

use CV\CascadeClassifier;
use CV\Point;
use CV\Scalar;
use function CV\imread;
use function CV\imwrite;
use function CV\circle;

$image = imread(__DIR__ . '/path/to/file');

$classifier = new CascadeClassifier();
$classifier->load(__DIR__.'/models/haarcascade_frontalface_alt.xml');

$classifier->detectMultiScale($image, $faces);

$red = new Scalar(0, 0, 255);
foreach ($faces as $face) {
    $radius = intval($face->width/2);
    $x = intval($face->x+$face->height/2);
    $y = intval($face->y+$radius);
    $point = new Point($x, $y);
    circle($image, $point, $radius, $red, 2);
}

imwrite(__DIR__ . '/output/face-detection.jpg', $image);

