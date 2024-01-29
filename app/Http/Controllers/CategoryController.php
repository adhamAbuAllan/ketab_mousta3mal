<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add(Request $request){
        $fields = [
            'name'=>"required",
        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            $res = [
                'status'=>false,
                'msg'=>$msg,
                'data'=>null
            ];
            return response()->json($res,404);
        }
        $name =  $request->name;
        $data = Category::create([
            'name'=>$name,
        ]);

        return $this->success($data);
    }

}
