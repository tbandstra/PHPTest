<?php

namespace Converter;

class ConverterNl extends Converter implements iConverter
{
    public function setProperties()
    {
        $this->singles = ["nul", "een", "twee", "drie", "vier", "vijf", "zes", "zeven", "acht", "negen"];
        $this->teens = ["tien", "elf", "twaalf", "dertien", "veertien", "vijftien", "zestien", "zeventien", "achttien", "negentien"];
        $this->tens = ["", "", "twintig", "dertig", "veertig", "vijftig", "zestig", "zeventig", "tachtig", "negentig"];
        $this->powers = ["", "duizend", "million", "billion", "trillion", "quadrillion", "quintillion"];
        $this->hundred = "honderd";
    }
}
