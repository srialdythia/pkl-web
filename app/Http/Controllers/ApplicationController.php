<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\BusinessUnit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductTypeCategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index(){
        $applications = Application::all();
        $businessUnits = BusinessUnit::all();
        $applicationTypes = ApplicationType::all();
        $productTypes = ProductType::all();
        $productTypeCategory = ProductTypeCategory::all();

        return view('index', [
            'businessUnits' => $businessUnits,
            'applicationTypes' => $applicationTypes,
            'productTypes' => $productTypes,
            'productTypeCategories' => $productTypeCategory,
            'applications' => $applications
        ]);
    }
    public function store(Request $request)
    {
        $product_no = $request["product_no"];
        $validatedData = $request->validate([
            'business_unit_id' => 'required',
            'requestor_name' => 'required',
            'application_type_id' => 'required',
            'application_date_created' => 'required',
            'product_type_id' => 'required',
            'requestor_name' => 'required',
            'product_type_category_id' => 'nullable',
        ]);

        if(!isset($request["product_type_category_id"])){
            $validatedData["product_type_category_id"] = null;    
        }
        
        $validatedData["application_no"] = Str::random(20);
        unset($validatedData["product_no"]);
        $app= Application::create($validatedData);

        foreach($product_no as $pn){
            $product = Product::create([
                "product_no" => $pn
            ]);
            $app->products()->attach($product->id);
        }

        return redirect('/email/sendEmailBroadCastSubmitPermintaan/'.$app->id);
    }

    public function update(Request $request){
        Application::where('id', $request->application_id)->update(["document_due_date"=>$request->document_due_date]);
        return redirect('/application/reply/'.$request->application_id)->with('success','application has been updated');
    }

    public function getProductTypeCategory(Request $request){
        $productType = productType::where('id','=',$request->productType)->first();
        return response()->json([
            'success' => true,
            'data' => $productType->productTypeCategories
        ]);
    }

    public function checkProductNo(Request $request){
        $product = Product::where('product_no', '=', $request->productNo)->first();
        if($product == null){
            return response()->json([
                'isExist' => false,
            ]);
        }
        return response()->json([
            'isExist' => true,
        ]);
    }

    public function reply(Application $application){
        $applications = Application::all();
        $businessUnits = BusinessUnit::all();
        return view('application/reply',[
            'app' => $application,
            'businessUnits' => $businessUnits,
            'applications' => $applications
        ]);
    }

    public function getUser(Request $request){
        $users = User::where('business_unit_id','=',$request->buId)->get();
        if (count($users) == 0) {
            return response()->json([
                'isExist' => false,
            ]);
        }
        return response()->json([
            'isExist' => true,
            'users' => $users
        ]);
    }


}
