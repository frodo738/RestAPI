<?php

namespace App\Http\DTO\Response;

class BuildingResponseDTO
{
    public function __construct(
        readonly public int $id,
        readonly public string $title,
        readonly public float $latitude,
        readonly public float $longitude,
    )
    {
        //
    }
}
