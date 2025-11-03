<?php

namespace App\Repository;

use App\Models\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getActivitiesIdFromTree($title): array
    {
        $activity = Activity::query()->where('title', $title)->first();
        return $this->getDescendantsWithinDepth($activity, env('ACTIVITY_DEPTH', 3));
    }

    private function getDescendantsWithinDepth(Activity $activity, $depth): array
    {
        $ids = [$activity->id];
        if ($depth > 0) {
            foreach ($activity->children as $child) {
                $ids[] = $child->id;
                $ids = array_merge($ids, $this->getDescendantsWithinDepth($child, $depth - 1));
            }
        }
        return $ids;
    }
}
