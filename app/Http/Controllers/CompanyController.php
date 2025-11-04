<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCompanyRequest;
use App\Services\CompanyServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyServiceInterface $companyService)
    {
    }
    /**
     * @OA\Get(
     *      path="/api/v1/company",
     *      operationId="getCompanies",
     *      tags={"Companies"},
     *      summary="Search companies",
     *      security={{"bearerAuth": {}}},
     *      description="Returns list of companies based on search criteria. You can search by ID, title, building, activities or by geographic location with radius.",
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Поиск организации по идентификатору(id)",
     *          required=false,
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Parameter(
     *          name="company_title",
     *          in="query",
     *          description="Поиск организации по названию",
     *          required=false,
     *          @OA\Schema(type="string", example="Автомойка в центре")
     *      ),
     *      @OA\Parameter(
     *          name="building",
     *          in="query",
     *          description="Cписок организаций находящихся в здании по названию",
     *          required=false,
     *          @OA\Schema(type="string", example="Невский")
     *      ),
     *      @OA\Parameter(
     *          name="activities",
     *          in="query",
     *          description="Поиск организации по виду определенному виду деятельности",
     *          required=false,
     *          @OA\Schema(type="string", example="Еда")
     *      ),
     *      @OA\Parameter(
     *          name="activities_tree",
     *          in="query",
     *          description="Поиск организации по виду деятельности по дереву",
     *          required=false,
     *          @OA\Schema(type="string", example="Легковые")
     *      ),
     *      @OA\Parameter(
     *          name="latitude",
     *          in="query",
     *          description="Координаты широты (обязательно с долготой и радиусом в метрах)",
     *          required=false,
     *          @OA\Schema(type="number", format="float", example=55.7538)
     *      ),
     *      @OA\Parameter(
     *          name="longitude",
     *          in="query",
     *          description="Координата долготы (обязательно с широтой и радиусом в метрах)",
     *          required=false,
     *          @OA\Schema(type="number", format="float", example=37.6212)
     *      ),
     *      @OA\Parameter(
     *          name="radius_in_meters",
     *          in="query",
     *          description="Радиус поиска в метрах (обязательно с широтой и долготой)",
     *          required=false,
     *          @OA\Schema(type="number", format="float", example=5000)
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/CompanyResponseDTO")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="latitude",
     *                      type="array",
     *                      @OA\Items(type="string", example="The latitude field is required when longitude / radius in meters is present.")
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function getCompanies(CheckCompanyRequest $request): Response
    {
        $dto = $request->toDTO();
        return response($this->companyService->getCompanies($dto), ResponseAlias::HTTP_OK);
    }
}
