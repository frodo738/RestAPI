<?php

namespace App\Http\DTO\Request;

class CompanySearchDTO
{
    public function __construct(
        readonly public ?string      $id,
        readonly public ?string      $title,
        readonly public ?string      $building,
        readonly public ?string      $activities,
        readonly public ?string      $activitiesTree,
        readonly public ?float       $latitude,
        readonly public ?float       $longitude,
        readonly public ?float       $radiusInMeters,
    )
    {
        //
    }
}
