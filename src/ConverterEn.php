<?php

namespace Converter;

class ConverterEn extends Converter implements iConverter
{
    public function setProperties()
    {
        $this->singles = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
        $this->teens = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
        $this->tens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
        $this->powers = ["", "thousand", "million", "billion", "trillion", "quadrillion", "quintillion"];
        $this->hundred = "hundred";
    }
}
