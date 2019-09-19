<?php

namespace Hbgl\Barcode\Tests;

use Hbgl\Barcode\Code128Encoder;
use PHPUnit\Framework\TestCase;

class SamplesTest extends TestCase
{
    public function testSample1()
    {
        // Encode as Code 128.
        $encoded = Code128Encoder::encode('ABC123456DEF');
        assert($encoded === 'ÌABCÇ,BXÈDEFqÎ');

        // Only encode using Type A.
        $encodedA = Code128Encoder::encode('ABC123456DEF', 'A');
        assert($encodedA === 'ËABC123456DEFLÎ');

        // Only encode using Type B.
        $encodedB = Code128Encoder::encode('AcC123456DeF', 'B');
        assert($encodedB === 'ÌAcC123456DeFSÎ');

        // Only encode using Type C.
        $encodedC = Code128Encoder::encode('123456', 'C');
        assert($encodedC === 'Í,BXLÎ');

        // Just check that it runs.
        $this->assertTrue(true);
    }
}
