<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function findUser($email)
    {
        $user = User::firstWhere('email', $email);

        // return response()->json([]);
        return response()->json([
            'user' => $user,
        ]);
    }

    public function saveTest(Request $request)
    {
        /*
         * Init
         */
        $inputUser = $request->input('user');
        $inputCards = $request->input('cards');

        /*
         * Save data
         */
        // USER
        $user = User::where('email', $inputUser['email'])->first();
        if (!$user) {
            $user = User::create($inputUser);
        }

        // TEST & CARDS
        $test = $user->tests()->create([
            'is_main_test' => ($user->tests()->count() == 0),
        ]);

        foreach ($inputCards as $inputCard) {
            $test->cards()->create($inputCard);
        }

        // SAVE TO DB
        $user->push();

        /*
        * Finish
        */
        $test->refreshStats();

        return response()->json([
            'status' => '200',
            'message' => 'ok',
            '$request->input(\'user\')' => $request->input('user'),
            '$request->input(\'cards\')' => $request->input('cards'),
        ]);
    }
}
