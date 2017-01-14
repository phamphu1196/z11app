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
		$headers = array(['Authorization'=> 'Bearer {'.$request->session()->get('token').'}']);
		$client = new GuzzleHttpClient(['headers', $headers]);
		$categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0');
		$categories = json_decode($categories->getBody()->getContents(), true);
		$categories = $categories['metadata'];
		// dd($categories);
		return view('admin.dashboard')->with('categories', $categories);
	}

    public function getMember()
    {
    	$client = new GuzzleHttpClient();
		$categories = $client->request('GET', 'http://kien.godfath.com/api/v1/category/get/'.$id); 
      	

      	$content = json_decode($categories->getBody()->getContents(), true);
    	return view('admin.members');
    }
}
