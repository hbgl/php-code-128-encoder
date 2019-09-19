<?php

namespace Hbgl\Barcode;

use Hbgl\Barcode\Adapters\AdapterCode128;
use Hbgl\Barcode\Adapters\AdapterCode128A;
use Hbgl\Barcode\Adapters\AdapterCode128B;
use Hbgl\Barcode\Adapters\AdapterCode128C;

class Code128Encoder
{
    /**
     * Libre Barcode 128 characters. Is indexed with the values returned by the encoding function.
     *
     * @var string[]
     */
    private const LIBRE_BARCODE_128_CHARS = [
        ' ', '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.', '/',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '<', '=', '>', '?',
        '@','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', '\\', ']', '^', '_',
        '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
        'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~', 'Ã',
        'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', '',
    ];

    /**
     * Encode text as Code 128 for use with a barcode font.
     *
     * @param string $text
     * @return string Encoded text.
     */
    public static function encode($text, $type = null)
    {
        $values = null;
        if ($type === null) {
            $values = AdapterCode128::getEncodedValues($text);
        } elseif ($type === 'A') {
            $values = AdapterCode128A::getEncodedValues($text);
        } elseif ($type === 'B') {
            $values = AdapterCode128B::getEncodedValues($text);
        } elseif ($type === 'C') {
            $values = AdapterCode128C::getEncodedValues($text);
        } else {
            throw new \UnexpectedValueException("Parameter \$type must be either 'A', 'B' or 'C'.");
        }
        $encoded = '';
        foreach ($values as $value) {
            $encoded .= self::LIBRE_BARCODE_128_CHARS[$value];
        }
        return $encoded;
    }
}
