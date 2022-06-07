<?php

namespace App\Models\Constants;

class ProfileConstants
{
    const SUCCESSFUL_OPERATION_MESSAGE = 'Operation has been completed.';

    const PROFILE_ATTRIBS_TO_RETURN = [
        'profile.id',
        'profile.img',
        'profile.first_name',
        'profile.last_name',
        'profile.phone',
        'profile.address',
        'city.title as city',
        'state.code as state',
        'profile.zip_code',
        'profile.is_available',
    ];
}
