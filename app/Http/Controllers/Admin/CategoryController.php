<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Input;
use Google;
use Session;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Notifications\InvoicePaid;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function postUploadImage($file) {
        $name = $file->getClientOriginalName();
        $client = Google::getClient();
        
        // if (!$client->getAccessToken() && !Session::get('token')) {
        //  // dd(1);
        //     $authUrl = $client->createAuthUrl();

        //     echo "<p><a class='login' href='$authUrl'>Login in</a></p>";
     //     }

        // Step 2: The user accepted your access now you need to exchange it.
        // if (Input::has('code')) {
          
       //   $accessToken = $client->authenticate(Input::get('code'));
       //   dd($accessToken);
            $refreshToken = '1/EQf9qw6bDhAYVVfHZf5k8aFs_mAV2-AGKX6dTAh2Alk';
            $client->refreshToken($refreshToken);
        // }
        if($client->getAccessToken()) {
            $drive = Google::make('drive');
              $file = Google::make('Drive_DriveFile');
            $file->setName($name);
            $file->setDescription('A test picture');
            $file->setMimeType('image/jpeg');
                $file->setParents(array('0B4P1fd8eFWewSWtVbklQSlY0Zk0'));
            
            $data = file_get_contents('drive/save.jpg');
            $createdFile = $drive->files->create($file, array(
              'data' => $data,
              'uploadType' => 'media',
              'mimeType' => 'image/jpeg',
            ));
            $id = $createdFile->getId();
            $content = 'https://docs.google.com/uc?export=download&id='.$id;
            // echo " <img src='".$content."' alt=''> ";
            
            return $content;
        }
    }

    public function getCategoryId(Request $request,$id)
    {
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers]);
        $category = $client->request('GET', 'http://kien.godfath.com/api/v1/category/'.$id); 

        $content = json_decode($category->getBody()->getContents(), true);
        $category = $content['metadata'];
        return response()->json($category);
    }

    public function getAllCategory(Request $request)
    {
    	  $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers]);
        $categories = $client->request('GET', 'http://kien.godfath.com/api/v1/categories/all/0'); 

        $content = json_decode($categories->getBody()->getContents(), true);
        $categories= $content['metadata'];

        $members = $client->request('GET', 'http://kien.godfath.com/api/v1/admin/users/all/0'); 

        $content = json_decode($members->getBody()->getContents(), true);
        $members = $content['metadata'];

        return view('admin.manager-category')->with('categories', $categories)->with('members',$members);
    }

    public function postAddCategory(Request $request)
    {
        $file = $request->file('file');
        $image = $this->postUploadImage($file);
        $request->file('file')->move('drive', 'save.jpg');
        $data = $request->all();
        // dd($data);
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers]);
        $language = $client->request('GET', 'http://kien.godfath.com/api/v1/language'); 
        $content = json_decode($language->getBody()->getContents(), true);

        $language = $content['listlanguage'][$request->session()->get('language')]['language_code'];
        $text_value = '{"'.$language.'":"'.$data['text_value'].'"}';
        $describe_value = '{"'.$language.'":"'.$data['describe_value'].'"}';
        
        $result = $client->request('POST','http://kien.godfath.com/api/v1/categories', [
            'form_params' => [
                'category_code' => $data['category_code'],
                'image' => $image,
                'text_value' => $text_value,
                'describe_value' => $describe_value
            ]
        ]);
        $res = json_decode($result->getBody()->getContents(), true);
        if ($res['code'] == 200) {
            return redirect('admin/categories')->with('noti_secc_add','Them category thanh  cong');
        }else {
            return redirect('admin/categories')->with('noti_fail_add','khong the them category!!!');
        }
        
    }

    public function putEditCategory(Request $request)
    {
        $data = $request->all();
        dd($data);
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers]);
        $response = $client->request('GET','http://kien.godfath.com/api/v1/categories'.$data['cat_id']);
        $res = json_decode($response->getBody()->getContents(), true);
    }

    public function deleteCategory(Request $request)
    {
        $data = $request->all();
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers,'debug' => true]);
        $response = $client->delete('http://kien.godfath.com/api/v1/categories/'.$data['cat_id']);
        $res = json_decode($response->getBody()->getContents(), true);
        if($res['code'] == 200){
            return redirect('admin/categories')->with('noti_secc_delete','xoa thanh cong');
        }
        else {
            return redirect('admin/categories')->with('noti_fail_delete','chua xoa duoc category!!');
        }
        
    }
}
