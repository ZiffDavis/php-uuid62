<?php
namespace ZiffDavis\Uuid62\Concerns;

use Illuminate\Database\Eloquent\Builder;
use ZiffDavis\Uuid62\Uuid62;

trait HasUuid62
{
    public static function bootUuidable()
    {
        static::saving(function ($model) {
            if (!isset($model->uuid)) {
                $model->uuid = Uuid62::new();
            }
        });
    }

    public function scopeWithUuid(Builder $query, $uuid)
    {
        $query->whereRaw('uuid = BINARY ?', [$uuid]);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getKeyType()
    {
        return 'string';
    }
}
