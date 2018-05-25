<?php

namespace Converter;

abstract class Converter
{
    protected $singles;
    protected $teens;
    protected $tens;
    protected $powers;
    protected $hundred;

    public function wordsToNumber(string $words): int
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

            $index = strpos($words, $this->powers[$i]);

            if ($index !== false && $index >= 0) {
                $length = strlen($this->powers[$i]);
                // how much thousand
                $partBefore = substr($words, 0, $index == 0 ? 0 : $index);
                $count = $this->wordsToNumber($partBefore);
                if ($count == 0) {
                    $count = 1;
                }
                $number += $count * 1000; // only thousands for now
                $words = substr($words, $index + $length);
                $words = trim($words);
            }
        }

        $index = strpos($words, $this->hundred);

        if ($index !== false && $index >= 0) {
            $length = strlen($this->hundred);
            // how much hundred
            $partBefore = substr($words, 0, $index == 0 ? 0 : $index);
            $count = $this->wordsToNumber($partBefore);
            if ($count == 0) {
                $count = 1;
            }
            $number += $count * 100;
            $words = substr($words, $index + $length);
        }

        for ($i = count($this->tens) - 1; $i >= 0; $i--) {
            if (empty($this->tens[$i])) {
                continue;
            }
            $index = strpos($words, $this->tens[$i]);

            if ($index !== false && $index >= 0) {
                $number += $i * 10;
                $words = str_replace($this->tens[$i], '', $words);
                $words = trim($words);
            }
        }

        for ($i = count($this->teens) - 1; $i >= 0; $i--) {
            if (empty($this->teens[$i])) {
                continue;
            }
            $index = strpos($words, $this->teens[$i]);

            if ($index !== false && $index >= 0) {
                $number += ($i + 10);
                $words = substr($words, 0, -strlen($this->teens[$i]));
                $words = trim($words);
            }
        }

        for ($i = count($this->singles) - 1; $i >= 0; $i--) {
            if (empty($this->singles[$i])) {
                continue;
            }
            $index = strpos($words, $this->singles[$i]);

            if ($index !== false && $index >= 0) {
                $number += $i;
            }
        }

        return $number;
    }
}
