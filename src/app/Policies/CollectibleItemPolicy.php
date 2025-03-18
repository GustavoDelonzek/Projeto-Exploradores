<?php

namespace App\Policies;

use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CollectibleItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?Explorer $explorer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?Explorer $explorer, CollectibleItem $collectibleItem): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?Explorer $explorer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CollectibleItem $collectibleItem)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CollectibleItem $collectibleItem)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CollectibleItem $collectibleItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CollectibleItem $collectibleItem)
    {
        //
    }
}
