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
      *     ),
      *     @OA\Parameter(
      *     name="_page",
      *     in="query",
      *     description="current page",
      *     required= true,
      *         @OA\Schema(
      *             type="integer",
      *             format="int64",
      *             example=1
      *         )
      *     ),
      *     @OA\Parameter(
      *     name="_limit",
      *     in="query",
      *     description="max item in a page",
      *     required= true,
      *         @OA\Schema(
      *             type="integer",
      *             format="int64",
      *             example=10
      *         )
      *     ),
      *     @OA\Parameter(
      *     name="_search",
      *     in="query",
      *     description="word to search",
      *     required= false,
      *         @OA\Schema(
      *             type="string",
      *         )
      *     ),
      *     @OA\Parameter(
      *     name="_producer",
      *     in="query",
      *     description="search by producer name",
      *     required= false,
      *         @OA\Schema(
      *             type="string",
      *         )
      *     ),
      *     @OA\Parameter(
      *     name="_sort_by",
      *     in="query",
      *     description="word to search",
      *     required= false,
      *         @OA\Schema(
      *             type="integer",
      *             example="latest"
      *         )
      *     ),
      * )
      */
     public function index(Request $request)
     {
       try {
            $data['filter'] = $request ->all();
            $page           = $data['filter']['_page'] =(@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
            $limit          = $data['filter']['_limit'] =(@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
            $offset         = ($page?($page-1)*$limit:0);
            $data['products']= Interior::whereRaw('1 = 1');

            if($request->get('_search')){
                $data['products'] = $data['products']->whereRaw('(LOWER(title) LIKE "%'.strtolower($request->get('_search')).'%" 
                OR LOWER (Producer) LIKE "%'.strtolower($request->get('_search')).'%")');
            }

            if ($request->get('_producer')){
                $data ['products']=$data ['products']->whereRaw ('LOWER(producer)="'.strtolower($request->get('_producer')).'"');
            }
            
            if ($request->get('_sort_by')){
                switch ($request->get('_sort_by')) {
                    default:
                    case 'latest_Producer':
                    $data['product']= $data['products']->orderBy('Year_produced');
                    break;
                    case 'latest_added':
                    $data['products'] = $data['products']->orderBy('created_at');
                    break;
                    case 'title_asc':
                    $data['products'] = $data['products']->orderBy('name','ASC');
                    break;
                    case 'title_desc':
                    $data['products'] = $data['products']->orderBy('name','DESC');
                    break;
                    case 'price_asc':
                    $data['products'] = $data['products']->orderBy('price','ASC');
                    break;
                    case 'price_desc':
                    $data['products'] = $data['products']->orderBy('price','DESC');
                    break;
                }}
                 $data['products_count_total'] = $data['products']->count();
                 $data['products']             = ($limit==0 && $offset==0)?$data['product']:$data['products']->limit($limit)->offset($offset);
                 // $data['products_raw_sql']  = $data['products]->toSql();
                 $data['products']             = $data['products']->get();
                 $data['products_count_start'] = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
                 $data['products_count_end']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
                 return response()->json($data,200);

        }       catch (\Exception $exception) {
            throw new HttpException(400, "invalid data : {$exception->getMessage()}");
        }
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