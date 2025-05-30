<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PerformerResource;
use App\Repositories\PerformerRepository;
use App\Http\Requests\PerformersStorePostRequest;
use App\Models\Performer;

/**
 * @OA\Tag(
 *     name="Performers",
 *     description="Operations with performers"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local development server"
 * )
 * @OA\SecurityRequirement(name="bearerAuth")
 */
class PerformersController extends Controller
{

    public function __construct(private readonly PerformerRepository $repository) {}

    /**
     * @OA\Get(
     *     path="/api/v1/performer",
     *     tags={"Performers"},
     *     summary="Get performers",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Performer list",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PerformerResource"))
     *     )
     * )
     */
    public function index()
    {
        $performers = $this->repository->all();
        return PerformerResource::collection($performers);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/performers/{id}",
     *     tags={"Performers"},
     *     summary="Get one performer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Performer id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="One performer",
     *         @OA\JsonContent(ref="#/components/schemas/PerformerResource")
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * 
     * )
     */
    public function show($id)
    {
        $performer = $this->repository->find($id);
        
        return new PerformerResource($performer);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/performers",
     *     tags={"Performers"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PerformersStorePostRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Performer successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/PerformerResource")
     *     )
     * )
     * 
     */
    public function store(PerformersStorePostRequest $request)
    {
        $performer = $this->repository->create($request->validated());
        return new PerformerResource($performer);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/performers/{id}",
     *     tags={"Performers"},
     *     summary="Update performer",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Performer id for update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "instagram", "facebook", "x", "youtube"},
     *             @OA\Property(property="name", type="string", example="Omega Petya"),
     *             @OA\Property(property="instagram", type="string", example="https://www.instagram.com/"),
     *             @OA\Property(property="facebook", type="string", example="https://www.facebook.com/"),
     *             @OA\Property(property="x", type="string", example="https://x.com/"),
     *             @OA\Property(property="youtube", type="string", example="https://www.youtube.com/")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/PerformerResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Performer is not found"
     *     )
     * )
     */
    public function update(PerformersStorePostRequest $request, $id)
    {
        $performer = $this->repository->update($id, $request->validated());
        return $performer
            ? new PerformerResource($performer)
            : response()->json(['message' => 'performer not found'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/performers/{id}",
     *     tags={"Performers"},
     *     summary="Destroy performer",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Performer id for destroying",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Performer has been destroy",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Performer deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Performer is not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Performer not found")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $performer = $this->repository->delete($id);

        return $performer
            ? response()->json(['message' => 'Performer deleted successfully'])
            : response()->json(['message' => 'Performer not found'], 404);
    }
}
