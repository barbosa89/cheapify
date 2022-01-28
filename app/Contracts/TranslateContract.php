<?php

namespace App\Contracts;

interface TranslateContract
{
    public function trans(string $key): string;
}
