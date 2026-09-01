<?php

declare(strict_types=1);

namespace Modules\SampleTasks\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Sample\Models\SampleItem;
use Spine\Traits\HasLifecycleHooks;

/**
 * SampleTask — CHILD entity dari SampleItem (belongsTo).
 *
 * Menguji entity lifecycle hooks lintas modul:
 *   - EntityCreated/Updated/Deleted otomatis (HasLifecycleHooks)
 *   - status-change pattern (task_status_changed): EntityUpdated dengan
 *     changes['status'] — listener bisa bereaksi seperti estimate_accepted.
 */
class SampleTask extends Model
{
    use HasLifecycleHooks;
    use HasUlids;

    protected $fillable = ['sample_item_id', 'title', 'status', 'ulid'];

    protected $casts = [
        'id'             => 'integer',
        'sample_item_id' => 'integer',
    ];

    /**
     * HasUlids default mengisi PRIMARY KEY — override agar mengisi kolom 'ulid'.
     */
    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function sampleItem(): BelongsTo
    {
        return $this->belongsTo(SampleItem::class);
    }
}
