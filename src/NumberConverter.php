<?php

namespace Converter;

use NumberFormatter;

class NumberConverter
{
    private $locale;
    private $value;
    private $number;
    private $converter;

    public function __construct(string $number, string $locale = 'en_EN')
    {
        $this->value = $number;
        $this->locale = $locale;
        if ($locale == 'en_EN')
            $this->converter = new ConverterEn();
        else
            $this->converter = new ConverterNl();
        $this->converter->setProperties();
        $this->number = $this->converter->wordsToNumbers($this->value);
    }

    public function toInt()
    {
        return $this->number;
    }

    public function format()
    {
        $fmt = new NumberFormatter($this->locale, NumberFormatter::DECIMAL);
        return $fmt->format($this->number);
    }
}
