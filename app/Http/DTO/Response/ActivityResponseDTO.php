<?php

namespace App\Http\DTO\Response;

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
