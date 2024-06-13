<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewDashboard(User $user)
    {
        return true; // User hanya dapat mengakses dashboard
    }
}
