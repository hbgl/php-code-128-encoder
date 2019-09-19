<?php

namespace Hbgl\Barcode\Tests;

use Hbgl\Barcode\Code128Encoder;
use PHPUnit\Framework\TestCase;

class Code128EncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $this->assertEquals("ÌABCDEFG'Î", Code128Encoder::encode('ABCDEFG'));
    }

    public function testEncodeTypeA(): void
    {
        $this->assertEquals('ËABCDEFG&Î', Code128Encoder::encode('ABCDEFG', 'A'));
    }

    public function testEncodeTypeB(): void
    {
        $this->assertEquals("ÌABCDEFG'Î", Code128Encoder::encode('ABCDEFG', 'B'));
    }

    public function testEncodeLowercaseTypeB(): void
    {
        $this->assertEquals("ÌAbCdeFgdÎ", Code128Encoder::encode('AbCdeFg', 'B'));
    }

    public function testEncodeTypeC(): void
    {
        $this->assertEquals('Í,BXnOÎ', Code128Encoder::encode('12345678', 'C'));
    }

    public function testEncodeMixedTypes(): void
    {
        // The reference encoder written in JavaScript encodes this value differently.
        // It starts starts encoding AB as Code B then switches to Code C for encoding
        // 12345678 and then switches to Code A for encoding CD. tc-lib-barcode differs
        // in that it switches from Code C back to Code B.
        // Functionally there is no difference.
        $this->assertEquals('ÌABÇ,BXnÈCDzÎ', Code128Encoder::encode('AB12345678CD'));
    }

    public function testEncodeMixedTypesEndsInLowercase(): void
    {
        $this->assertEquals('ÌABÇ,BXnÈCdEf)Î', Code128Encoder::encode('AB12345678CdEf'));
    }

    public function testMultipleEncodeCalls(): void
    {
        $inputsAB = ['JGFZP6DV', '54NNJS', 'HFPPHNP2VQTV'];
        $inputsC = ['1234', '7416239122', '9231231286'];
        $tests = [
            [null, $inputsAB, ['ÌJGFZP6DVqÎ', 'Ì54NNJSlÎ', 'ÌHFPPHNP2VQTV Î']],
            ['A', $inputsAB, ['ËJGFZP6DVpÎ', 'Ë54NNJSkÎ', 'ËHFPPHNP2VQTVÊÎ']],
            ['B', $inputsAB, ['ÌJGFZP6DVqÎ', 'Ì54NNJSlÎ', 'ÌHFPPHNP2VQTV Î']],
            ['C', $inputsC, ['Í,BrÎ', 'Íj07{6AÎ', 'Í|?7,vuÎ']],
        ];
        foreach ($tests as $test) {
            [$type, $inputs, $expectedOutputs] = $test;
            $count = count($inputs);
            for ($i = 0; $i < $count; $i++) {
                $input = $inputs[$i];
                $expected = $expectedOutputs[$i];
                $actual = Code128Encoder::encode($input, $type);
                $this->assertEquals($expected, $actual, "Testing type '$type' with input $input");
            }
        }
    }

    public function testInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageRegExp('/\\$type/');
        Code128Encoder::encode('ABCDEFG', '😱😱😱');
    }
}
