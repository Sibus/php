<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     path="/users/{userId}/transactions",
     *     tags={"Transaction"},
     *     @OA\Parameter(name="userId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="Success response",
     *         @OA\JsonContent(ref="#/components/schemas/TransactionResource"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="value", type="string"),
     *             @OA\Property(property="description", type="string"),
     *         ),
     *     ),
     * )
     */
    public function store(Request $request, $userId)
    {
        $transaction = $this->service->create($userId, $request);

        return new TransactionResource($transaction);
    }

    /**
     * @OA\Post(
     *     path="/transactions/{transactionId}/refund",
     *     tags={"Transaction"},
     *     @OA\Parameter(name="transactionId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="Success response",
     *         @OA\JsonContent(ref="#/components/schemas/TransactionResource"),
     *     )
     * )
     */
    public function refund($transactionId)
    {
        $transaction = $this->service->refund($transactionId);

        return new TransactionResource($transaction);
    }
}
