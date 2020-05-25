<?php

namespace App\Traits;

use App\Http\Requests\StoreUser;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait CreatesUsers
{
    /**
     * @param  array  $data
     *
     * @return array
     */
    protected function splitData(array $data): array
    {
        $userKeys = array_keys(StoreUser::rules());

        $userData = Arr::only($data, $userKeys);
        $profileData = Arr::except($data, $userKeys);

        return [$userData, $profileData];
    }

    /**
     * @param  array  $data
     * @param  int  $profileId
     *
     * @return bool
     */
    protected function createNewUser(array $data, int $profileId) : bool
    {
        $user = $this->user->newInstance();

        return $user->fill(array_merge($data, [
            'profile_type' => $this->getType(),
            'profile_id' => $profileId
        ]))->save();
    }

    /**
     * @return mixed
     */
    abstract protected function getType();
}
