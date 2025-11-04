<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Company;
use App\Models\CompanyActivity;
use App\Models\CompanyPhone;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->addActivity();
        $this->addBuilding();
        $this->addCompany();
    }

    private function addActivity(): void
    {
        $activities = [
            [
                'title' => 'Еда',
                'children' => [
                    [
                        'title' => 'Мясная продукция'
                    ],
                    [
                        'title' => 'Молочная продукция'
                    ]
                ]
            ],
            [
                'title' => 'Автомобили',
                'children' => [
                    [
                        'title' => 'Грузовые'
                    ],
                    [
                        'title' => 'Легковые',
                        'children' => [
                            [
                                'title' => 'Класс A'
                            ],
                            [
                                'title' => 'Класс B'
                            ]
                        ]
                    ]
                ]
            ],
        ];

        foreach ($activities as $activity) {
            $activityModel = Activity::query()->firstOrCreate([
                'title' => $activity['title'],
            ]);
            if ($activity['children']) {
                $this->addActivityChild($activityModel->id, $activity['children']);
            }

        }
    }

    private function addActivityChild(int $parent_id, array $children): void
    {
        foreach ($children as $child) {
            $activityModel = Activity::query()->firstOrCreate([
                'title' => $child['title'],
                'parent_id' => $parent_id,
            ]);

            if (isset($child['children']) && $child['children']) {
                $this->addActivityChild($activityModel->id, $child['children']);
            }
        }
    }

    private function addBuilding(): void
    {
        $buildings = [
            [
                'building' => 'Блюхера, 32/1',
                'latitude' => 123,
                'longitude' => 321,
            ],
            [
                'building' => 'Невский 12',
                'latitude' => 55.751244 ,
                'longitude' => 37.618423,
            ],
            [
                'building' => 'Удельная 45',
                'latitude' => 32.25,
                'longitude' => 78.7,
            ],
        ];

        foreach ($buildings as $building) {
            Building::query()->firstOrCreate([
                'title' => $building['building'],
                'latitude' => $building['latitude'],
                'longitude' => $building['longitude'],
            ]);
        }
    }

    private function addCompany(): void
    {
        $companies = [
            [
                'building' => 'Блюхера, 32/1',
                'company' => 'Рога и Копыта',
                'phone_number' => ['2-222-222'],
                'activity' => ['Мясная продукция', 'Молочная продукция']
            ],
            [
                'building' => 'Невский 12',
                'company' => 'Автомойка в центре',
                'phone_number' => ['3-333-333', '8-923-666-13-13'],
                'activity' => ['Легковые']
            ],
        ];

        foreach ($companies as $company) {
            $building = Building::query()->where('title', $company['building'])->first();

            $companyModel = Company::query()->firstOrCreate([
                'title' => $company['company'],
                'building_id' => $building->id,
            ]);


            foreach ($company['phone_number'] as $phone) {
                CompanyPhone::query()->firstOrCreate([
                    'company_id' => $companyModel->id,
                    'phone_number' => $phone,
                ]);
            }

            foreach ($company['activity'] as $activity) {
                $activityModel = Activity::query()->where('title', '=', $activity)->first();
                if ($activityModel) {
                    CompanyActivity::query()->firstOrCreate([
                        'company_id' => $companyModel->id,
                        'activity_id' => $activityModel->id,
                    ]);
                }
            }
        }
    }
}
