<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function getAllPackage()
    {
    	$client = new GuzzleHttpClient();
        $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 

        $content = json_decode($categories->getBody()->getContents(), true);
        $categories= $content['metadata'];
        // dd($categories);
        return view('admin.manager-package')->with('categories', $categories);
    }
}
