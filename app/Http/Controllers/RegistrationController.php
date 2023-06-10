<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
   public function register(){

   // dd('reached in Register method');
   $registertion_txt="welcome to registration page";
   return view ('register')->with(compact('registertion_txt'));
   }
   public function create_role(Request $request){    //creating 

      $role_data=[
         'name' => $request->role_name,
         'status' => $request->status,
         'created_by' =>1,
         'created_at' => date('Y-m-d h:i:s'),
      ];
      //dd($role_data);
      RoleModel::create($role_data);
      //calling rigister route
      return redirect()->away('/get_role_list/ALL/NA/ALL');
   }

//retreiving data
public function get_role_list($param_type,$id,$status){//parameter//pulling data by id and status
   if($param_type=="ALL"){//what type of data you want
    $response_data=RoleModel::get();
   }
   if($param_type=="BYID"){
      $response_data=RoleModel::where('id',$id)->get();
      //select *from t_role_master where id='?';
   }
   if($param_type=="status"){
      $response_data=RoleModel::where('status',$status)->get();
   }
   //select * from t_role_master;
   return view ('list_roles')->with(compact('response_data'));
 //select *from t_role_master where status="Active"
}
public function edit_roles($id){
   $data=RoleModel::where('id',$id)->first(); //edit 
   return view ('edit_roles')->with(compact('data'));
 
}//delete base on the id
public function delete_role($id){
   RoleModel::where('id',$id)->delete(); 
return redirect()->away('/get_role_list/ALL/NA/ALL');
}
public function update_role(Request $request){
   $role_data=[
      'name' => $request->role_name,
      'status' => $request->status,
      'updated_by' =>1,
      'updated_at' => date('Y-m-d h:i:s')
   ]; 
   //dd($role_data);
   RoleModel::where('id',$request->record_id)->update($role_data);
   //calling rigister route
   return redirect()->away('/get_role_list/ALL/NA/ALL');
}
}
