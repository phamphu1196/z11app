<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
class FolderController extends Controller
{
    public function getFolder($category_code, $translate_name_text)
    {
        // dd($translate_name_text);
    	try {
            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
            // dd($categories);
 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];
            // dd($categories);
            $i = 0;
            $j = 0;
            foreach ($categories as $value) {
                $i++;
                if ($value['category_code'] == $category_code) {
                    break;
                }
                
            }
            $category = $categories[$i-1];
            // dd($categories[$i-1]);
            $folders = $categories[$i-1]['folder'];
            foreach ($folders as $value) {
              $j++;
                if ($value['translate_name_text'][0]['text_value'] == $translate_name_text) {
                    break;
                }
            }
          	$folder= $folders[$j-1];
            // var_dump($folder);
            // dd($folder);
            $packages = $folder['packages'];
            // dd($packages);
            // dd($folders);
          	return view('frontend.folder')->with('category', $category)->with('folder', $folder)->with('packages',$packages); 
      } catch (RequestException $re) {
          echo "con dada";
      }
        
    }

    public function postAddFolder(Request $request)
    {
    	$data = $request->all();
      
    }
}
