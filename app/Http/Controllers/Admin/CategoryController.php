<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategoryId(Request $request,$id)
    {
      $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
      $client = new GuzzleHttpClient(['headers'=> $headers]);
      $category = $client->request('GET', 'http://kien.godfath.com/api/v1/category/'.$id); 

      $content = json_decode($category->getBody()->getContents(), true);
      $category = $content['metadata'];
      return $category;
    }

    public function getAllCategory()
    {
    	$client = new GuzzleHttpClient();
        $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 

        $content = json_decode($categories->getBody()->getContents(), true);
        $categories= $content['metadata'];
        return view('admin.manager-category')->with('categories', $categories);
    }
}
