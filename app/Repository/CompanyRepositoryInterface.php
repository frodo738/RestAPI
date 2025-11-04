<?php

namespace App\Repository;

use App\Http\DTO\Request\CompanySearchDTO;
use App\Models\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function getCompanies(CompanySearchDTO $companySearchDTO, array $activityTreeID): Collection;
}
