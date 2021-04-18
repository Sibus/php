<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/{userId}/balance",
     *     tags={"User"},
     *     @OA\Parameter(name="userId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="User balance",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(property="balance", type="string")
     *         ),
     *     )
     * )
     */
    public function balance($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json([
            'balance' => $user->profile->balance,
        ]);
    }
}
