<?php

namespace App\Traits;

use App\Http\Requests\StoreUser;

use App\Models\User;
use App\Notifications\YourPassword;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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

        $password = Str::random(40);
        $user->fill(array_merge($data, [
            'profile_type' => $this->getType(),
            'profile_id' => $profileId,
            'password' => bcrypt($password)
        ]))->save();

        $user->notify(new YourPassword($user, $password));

        return $user !== null;
    }

    /**
     * @return mixed
     */
    abstract protected function getType();
}
