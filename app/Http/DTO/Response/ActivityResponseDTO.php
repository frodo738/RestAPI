<?php

namespace App\Http\DTO\Response;

/**
 * @OA\Schema(
 *      schema="ActivityResponseDTO",
 *      title="Activity Response",
 *      description="Activity data",
 *      type="object",
 *      required={"id", "title"},
 *      @OA\Property(property="id", type="integer", example=1, description="Activity ID"),
 *      @OA\Property(property="title", type="string", example="Manufacturing", description="Activity title")
 * )
 */
class ActivityResponseDTO
{
    public function __construct(
        readonly public int $id,
        readonly public string $title,
    )
    {
        //
    }
}
