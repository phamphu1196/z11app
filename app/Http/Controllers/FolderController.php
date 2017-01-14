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
    	try {
            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 
 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];
            $i = 0;
            $j = 0;
            foreach ($categories as $value) {
                $i++;
                if ($value['category_code'] == $category_code) {
                    break;
                }
                
            }
            $category = $categories[$i-1];
            $folders = $categories[$i-1]['folder'];
            foreach ($folders as $value) {
              $j++;
                if ($value['translate_name_text'][0]['text_value'] == $translate_name_text) {
                    break;
                }
            }
          	$folder = $folders[$j-1];
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
    	try {
            $data = $request->all();
            
            $headers = array([
                'Authorization'=> 'Bearer {'.$request->session()->get('token').'}'
            ]);
            $client = new GuzzleHttpClient(['headers' => $headers]);
            // dd($token);
            $json_text_value = '{"'.$request->session()->get('language').'":"'.$data['text_value'].'"}';
            $json = '';
            $res = $client->request('POST', 'http://kien.godfath.com/api/v1/folders', [
                'form_params' => [
                    'category_id' => $data['category_id'],
                    'text_value' => $data['text_value'],
                    'describe_value' => $data['describe_value']
                ]
            ]);
            dd($res);
            $json = json_decode($res->getBody(),true);
            dd($json);
            
            return redirect('/');       
        } catch (ClientErrorResponseException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
        }
      
    }
}
