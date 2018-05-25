<?php

namespace Converter;

use NumberFormatter;

class NumberConverter
{
    private $language;
    private $value;
    private $number;

    public function __construct(string $number, string $language = 'en_EN')
    {
        $this->value = $number;
        $this->language = $language;
        $this->number = self::WordsToNumbers($this->value);
    }

    public function toInt()
    {
        return $this->number;
    }

    public function format()
    {
        $fmt = new NumberFormatter($this->language, NumberFormatter::DECIMAL);
        return $fmt->format($this->number);
    }

    private static function WordsToNumbers(string $words): int
    {
        if (empty($words)) {
            return 0;
        }
        $words = trim($words);
        $words = strtolower($words);

        $number = 0;
        $singles = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
        $teens = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
        $tens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
        $powers = ["", "thousand", "million", "billion", "trillion", "quadrillion", "quintillion"];

        for ($i = count($powers) - 1; $i > -0; $i--) {
            if (empty($powers[$i])) {
                continue;
            }

            $index = strpos($words, $powers[$i]); // words.IndexOf(powers[i]);

            if ($index !== false && $index >= 0) //&& $words[$index + strlen($powers[$i])] == ' ')
            {
                $length = strlen($powers[$i]);
                // how much thousand
                $partBefore = substr($words, 0, $index - 1);
                $count = self::WordsToNumbers($partBefore);
                //$count = self::WordsToNumbers(substr($words, 0, -$length));
                if ($count == 0) {
                    $count = 1;
                }
                $number += $count * 1000; // only thousands
                //$number += $count * Math.Pow(1000, $i);
                $words = substr($words, $index + $length);
                $words = trim($words);
                //$words = substr($words, $index + 1 .Remove(0, $index);
            }
        }

        $index = strpos($words, 'hundred');

        if ($index !== false && $index >= 0) // && words[index + "hundred".Length] == ' ')
        {
            $length = strlen('hundred');
            // how much hundred
            $partBefore = substr($words, 0, $index == 0 ? 0 : $index);
            $count = self::WordsToNumbers($partBefore);
            //$count = self::WordsToNumbers(substr($words, 0, -$length)); // . Substring(0, index));
            if ($count == 0) {
                $count = 1;
            }
            $number += $count * 100;
            $words = substr($words, $index + $length); // words.Remove(0, index);
        }

        for ($i = count($tens) - 1; $i >= 0; $i--) {
            if (empty($tens[$i])) {
                continue;
            }
            $index = strpos($words, $tens[$i]); // words.IndexOf(tens[i]);

            if ($index !== false && $index >= 0) // && words[index + tens[i].Length] == ' ')
            {
                $number += $i * 10; // (uint)(i * 10);
                $words = substr($words, $index + strlen($tens[$i]));
                //words = words.Remove(0, index);
                $words = trim($words);
            }
        }

        for ($i = count($teens) - 1; $i >= 0; $i--) {
            if (empty($teens[$i])) {
                continue;
            }
            $index = strpos($words, $teens[$i]); // words.IndexOf(teens[i]);

            if ($index !== false && $index >= 0)  // && words[index + teens[i].Length] == ' ')
            {
                $number += ($i + 10);
                $words = substr($words, 0, -strlen($teens[$i])); //words.Remove(0, index);
                $words = trim($words);
            }
        }

        for ($i = count($singles) - 1; $i >= 0; $i--) {
            if (empty($singles[$i])) {
                continue;
            }
            $index = strpos($words, $singles[$i]); // what about . ' '

            if ($index !== false && $index >= 0) { //&& $words[$index + count($singles[$i])] == ' ') {
                $number += $i; //(uint)($i);
                //$words =  words.Remove(0, index);
            }
        }

        return $number;
    }

}
