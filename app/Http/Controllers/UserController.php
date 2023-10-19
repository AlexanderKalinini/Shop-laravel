<?php

namespace App\Http\Controllers;



class UserController
{
    public function __invoke()
    {
        return auth()->user();
    }
}
