<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
        'from_batch_id',
        'to_batch_id',
        'old_roll',
        'new_roll',
        'old_mr_no',
        'new_mr_no',
        'amount',
        'remark',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function fromBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    public function toBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    public function fromBatch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'from_batch_id');
    }

    public function toBatch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'to_batch_id');
    }
}
