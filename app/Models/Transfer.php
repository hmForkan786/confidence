<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
        'from_batch_id',
        'to_batch_id',
        'from_branch_roll',
        'from_branch_mr_no',
        'from_branch_amount',
        'to_branch_roll',
        'to_branch_mr_no',
        'to_branch_amount',
        'branch_remark',
        'from_batch_old_roll',
        'from_batch_old_mr_no',
        'from_batch_old_amount',
        'to_batch_new_roll',
        'to_batch_new_mr_no',
        'to_batch_new_amount',
        'batch_remark',
        'old_roll',
        'new_roll',
        'old_mr_no',
        'new_mr_no',
        'amount',
        'remark',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'from_branch_amount' => 'decimal:2',
        'to_branch_amount' => 'decimal:2',
        'from_batch_old_amount' => 'decimal:2',
        'to_batch_new_amount' => 'decimal:2',
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
