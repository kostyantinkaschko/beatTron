<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SongRepository;
use App\Http\Resources\SongResource;
use App\Http\Requests\SongStorePostRequest;
use App\Http\Requests\SongStorePostApiRequest;

/**
 * @OA\Tag(
 *     name="Songs",
 *     description="Operations with songs"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local development server"
 * )
 * @OA\SecurityRequirement(name="bearerAuth")
 */
class SongsController extends Controller
{

    public function __construct(private readonly SongRepository $repository) {}

    /**
     * @OA\Get(
     *     path="/api/v1/songs",
     *     tags={"Songs"},
     *     summary="Get songs",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Song list",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SongResource"))
     *     )
     * )
     */
    public function index()
    {
        $songs = $this->repository->all();
        return SongResource::collection($songs);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/songs/{id}",
     *     tags={"Songs"},
     *     summary="Get one song",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Song id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="One song",
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * 
     * )
     */
    public function show($id)
    {
        $songs = $this->repository->find($id);
        return response()->json($songs);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/songs",
     *     tags={"Songs"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SongStorePostRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Song successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     )
     * )
     * 
     */
    public function store(SongStorePostRequest $request)
    {
        $song = $this->repository->create($request->validated());
        return new SongResource($song);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/songs/{id}",
     *     tags={"Songs"},
     *     summary="Update song",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Song id for update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"genre_id", "performer_id", "disk_id", "name", "listening_count", "year", "status"},
     *             @OA\Property(property="genre_id", type="integer", example="1"),
     *             @OA\Property(property="performer_id", type="integer", example="1"),
     *             @OA\Property(property="disk_id", type="integer", example="1"),
     *             @OA\Property(property="name", type="string", example="Omega Petya"),
     *             @OA\Property(property="listening_count", type="integer", example="1"),
     *             @OA\Property(property="year", type="integer", example="2023"),
     *             @OA\Property(property="status", type="string", example="public")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Song is not found"
     *     )
     * )
     */
    public function update(SongStorePostRequest $request, $id)
    {
        $song = $this->repository->update($id, $request->validated());
        return $song
            ? new SongResource($song)
            : response()->json(['message' => 'Song not found'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/songs/{id}",
     *     tags={"Songs"},
     *     summary="Destroy song",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Song id for destroying",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Song has been destroy",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Song deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Song is not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Song not found")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $song = $this->repository->delete($id);

        return $song
            ? response()->json(['message' => 'Song deleted successfully'])
            : response()->json(['message' => 'Song not found'], 404);
    }
}
