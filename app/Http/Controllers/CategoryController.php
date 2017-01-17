<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;


class CategoryController extends Controller
{
    public function getListOfCategories(Request $request,$category_code)
    {
      if ($category_code != '') {
        try {
            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];
            $i = 0;
            foreach ($categories as $value) {
              $i++;
                if ($value['category_code'] == $category_code) {
                    break;
                }
            }

            $category= $categories[$i-1];
            // dd($category);
            $folders = $category['folder'];
            return view('frontend.category')->with('category', $category)->with('folders',$folders); 
      } catch (RequestException $re) {
          echo "con dada";
      }
      }
    	
    }

    public function createQuestion()
    {
        return view('frontend.createquestion');
    }
}
