<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ActionContract
{
    public function execute(): Model;
}
