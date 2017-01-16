<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function getDashboard(Request $request)
	{
		$headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      	$client = new GuzzleHttpClient(['headers'=> $headers]);

		$categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0');
		$categories = json_decode($categories->getBody()->getContents(), true);
		$categories = $categories['metadata'];

		$members = $client->request('GET', 'http://kien.godfath.com/api/v1/users/all/0'); 

      	$content = json_decode($members->getBody()->getContents(), true);
      	$members = $content['metadata'];

		return view('admin.dashboard')->with('categories', $categories)->with('members',$members);
	}

}
