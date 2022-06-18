<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request){
        $query= Category::where('id', '>',0);
        if($request->has('page')){
            return CategoryResource::collection(Category::orderBy('name','asc')->paginate(10));
        }else{
            return CategoryResource::collection($query->orderBy('name','asc')->get());
        }
    }

    public function getCategoryById($id){
        return new CategoryResource(Category::find($id));
    }

    public function delete(Request $request, $id){
        $path=storage_path('app/public/').$request['image'];
        unlink($path);

        
        $category= Category::findOrFail($id);
        $category->delete();
        
        
        return response()->json(null,204);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required', 

        ]);
        $data = $request->all();
        $category= new Category();
        $category->fill($request->all());
        if(strpos($request->input('image'),'data:image/')!==false){
            $exploded=explode(',', $request->image);
            $decoded= base64_decode($exploded[1]);
            if(Str::contains($exploded[0],'jpeg')|| Str::contains($exploded[0],'jpg')){
                $extension='jpg';
            }else{
                $extension='png';
            }
            $fileName= Str::random().'.'.$extension;

            $path=storage_path('app/public/').$fileName;
            file_put_contents($path,$decoded);

            $category->image=$fileName;
        }else{
            return response()->json(['error' => 'Photo is required to finish the category create.'], 424);
        }

        $category->save();

        return response()->json(new CategoryResource($category),201);
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required', 

        ]);
        $data = $request->all();
        $category= Category::findOrFail($id);        
        $category->fill($request->all());
        if(strpos($request->input('image'),'data:image/')!==false){
            $exploded=explode(',', $request->image);
            $decoded= base64_decode($exploded[1]);
            if(Str::contains($exploded[0],'jpeg')|| Str::contains($exploded[0],'jpg')){
                $extension='jpg';
            }else{
                $extension='png';
            }
            $fileName= Str::random().'.'.$extension;

            $path=storage_path('app/public/').$fileName;
            file_put_contents($path,$decoded);

            $category->image=$fileName;
        }
        
        $category->save();
        return (new CategoryResource($category))->response()->setStatusCode(200);
    }

}