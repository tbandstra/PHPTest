<?php

namespace Converter;

abstract class Converter
{
    protected $singles;
    protected $teens;
    protected $tens;
    protected $powers;
    protected $hundred;

    public function wordsToNumbers(string $words): int
    {
        $number = 0;
        if (empty($words)) {
            return 0;
        }
        $words = trim($words);
        $words = strtolower($words);

        for ($i = count($this->powers) - 1; $i > -0; $i--) {
            if (empty($this->powers[$i])) {
                continue;
            }

            $index = strpos($words, $this->powers[$i]); // words.IndexOf(powers[i]);

            if ($index !== false && $index >= 0) //&& $words[$index + strlen($this->powers[$i])] == ' ')
            {
                $length = strlen($this->powers[$i]);
                // how much thousand
                $partBefore = substr($words, 0, $index == 0 ? 0 : $index);
                $count = $this->wordsToNumbers($partBefore);
                //$count = self::WordsToNumbers(substr($words, 0, -$length));
                if ($count == 0) {
                    $count = 1;
                }
                $number += $count * 1000; // only thousands
                //$this-number += $count * Math.Pow(1000, $i);
                $words = substr($words, $index + $length);
                $words = trim($words);
                //$words = substr($words, $index + 1 .Remove(0, $index);
            }
        }

        $index = strpos($words, $this->hundred);

        if ($index !== false && $index >= 0) // && words[index + "hundred".Length] == ' ')
        {
            $length = strlen($this->hundred);
            // how much hundred
            $partBefore = substr($words, 0, $index == 0 ? 0 : $index);
            $count = $this->wordsToNumbers($partBefore);
            //$count = self::WordsToNumbers(substr($words, 0, -$length)); // . Substring(0, index));
            if ($count == 0) {
                $count = 1;
            }
            $number += $count * 100;
            $words = substr($words, $index + $length); // words.Remove(0, index);
        }

        for ($i = count($this->tens) - 1; $i >= 0; $i--) {
            if (empty($this->tens[$i])) {
                continue;
            }
            $index = strpos($words, $this->tens[$i]); // words.IndexOf(tens[i]);

            if ($index !== false && $index >= 0) // && words[index + tens[i].Length] == ' ')
            {
                $number += $i * 10; // (uint)(i * 10);
                $words = str_replace($this->tens[$i], '', $words);
                //$words = substr($words, $index + strlen($this->tens[$i]));
                //words = words.Remove(0, index);
                $words = trim($words);
            }
        }

        for ($i = count($this->teens) - 1; $i >= 0; $i--) {
            if (empty($this->teens[$i])) {
                continue;
            }
            $index = strpos($words, $this->teens[$i]); // words.IndexOf(teens[i]);

            if ($index !== false && $index >= 0)  // && words[index + teens[i].Length] == ' ')
            {
                $number += ($i + 10);
                $words = substr($words, 0, -strlen($this->teens[$i])); //words.Remove(0, index);
                $words = trim($words);
            }
        }

        for ($i = count($this->singles) - 1; $i >= 0; $i--) {
            if (empty($this->singles[$i])) {
                continue;
            }
            $index = strpos($words, $this->singles[$i]); // what about . ' '

            if ($index !== false && $index >= 0) { //&& $words[$index + count($this->singles[$i])] == ' ') {
                $number += $i; //(uint)($i);
                //$words =  words.Remove(0, index);
            }
        }

        return $number;

    }
}