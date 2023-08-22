<?php

declare(strict_types=1);

namespace App\Repositories;

interface FarmRepository
{
    public function getALL();

    public function getByID(int $farmID);
}
