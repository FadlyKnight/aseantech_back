<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Product::query();
        if ($request->has('orderBy')) {
            
            $asc_desc = $request->has('is_desc') && $request->is_desc ? 'DESC' : 'ASC';
            $allowed = Product::$allowOrder;

            if (in_array($request->orderBy,$allowed)) {
                $data->orderBy($request->orderBy, $asc_desc);
            } else {
                $response = [
                    'status'=>true,
                    'msg'=> 'order by only allow '.implode(', ',$allowed)
                ];
                return response()->json($response,400);
            }   
        }
        
        if ($request->has('groupBy')) {
            $data->select('category_id', DB::raw('COUNT(id) as total_product'))
            ->groupBy('category_id');
            // select('')->groupBy('category_id');
            
        }

        $data = $data->paginate(5);
        $response = [
            'status'=>true,
            'data'=>$data
        ];
        return response()->json($response,200);
    }

    public function groupBy(){
        
        $data = Product::select('category_id', DB::raw('COUNT(id) as total_product'))
                        ->groupBy('category_id')->with([
                            'category' => function($q){
                                return $q->with('product');
                            }
                        ])->get();
        $response = [
            'status'=>true,
            'data'=>$data
        ];
        return response()->json($response,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = Product::create($request->all());
            $code = 400;
            $response = [
                'status'=>false,
                'msg'=>'Failed Create Product'
            ];
            if ($data) {
                $response = [ 'status' => true, 'data' => $data ];
                $code = 200;
            }
            return response()->json($response,$code);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::with('productDetail','category')->find($id);
        $response = [
            'status'=>true,
            'data'=>$data
        ];
        return response()->json($response,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $data = Product::find($id)->update($request->all());
            $code = 400;
            $response = [
                'status'=>false,
                'msg'=>'Failed updated Product'
            ];
            if ($data) {
                $response = [ 'status' => true, 'data' => Product::find($id) ];
                $code = 200;
            }
            return response()->json($response,$code);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Product::findOrFail($id)->delete();
            $response = ['status' => true];
            return response()->json($response,200);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()],200);
        }
    }
}
