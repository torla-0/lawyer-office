<?php

namespace App\Policies;

use App\Models\LegalCase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class LegalCasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    
    public function viewAny(User $user): bool
    {
        if(strtolower('client') === strtolower($user->role->name)){
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LegalCase $legalCase): Response
    {
        // Check is user owner of the case
        if ($user->id === $legalCase->user_id) {
            return Response::allow();
        }

        if ($user->isLawyer()) {
            // Lawyer who is in charge of the case can see it always
            if ($user->id === $legalCase->lawyer?->user_id) {
                return Response::allow();
            }
            // Case's with status pending can be seen by all lawyers - meaning they arent in process/taken
            if (strtolower($legalCase->status) === 'pending') {
                return Response::allow();
            }
        }
        return Response::deny('UNAUTHORIZED ACTION.');
    }

    /**
     * Determine whether the user can create models.
     */


    // Creating cases have restrictions - time frame 15d max three cases per role Client
    public function create(User $user): bool
    {
        // Look for cases
        $casesCreated = LegalCase::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(15))
            ->count();

        // Restrict headsmashing submit button
        if ($casesCreated >= 3) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *//*
    public function update(User $user, LegalCase $legalCase): bool
    {
        //
        
    }

    /**
     * Determine whether the user can delete the model.
     *//*
    public function delete(User $user, LegalCase $legalCase): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *//*
    public function restore(User $user, LegalCase $legalCase): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */ /*
    public function forceDelete(User $user, LegalCase $legalCase): bool
    {
        //
    }

    */
}
