<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Banking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Banking');
    }

    public function view(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('View:Banking');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Banking');
    }

    public function update(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('Update:Banking');
    }

    public function delete(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('Delete:Banking');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Banking');
    }

    public function restore(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('Restore:Banking');
    }

    public function forceDelete(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('ForceDelete:Banking');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Banking');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Banking');
    }

    public function replicate(AuthUser $authUser, Banking $banking): bool
    {
        return $authUser->can('Replicate:Banking');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Banking');
    }

}