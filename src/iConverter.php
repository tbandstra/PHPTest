<?php

namespace Converter;

interface iConverter
{
    public function setProperties();
    public function wordsToNumbers(string $words);
}
