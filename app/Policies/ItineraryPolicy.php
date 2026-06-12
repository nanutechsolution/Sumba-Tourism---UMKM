<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Itinerary;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItineraryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Itinerary');
    }

    public function view(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('View:Itinerary');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Itinerary');
    }

    public function update(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('Update:Itinerary');
    }

    public function delete(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('Delete:Itinerary');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Itinerary');
    }

    public function restore(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('Restore:Itinerary');
    }

    public function forceDelete(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('ForceDelete:Itinerary');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Itinerary');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Itinerary');
    }

    public function replicate(AuthUser $authUser, Itinerary $itinerary): bool
    {
        return $authUser->can('Replicate:Itinerary');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Itinerary');
    }

}