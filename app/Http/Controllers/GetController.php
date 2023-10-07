<?php

namespace App\Http\Controllers;



class GetController
{
    public function __invoke()
    {
        return auth()->user();
    }
}
