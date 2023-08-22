<?php

declare(strict_types=1);

namespace App\Repositories;

interface ComponentRepository
{
    public function getALL();

    public function types();

    public function getTypeByID($typeID);

    public function getByID(int $componentID);
}
