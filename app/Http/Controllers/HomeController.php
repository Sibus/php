<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="Transactions API", version="0.1")
 */
class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Info"},
     *     @OA\Response(
     *         response="200",
     *         description="Application version",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(property="version", type="string")
     *         ),
     *     )
     * )
     */
    public function info()
    {
        return [
            'version' => app()->version() ,
        ];
    }
}
