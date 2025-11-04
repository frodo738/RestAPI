<?php

namespace App\Http\DTO\Response;

/**
 * @OA\Schema(
 *      schema="BuildingResponseDTO",
 *      title="Building Response",
 *      description="Building data",
 *      type="object",
 *      required={"id", "title", "latitude", "longitude"},
 *      @OA\Property(property="id", type="integer", example=1, description="Building ID"),
 *      @OA\Property(property="title", type="string", example="Office Building A", description="Building title"),
 *      @OA\Property(property="latitude", type="number", format="float", example=55.751244, description="Building latitude"),
 *      @OA\Property(property="longitude", type="number", format="float", example=37.618423, description="Building longitude")
 * )
 */
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
