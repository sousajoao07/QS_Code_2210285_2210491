<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->has('page')){
            return ProductResource::collection(Product::paginate(5));
        }else{
            return ProductResource::collection(Product::all());
        }
    }

    public function getProductById($id){
        return new ProductResource(Product::find($id));
    }

    public function getProductsByCategoryId($category_id){
        return  (ProductResource::collection(Product::where('category_id',$category_id)->get()))->response()->setStatusCode(200);
    }

    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'required|min:5', 

        ]);
        $product= new Product();
        $product->fill($request->all());
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

            $product->image=$fileName;
        }else{
            return response()->json(['error' => 'Photo is required to finish the category create.'], 424);
        }

        $product->save();

        return response()->json(new ProductResource($product),201);
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'min:5', 

        ]);
        $data = $request->all();
        $product= Product::findOrFail($id);        
        $product->fill($request->all());
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

            $product->image=$fileName;
        }
        
        $product->save();
        return (new ProductResource($product))->response()->setStatusCode(200);
    }
    
    public function delete(Request $request, $id){
        $path=storage_path('app/public/').$request['image'];
        unlink($path);
        $product= Product::findOrFail($id);
        $product->delete();
          
        return response()->json(null,204);
    }


}
