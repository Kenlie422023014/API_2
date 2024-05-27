<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Interior;

class InteriorController extends Controller
{
    /**
     * Display a listing of item
     * 
     * @return\Illuminate\Http\Response
     */

    public function index()
    {
        return Interior::get();
    }

    /**
     * store a newly created item in storage
     * 
     * @param\Illuminate\Http\Request $request
     * @return\Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try{
            $Interior = new Interior;
            $Interior -> fill($request->validated())->save();

            return $interior;
        }

        catch(\Exception $exception) {
            throw new HttpException(400,"Invalid Data - {$exception->getMessage}");
        }
    }

        /**
         * display the specified item
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $interior = Interior::findOrfail($id);

            return $interior;
        }

        /**
         * Update the specified item in storage
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */

        public function update(Request $request,$id)
            {
                if (!$id) {
                    throw new HttpException(400,"Invalid id");
                }
                
                try {
                    $interior = Interior::find($id);
                    $interior -> fill($request->validated()) ->save();

                    return $interior;
                }

                catch(\Exception $exception){
                    throw new HttpException(400,"Invalid Data - {$exception->getMessage}");
                }
            }

            /**
             * Remove the specified item from storage.
             * 
             * @param int $id
             * @return \Illuminate\Http\Response
             */

             public function destroy($id)
             {
                $interior = Interior::findOrfail($id);
                $interior->delete();

                return response()->json(null,204);
             }
    }
