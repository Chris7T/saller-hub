<?php

namespace App\Http\Controllers\Client;

use App\Actions\Client\ClientListAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientListRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ClientListController extends Controller
{
    public function __construct(
        private ClientListAction $clientListAction
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/clients",
     *     summary="Lista de Clientes",
     *     tags={"Clients"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filtrar clientes pelo nome",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Listagem bem-sucedida de Clientes",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Client")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="The request could not be completed due to an unknown error.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     * )
     */
    public function __invoke(ClientListRequest $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $list = $this->clientListAction->execute($request->get('name'));
    
            return ClientResource::collection($list);
        } catch (\Exception $ex) {
            Log::critical('Controller: ' . self::class, ['exception' => $ex->getMessage()]);

            return Response::json(
                ['message' => config('messages.error.server')],
                HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
