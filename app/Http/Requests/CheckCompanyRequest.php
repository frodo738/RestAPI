<?php

namespace App\Http\Requests;

use App\Http\DTO\Request\CompanySearchDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *      schema="CheckCompanyRequest",
 *      title="Check Company Request",
 *      description="Request parameters for searching companies",
 *      @OA\Property(property="id", type="integer", example=123, description="Company ID"),
 *      @OA\Property(property="company_title", type="string", example="Example Company Ltd", description="Company title"),
 *      @OA\Property(property="building", type="string", example="Office Building A", description="Building name"),
 *      @OA\Property(property="activities", type="string", example="Manufacturing", description="Company activities"),
 *      @OA\Property(property="activities_tree", type="string", example="Industry/Manufacturing/Production", description="Activities hierarchy"),
 *      @OA\Property(property="latitude", type="number", format="float", example=55.751244, description="Latitude coordinate (required with longitude and radius)"),
 *      @OA\Property(property="longitude", type="number", format="float", example=37.618423, description="Longitude coordinate (required with latitude and radius)"),
 *      @OA\Property(property="radius_in_meters", type="number", format="float", example=1000, description="Search radius in meters (required with latitude and longitude)")
 * )
 */
class CheckCompanyRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['integer'],
            'company_title' => ['string'],
            'building' => ['string'],
            'activities' => ['string'],
            'activities_tree' => ['string'],
            'latitude' => ['numeric:strict','required_with:longitude,radius_in_meters'],
            'longitude' => ['numeric:strict','required_with:latitude,radius_in_meters'],
            'radius_in_meters' => ['numeric:strict','required_with:latitude,longitude'],
        ];
    }

    public function toDTO(): CompanySearchDTO
    {
        return new CompanySearchDTO(
            id:             $this->input('id'),
            title:          $this->input('title'),
            building:       $this->input('building'),
            activities:     $this->input('activities'),
            activitiesTree: $this->input('activities_tree'),
            latitude:       $this->input('latitude'),
            longitude:      $this->input('longitude'),
            radiusInMeters: $this->input('radius_in_meters'),
        );
    }
}
