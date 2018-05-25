<?php

namespace Test;

use Converter\NumberConverter;
use PHPUnit\Framework\TestCase;

class NumberConverterTestNl extends TestCase
{
    private $converter;
    private $locale = 'nl_NL';

    public function testSingles()
    {
        $this->converter = new NumberConverter('Een', $this->locale);
        $this->assertEquals(1, $this->converter->toInt());

        $this->converter = new NumberConverter('twee', $this->locale);
        $this->assertEquals(2, $this->converter->toInt());
    }

    public function testTeens()
    {
        $this->converter = new NumberConverter('tien', $this->locale);
        $this->assertEquals(10, $this->converter->toInt());

        $this->converter = new NumberConverter('achttien', $this->locale);
        $this->assertEquals(18, $this->converter->toInt());
    }

    public function testTens()
    {
        $this->converter = new NumberConverter('twintig', $this->locale);
        $this->assertEquals(20, $this->converter->toInt());

        $this->converter = new NumberConverter('negentig', $this->locale);
        $this->assertEquals(90, $this->converter->toInt());
    }

    public function testNumbersBelowHundred()
    {
        $this->converter = new NumberConverter('vier en twintig', $this->locale);
        $this->assertEquals(24, $this->converter->toInt());

        $this->converter = new NumberConverter('vijfennegentig', $this->locale);
        $this->assertEquals(95, $this->converter->toInt());

        $this->converter = new NumberConverter('zesenzestig', $this->locale);
        $this->assertEquals('66', $this->converter->format());

        $this->converter = new NumberConverter('eenendertig', $this->locale);
        $this->assertEquals(31, $this->converter->toInt());
    }

    public function testHundred()
    {
        $this->converter = new NumberConverter('honderd', $this->locale);
        $this->assertEquals(100, $this->converter->toInt());

        $this->converter = new NumberConverter('honderdtien', $this->locale);
        $this->assertEquals(110, $this->converter->toInt());

        $this->converter = new NumberConverter('driehonderdvijftig', $this->locale);
        $this->assertEquals(350, $this->converter->toInt());
        $this->assertEquals('350', $this->converter->format());
    }

    public function testThousand()
    {
        $this->converter = new NumberConverter('duizend', $this->locale);
        $this->assertEquals(1000, $this->converter->toInt());
        $this->assertEquals('1.000', $this->converter->format());

        $this->converter = new NumberConverter('tweeduizendzeshonderdvierenzestig', $this->locale);
        $this->assertEquals(2664, $this->converter->toInt());
        $this->assertEquals('2.664', $this->converter->format());

        $this->converter = new NumberConverter('tweehonderdduizendzeshonderdvierenzestig', $this->locale);
        $this->assertEquals(200664, $this->converter->toInt());
        $this->assertEquals('200.664', $this->converter->format());

        $this->converter = new NumberConverter('honderdvierentwintigduizenddriehonderdvijftig', $this->locale);
        $this->assertEquals(124350, $this->converter->toInt());
        $this->assertEquals('124.350', $this->converter->format());
    }
}
