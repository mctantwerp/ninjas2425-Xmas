<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;


class PutEmailInDatabaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $email = $validated['email'];
//        return response()->json([
//            'message' => $email
//        ]);

        try{
            $user = new User();
            $user->email = $email;
            $user->save();

            return response()->json(['message' => 'Email saved successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error: duplicate email'], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred'], 500);
        }
    }
}
