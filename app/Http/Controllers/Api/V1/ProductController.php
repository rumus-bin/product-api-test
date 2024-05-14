<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="support@example.com"
 *      ),
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     operationId="getProductsList",
     *     tags={"Products"},
     *     summary="Get list of products",
     *     description="Returns list of products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=11),
     *                     @OA\Property(property="title", type="string", example="Est cumque porro vel doloremque est vitae."),
     *                     @OA\Property(property="description", type="string", example="Qui perspiciatis vel quas asperiores eos sint consequuntur. Consectetur et tempora vel ex commodi adipisci. Sed provident quo a dolorum expedita voluptate. Dignissimos id dolore vel veritatis."),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="May 14th, 2024 02:36:46"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-14 14:36:46")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                 @OA\Property(property="first", type="string", example="http://localhost:8096/api/v1/products?page=1"),
     *                 @OA\Property(property="last", type="string", example="http://localhost:8096/api/v1/products?page=3"),
     *                 @OA\Property(property="prev", type="string", example="http://localhost:8096/api/v1/products?page=1"),
     *                 @OA\Property(property="next", type="string", example="http://localhost:8096/api/v1/products?page=3")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=2),
     *                 @OA\Property(property="from", type="integer", example=11),
     *                 @OA\Property(property="last_page", type="integer", example=3),
     *                 @OA\Property(property="path", type="string", example="http://localhost:8096/api/v1/products"),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="to", type="integer", example=20),
     *                 @OA\Property(property="total", type="integer", example=25),
     *                 @OA\Property(
     *                     property="links",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="url", type="string", example="http://localhost:8096/api/v1/products?page=1"),
     *                         @OA\Property(property="label", type="string", example="&laquo; Previous"),
     *                         @OA\Property(property="active", type="boolean", example=false)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     security={
     *         {"sanctum": {}}
     *     }
     * )
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);

        $user = auth()->user();

        $stop = 1;

        return new ProductCollection(Product::paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products/{id}",
     *     operationId="getProductById",
     *     tags={"Products"},
     *     summary="Get product information",
     *     description="Returns product data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of product to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="title", type="string", example="Praesentium blanditiis possimus quam voluptate dolor."),
     *                 @OA\Property(property="description", type="string", example="Aliquam excepturi nemo et esse sed assumenda. Iusto optio ullam unde qui unde laborum nesciunt. Et natus minus sit et."),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="May 14th, 2024 02:36:46"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-14 14:36:46")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     security={
     *         {"sanctum": {}}
     *     }
     * )
     */
    public function get($id): ProductResource
    {
        return new ProductResource(Product::findOrFail($id));
    }
}
