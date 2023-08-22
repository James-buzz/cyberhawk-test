<?php

declare(strict_types=1);

namespace App\Repositories;

interface InspectionRepository
{
    public function getALL();

    public function getByID($inspectionID);
}
