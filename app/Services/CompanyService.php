<?php

namespace App\Services;

use App\Http\DTO\Request\CompanySearchDTO;
use App\Http\DTO\Response\ActivityResponseDTO;
use App\Http\DTO\Response\BuildingResponseDTO;
use App\Http\DTO\Response\CompanyResponseDTO;
use App\Repository\ActivityRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;

readonly class CompanyService implements CompanyServiceInterface
{
    public function __construct(private CompanyRepositoryInterface $companyRepository,
                                private ActivityRepositoryInterface $activityRepository)
    {
    }


    /**
     * @return CompanyResponseDTO[]
     */
    public function getCompanies(CompanySearchDTO $companySearchDTO): array
    {
        $activityTreeID = [];
        if ($companySearchDTO->activitiesTree){
            $activityTreeID = $this->activityRepository->getActivitiesIdFromTree($companySearchDTO->activitiesTree);
        }
        $result = $this->companyRepository->getCompanies($companySearchDTO, $activityTreeID);

        $companies = [];
        foreach ($result as $company) {
            if ($company->building){
                $building = new BuildingResponseDTO(
                    $company->building->id,
                    $company->building->title,
                    $company->building->latitude,
                    $company->building->longitude,
                );
            } else {
                $building = null;
            }

            $activities = [];
            foreach ($company->activities as $activity) {
                $activities[] = new ActivityResponseDTO($activity->id, $activity->title);
            }

            $phones = [];
            foreach ($company->phones as $phone) {
                $phones[] = $phone->phone_number;
            }

            $companies[] = new CompanyResponseDTO($company->id, $company->title, $building, $activities, $phones);
        }
        return $companies;
    }
}
