<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::paginate(5);
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
    public function store(CategoryRequest $request)
    {
        try {
            $data = Category::create($request->all());
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
        $data = Category::with('product')->find($id);
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
    public function update(CategoryRequest $request, $id)
    {
        try {
            $data = Category::find($id)->update($request->all());
            $code = 400;
            $response = [
                'status'=>false,
                'msg'=>'Failed updated Product'
            ];
            if ($data) {
                $response = [ 'status' => true, 'data' => Category::find($id) ];
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
            $data = Category::findOrFail($id)->delete();
            $response = ['status' => true];
            return response()->json($response,200);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()],200);
        }
    }
}
