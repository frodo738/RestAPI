<?php

namespace App\Http\DTO\Response;

class CompanyResponseDTO
{
    public function __construct(
        readonly public int                 $id,
        readonly public string              $title,
        readonly public BuildingResponseDTO $building,
        readonly public array               $activities,
        readonly public array               $phones
    )
    {
        //
    }
}
