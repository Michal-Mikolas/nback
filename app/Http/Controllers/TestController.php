<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function findUser($email)
    {
        // sleep(2);

        // return response()->json([]);
        return response()->json([
            'user' => [
                'id' => 1,
                'email' => $email,
            ],
        ]);
    }
}
