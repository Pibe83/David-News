<?php

namespace App\Traits\Models\User;

trait UserBoolean
{
    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if the user is not an admin.
     *
     * @return bool
     */
    public function isNotAdmin(): bool
    {
        return ! $this->isAdmin();
    }
}
