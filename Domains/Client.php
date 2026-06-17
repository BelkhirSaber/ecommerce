<?php

namespace Domains;

use Model\User;
use Carbon\Carbon;

class Client {

    public function getTotalClients()
    {
        return User::where('E_ROLE', 'customer')
            ->where('CREATED_AT', '>=', Carbon::now()->subDays(30))
            ->count();
    }
}