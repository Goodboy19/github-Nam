<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $where= [];
        if ($request->name){
            $where[] = ['name','like','%'.$request->name.'%'];
        };
        $users = User::orderBy('id','desc');
        if(!empty($where)){
            $users = $users->where($where);
        }
        $users=$users->get();
        if($users->count()>0){
            $status = 'Success';
        }
        else{
            $status = 'No data';
        }
        $users = UserResource::collection($users);
        $response = [
            'status'=> $status,
            'data'=> $users,
        ];
        return $response;
    }
    public function detail ($id){
        $user = User::find($id);
        if(!$user){
           $status = 'No Data';
        }
        else{
            $status = 'Success';
        }
        $user =  new UserResource ($user);
//        $response =[
//            'status' => $status,
//            'data' => $user
//        ];
        return $user;
    }

    public function create(Request $request){
        $rules =[
            'name'=>'required|min:5',
            'email'=>'email|required|unique:users',
            'password'=> 'required|min:8'
        ];
        $messages = [
            'name.required'=>'Tên bắt buộc phải nhập',
            'name.min'=>'Tối thiểu phải nhập 5 ký tự trở lên',
            'email.email'=>'Email chưa hợp lệ',
            'email.required'=>'Email bắt buộc phải nhập',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Mật khẩu bắt buộc phải nhập',
            'password.min'=>'Mật khẩu tối thiểu phải có 8 ký tự'
            ];
        $request->validate($rules,$messages);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->save();
        $response = [
            'status'=>'success',
            'data' => $user,
        ];
        return $response;
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        if(!$user){
            $reponse =
                [
                    'status'=>'No Data',

                ];
        }
        else{
            $method = $request->method();
            if ($method =='PUT'){
//            Tên phương thức bắt buộc viết hoa PUT, POST....
                $user->name = $request->name;
                $user->email  = $request->email;
                if ($request->password){
                    $user->password  = Hash::make($request->password);
                }
                else{
                    $user->password = null;
                }
                $user->save();

            }
            else{
                if ($request->name){
                    $user->name = $request->name;
                }
                if ($request->email){
                    $user->email = $request->email;
                }
                if ($request->password){
                    $user->password = Hash::make($request->password);
                }
                $user->save();
            }
            $reponse =
                [
                    'status'=>'sucess',
                    'data'=>$user
                ];
        }
        return $reponse;

    }

    public function delete(User $user){

       $status =  User::destroy($user->id);
       if($status){
           $response = [
               'status' =>'Delete succes'
           ];
       }
       else{
           $response = [
               'status' =>'Not Success'
           ];
       }
       return $response;
    }
}
