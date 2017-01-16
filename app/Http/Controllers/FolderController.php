<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
class FolderController extends Controller
{
    public function getFolder(Request $request,$category_code, $translate_name_text)
    {
    	try {
            $tmp = explode('_', $translate_name_text);
            $client = new GuzzleHttpClient();
            $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/folder/20'); 
 
            $content = json_decode($categories->getBody()->getContents(), true);
            $categories= $content['metadata'];


            dd($category_code);

            foreach ($categories as $value) { 
                // dd($value['translate_name_text'][$request->session()->get('language')]['text_value']);
                if ($value['translate_name_text'][$request->session()->get('language')]['text_value'] == $category_code) {
                    break;
                } 
                 $i++;        
            }
            $category = $categories[$i];
            $folders = $categories[$i]['folder'];
            foreach ($folders as $value) {
                // dd($value['translate_name_text'][$request->session()->get('language')]['text_value']);
                if ($value['translate_name_text'][$request->session()->get('language')]['text_value'] == $translate_name_text) {
                    break;
                }
                $j++;
            }
            dd($folders[$j]);
          	$folder = $folders[$j];
            $packages = $folder['packages'];
            // $folders = $client->request('GET', 'http://kien.godfath.com/api/v1/folders/all/0'); 
 
            // $contents = json_decode($folders->getBody()->getContents(), true);
            // $folders = $contents['metadata'];
            // dd($request->session()->get('language'));
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
