<?php

require __DIR__ . '/../vendor/autoload.php';

use Hbgl\Barcode\Code128Encoder;

$content = 'ABC123456DEF';
$encoded = Code128Encoder::encode($content);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Code 128</title>
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128&display=swap" rel="stylesheet">
        <style>
            body {
                text-align: center;
            }
            .code128 {
                padding: 3rem 1.5rem 0 1.5rem;
                font-family: "Libre Barcode 128";
                font-size: 3rem;
                transform: scaleY(1.5);
            }
        </style>
    </head>
    <body>
        <div class="code128"><?= htmlspecialchars($encoded) ?></div>
        <div><?= htmlspecialchars($content) ?></div>
    </body>
</html>