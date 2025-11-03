<?php

namespace App\Http\Requests;

use App\Http\DTO\Request\CompanySearchDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

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
