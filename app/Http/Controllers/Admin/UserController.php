<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getAllUser(Request $request)
    {
    	$headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      	$client = new GuzzleHttpClient(['headers'=> $headers]);
      	$members = $client->request('GET', 'http://kien.godfath.com/api/v1/admin/users/all/0'); 

      	$content = json_decode($members->getBody()->getContents(), true);
      	$members = $content['metadata'];
      	return view('admin.manager-member')->with('members', $members);
    }

    public function postUserMod(Request $request)
    {
      $data = $request->all();
      $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      $client = new GuzzleHttpClient(['headers'=> $headers]);
      $res = $client->request('POST', 'http://kien.godfath.com/api/v1/admin/user_mod', [
                'form_params' => [
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'name' => $data['name'],
                    'gender' =>$data['sex'],
                    'coin' => $data['coin'],
                    'deadline'=> $data['deadline']
                ]
            ]);
      $json = json_decode($res->getBody(),true);
      return redirect('/admin/manager-member');
    }

    public function getUserId(Request $request,$id)
    {
    	 $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      	$client = new GuzzleHttpClient(['headers'=> $headers]);
      	$users = $client->request('GET', 'http://kien.godfath.com/api/v1/admin/users/'.$id); 
      	$content = json_decode($users->getBody()->getContents(), true);
      	$user = $content['metadata'];
      	return response()->json($user);
    }
    public function deleteUserId(Request $request)
    {
    	$data = $request->all();
      // dd($data);
      // $data = ['uid'=>$data['delete-user-id']];
    	$headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      $client = new GuzzleHttpClient(['headers'=> $headers,'debug' => true]);
      $response = $client->delete('http://kien.godfath.com/api/v1/admin/users/delete/'.$data['delete-user-id']);
      return redirect('/admin/manager-member');
    }
}