<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCompanyRequest;
use App\Services\CompanyServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyServiceInterface $companyService)
    {
    }

    public function getCompanies(CheckCompanyRequest $request): Response
    {
        $dto = $request->toDTO();
        return response($this->companyService->getCompanies($dto), ResponseAlias::HTTP_OK);
    }
}
