<?php

namespace App\Repository;

use App\Http\DTO\Request\CompanySearchDTO;
use App\Models\Company;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getCompanies(CompanySearchDTO $companySearchDTO,array $activityTreeID): Collection
    {
        $companies = Company::query()->with('phones');

        if ($companySearchDTO->id) {
            $companies->where('companies.id', $companySearchDTO->id);
        }

        if ($companySearchDTO->title) {
            $companies->where('companies.title', 'like', '%' . $companySearchDTO->title . '%');
        }

        if ($companySearchDTO->building ||
            ($companySearchDTO->longitude && $companySearchDTO->latitude && $companySearchDTO->radiusInMeters)
        )
        {
            $companies->whereHas('building', function ($query) use ($companySearchDTO) {
                if ($companySearchDTO->building) {
                    $query->where('buildings.title', 'like', '%' . $companySearchDTO->building . '%');
                }

                if ($companySearchDTO->longitude && $companySearchDTO->latitude && $companySearchDTO->radiusInMeters) {
                    $query->whereRaw(
                        "ST_DWithin(
                    ST_SetSRID(ST_MakePoint(longitude, latitude), 4326)::geography,
                    ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography,
                    ?)",
                        [$companySearchDTO->longitude, $companySearchDTO->latitude, $companySearchDTO->radiusInMeters]
                    );
                }
            });
        }

        if ($companySearchDTO->activities || $activityTreeID) {
            $companies->whereHas('activities', function ($query) use ($companySearchDTO, $activityTreeID) {
                if ($companySearchDTO->activities) {
                    $query->where('activities.title', '=', $companySearchDTO->activities);
                }

                if ($activityTreeID) {
                    $query->whereIn('activities.id', $activityTreeID);
                }
            });
        }

        return $companies->get();
    }
}
