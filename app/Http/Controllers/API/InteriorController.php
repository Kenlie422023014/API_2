<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Interior;

/**
 * class interior,
 * @author kenlie 
 */


 class InteriorController extends Controller
 {
     /**
      * @OA\Get(
      *     path="/api/interior",
      *     tags={"interior"},
      *     summary="Display a listing of items",
      *     operationId="index",
      *     @OA\Response(
      *         response=200,
      *         description="successful",
      *         @OA\JsonContent()
      *     )
      * )
      */
     public function index()
     {
         return Interior::get();
     }
 
     /**
      * @OA\Post(
      *      path="/api/interior",
      *      tags={"interior"},
      *      summary="Store a newly created item",
      *      operationId="store",
      *       @OA\Response(
      *           response=400,
      *           description="invalid input",
      *           @OA\JsonContent()
      *      ),
      *       @OA\Response(
      *           response=201,
      *           description="successful",
      *           @OA\JsonContent()
      *      ),
      *      @OA\RequestBody(
      *          required=true,
      *          description="Request body description",
      *          @OA\JsonContent(
      *              ref="#/components/schemas/Interior",
      *              example={ "name": "Sofa modern", "producer": "HadesInterior", "distributor": "Ace_Hardware", 
      *                        "Year_produced": "2004",
      *                        "image": ""            
      *              }
      *          ),
      *      ),
      *      security={{"passport_token_ready":{},"passport":{}}}
      * )
      */
     public function store(Request $request)
     {
         try {
             $validator = Validator::make($request->all(), [
                 'name' => 'required',
                 'producer' => 'required',
             ]);
             if ($validator->fails()) {
                 throw new HttpException(400, $validator->messages()->first());
             }
             $interiorss = new Interior;
             $interiorss->fill($request->all())->save();
             return $interiorss;
         } catch (\Exception $exception) {
             throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
         }
     }
 
     /**
      * @OA\Get(
      *      path="/api/interior/{id}",
      *      tags={"interior"},
      *      summary="Display the specified item",
      *      operationId="show",
      *      @OA\Response(
      *          response=404,
      *          description="item not found",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Response(
      *          response=400,
      *          description="invalid input",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Response(
      *          response=200,
      *          description="successful",
      *          @OA\JsonContent()
      *       ),
      *       @OA\Parameter(
      *            name="id",
      *            in="path",
      *            description="ID of item that needs to be displayed",
      *            required=true,
      *            @OA\Schema(
      *                type="integer",
      *                format="int64"
      *            )
      *      ),
      * )
      */
     public function show($id)
     {
         $interiorss = Interior::find($id);
         if (!$interiorss) {
             throw new HttpException(404, 'item not found');
         }
         return $interiorss;
     }
 
     /**
      * @OA\Put(
      *      path="/api/interior/{id}",
      *      tags={"interior"},
      *      summary="Update the specified item",
      *      operationId="update",
      *      @OA\Response(
      *          response=404,
      *          description="item not found",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Response(
      *          response=400,
      *          description="invalid input",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Response(
      *          response=200,
      *          description="successful",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Parameter(
      *          name="id",
      *          in="path",
      *          description="ID of item that needs to be updated",
      *          required=true,
      *          @OA\Schema(
      *              type="integer",
      *              format="int64"
      *          )
      *      ),
      *      @OA\RequestBody(
      *          required=true,
      *          description="Request body description",
      *          @OA\JsonContent(
      *              ref="#/components/schemas/Interior",
      *              example={ "name": "Sofa modern", "producer": "HadesInterior", "price": "175000", 
      *                        "description": "Sofa yang sangat empuk dan terlihat modern",
      *                        "image": ""            
      *              }
      *          ),
      *      ),
      *      security={{"passport_token_ready":{},"passport":{}}}
      * )
      */
     public function update(Request $request, $id)
     {
         $interiorss = Interior::find($id);
         if (!$interiorss) {
             throw new HttpException(404, "item not found");
         }
 
         try {
             $validator = Validator::make($request->all(), [
                 'name' => 'required',
                 'producer' => 'required',
             ]);
             if ($validator->fails()) {
                 throw new HttpException(400, $validator->messages()->first());
             }
             $interiorss->fill($request->all())->save();
             return response()->json(array('message' => 'Updated successfully'), 200);
         } catch (\Exception $exception) {
             throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
         }
     }
 
     /**
      * @OA\Delete(
      *     path="/api/interior/{id}",
      *     tags={"interior"},
      *     summary="Remove the specified item",
      *     operationId="destroy",
      *      @OA\Response(
      *          response=404,
      *          description="item not found",
      *          @OA\JsonContent()
      *      ),
      *       @OA\Response(
      *          response=400,
      *          description="invalid input",
      *          @OA\JsonContent()
      *      ),
      *       @OA\Response(
      *          response=200,
      *          description="successful",
      *          @OA\JsonContent()
      *      ),
      *      @OA\Parameter(
      *          name="id",
      *          in="path",
      *          description="ID of item that needs to be deleted",
      *          required=true,
      *          @OA\Schema(
      *              type="integer",
      *              format="int64"
      *          )
      *      ),
      *      security={{"passport_token_ready":{},"passport":{}}}
      *   )
      */
     public function destroy($id)
     {
         $interiorss = Interior::find($id);
         if (!$interiorss) {
             throw new HttpException(404, 'item not found');
         }
 
         try {
             $interiorss->delete();
             return response()->json(array('message' => 'Deleted successfully'), 200);
         } catch (\Exception $exception) {
             throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
         }
     }
 }