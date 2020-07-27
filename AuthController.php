<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function customer_signup(Request $req){
        
        $messages=['phone.regex'=>'we need a valid phone number'];

        $rules=['phone'=>['bail',Rule::requiredIf($req->email==''), 'regex:/^[0-9]{10}$/'],  //unique pending
        'email'=>['bail',Rule::requiredIf($req->phone==''),'email','max:125'],
        'password'=>['required','min:6','max:25'],
        'first_name'=>['required'],
        'last_name'=>['required']];

        $validator=Validator::make($req->all(),$rules,$messages);
        if($validator->fails()){
            $data=['status'=>422,
                    'response'=>$validator->errors()   
                  ];
        }
        else{
            $phone=$req->phone?$req->phone:'';
            $email=$req->email?$req->email:'';
            $password=Hash::make($req->password);
            $first_name=$req->first_name;
            $last_name=$req->last_name;
            
            //create user
            
            if(!is_null($req->phone)){
                //send otp
            }
            if(!is_null($req->email)){
                //verify mail
            }

            $data=['status'=>201,
                'response'=>'signup successful'
        ];
        }
        return response()->json($data,$data['status']);    
    }

    
}
