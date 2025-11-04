<?php

namespace App\Http\DTO\Response;

/**
 * @OA\Schema(
 *      schema="CompanyResponseDTO",
 *      title="Company Response",
 *      description="Company data",
 *      type="object",
 *      required={"id", "title", "building", "activities", "phones"},
 *      @OA\Property(property="id", type="integer", example=123, description="Company ID"),
 *      @OA\Property(property="title", type="string", example="Example Company Ltd", description="Company title"),
 *      @OA\Property(property="building", ref="#/components/schemas/BuildingResponseDTO", description="Building information"),
 *      @OA\Property(
 *          property="activities",
 *          type="array",
 *          description="List of activities",
 *          @OA\Items(ref="#/components/schemas/ActivityResponseDTO")
 *      ),
 *      @OA\Property(
 *          property="phones",
 *          type="array",
 *          description="List of phone numbers",
 *          @OA\Items(type="string", example="+7 (999) 123-45-67")
 *      )
 * )
 */
class CompanyResponseDTO
{
    public function __construct(
        readonly public int                 $id,
        readonly public string              $title,
        readonly public ?BuildingResponseDTO $building,
        readonly public array               $activities,
        readonly public array               $phones
    )
    {
        //
    }
}
