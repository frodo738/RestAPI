<?php

namespace App\Repository;

use App\Models\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getActivitiesIdFromTree(string $title): array
    {
        $activity = Activity::query()->where('title', $title)->first();
        if (!$activity) {
            return [];
        }
        return $this->getDescendantsWithinDepth($activity, env('ACTIVITY_DEPTH', 3));
    }

    private function getDescendantsWithinDepth(Activity $activity, int $depth): array
    {
        $ids = [$activity->id];
        if ($depth > 0) {
            foreach ($activity->children as $child) {
                $ids[] = $child->id;
                $ids = array_merge($ids, $this->getDescendantsWithinDepth($child, $depth - 1));
            }
        }
        return array_unique($ids);
    }
}
