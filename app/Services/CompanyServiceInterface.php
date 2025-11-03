<?php

namespace App\Services;

use App\Http\DTO\Request\CompanySearchDTO;

interface CompanyServiceInterface
{
    public function getCompanies(CompanySearchDTO $companySearchDTO): array;
}
