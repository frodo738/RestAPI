<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function children(): HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    protected function getDescendantsWithinDepth(Activity $activity, int $depth): array
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
