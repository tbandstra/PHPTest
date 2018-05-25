<?php

namespace Converter;

use NumberFormatter;

class NumberConverter
{
    private $locale;
    private $words;
    private $number;
    private $converter;

    public function __construct(string $words, string $locale = 'en_EN')
    {
        $this->words = $words;
        $this->locale = $locale;
        if ($locale == 'en_EN')
            $this->converter = new ConverterEn();
        else
            $this->converter = new ConverterNl();
        $this->converter->setProperties();
        $this->number = $this->converter->wordsToNumber($this->words);
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
