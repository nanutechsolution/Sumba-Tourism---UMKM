<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Umkm;
use Illuminate\Auth\Access\HandlesAuthorization;

class UmkmPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Umkm');
    }

    public function view(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('View:Umkm');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Umkm');
    }

    public function update(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('Update:Umkm');
    }

    public function delete(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('Delete:Umkm');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Umkm');
    }

    public function restore(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('Restore:Umkm');
    }

    public function forceDelete(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('ForceDelete:Umkm');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Umkm');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Umkm');
    }

    public function replicate(AuthUser $authUser, Umkm $umkm): bool
    {
        return $authUser->can('Replicate:Umkm');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Umkm');
    }

}