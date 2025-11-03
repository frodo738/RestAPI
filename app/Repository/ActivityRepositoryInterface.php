<?php

namespace App\Repository;

use App\Http\DTO\Request\CompanySearchDTO;
use App\Models\Company;
use Illuminate\Support\Collection;

interface ActivityRepositoryInterface
{
    public function getActivitiesIdFromTree(string $title): array;
}
