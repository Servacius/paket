<?php

namespace App\Policies;

use App\Models\Paket;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view index page.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_ADMINISTRATOR ||
            $user->role_id === UserRole::ROLE_ID_KARYAWAN ||
            $user->role_id === UserRole::ROLE_ID_PETUGAS;
    }

    /**
     * Determine whether the user can view all paket.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAll(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_ADMINISTRATOR ||
            $user->role_id === UserRole::ROLE_ID_KARYAWAN ||
            $user->role_id === UserRole::ROLE_ID_PETUGAS;
    }

    /**
     * Determine whether the user can view all paket.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewFilterCaraPenerimaanConfirmed(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_PETUGAS;
    }

    /**
     * Determine whether the user can view all unpicked-up paket.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewFilterUnpickedUp(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_KARYAWAN;
    }

    /**
     * Determine whether the user can view all unpicked-up paket.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function detail(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_KARYAWAN ||
            $user->role_id === UserRole::ROLE_ID_PETUGAS;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id === UserRole::ROLE_ID_PETUGAS;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paket  $paket
     * @return mixed
     */
    public function update(User $user, Paket $paket)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paket  $paket
     * @return mixed
     */
    public function delete(User $user, Paket $paket)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paket  $paket
     * @return mixed
     */
    public function restore(User $user, Paket $paket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paket  $paket
     * @return mixed
     */
    public function forceDelete(User $user, Paket $paket)
    {
        //
    }
}
