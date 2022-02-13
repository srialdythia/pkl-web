<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\SendEmailRequirement;
use App\Mail\SendEmailSubmitPermintaanBroadcast;
use App\Models\Application;
use App\Models\BusinessUnit;
use App\Models\ProductType;
use App\Models\ProductTypeCategory;
use App\Models\ApplicationType;
use App\Models\User;

class EmailController extends Controller
{
    public function sendEmailRequirement(Request $request, Application $application){
        $emailcontents = [];
        forEach($request->document as $index=>$doc){
            $emailContent = [];
            $emailContent = [
                "application" => $application,
                "document" => $request->document[$index],
                "businessUnit" => BusinessUnit::where('id', '=', $request->business_unit_id[$index])->first()->name,
                "email" => User::where('id','=', $request->user_id[$index])->first()->email,
                "dueDateDocument" => $request->due_date_document[$index],
            ];
            $emailcontents[] = $emailContent;
            Mail::to($emailContent['email'])->queue(new SendEmailRequirement($emailContent));
        }
        return redirect('/application/reply/'.$application->id);
    }

    public function sendEmailBroadCastSubmitPermintaan(Application $application){
        $emailContent=[
            'application_no' => $application->application_no,
            'requestor_name' => $application->requestor_name,
            'application_type' => ApplicationType::where('id','=',$application->application_type_id)->first()->name,
            'product_type' => ProductType::where('id','=', $application->product_type_id)->first()->name,
            'type' => ProductTypeCategory::where('id','=', $application->product_type_category_id)->first()->name,
            'detail_specification' => $application->products,
            // 'url' => 'https://youtube.com/'
            'url' =>  'http://127.0.0.1:8000/application/reply/'.$application->id
        ];
        $userAdmin = User::where('role_id','=','1')->get();
        $userEmail=[];
        foreach($userAdmin as $admin){
            $userEmail[] =$admin->email; 
        }
        Mail::to($userEmail)->queue(new SendEmailSubmitPermintaanBroadcast($emailContent));
        return redirect('/')->with('success', 'application has been created');
    }

}
