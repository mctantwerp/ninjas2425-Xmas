<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PutEmailInDatabaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $email = $request->input('email');

        try{
            $user = new User();
            $user->email = $email;
            $user->save();

            return response()->json(['message' => 'Email saved successfully']);
        }catch(\Exception $e){
            return response()->json(['message' => $e]);
        }
    }
}
