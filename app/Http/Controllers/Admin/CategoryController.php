<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use App\Notifications\InvoicePaid;
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
        $data = $request->all();
        // dd($data);
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers]);
        $language = $client->request('GET', 'http://kien.godfath.com/api/v1/language'); 
        $content = json_decode($language->getBody()->getContents(), true);

        $language = $content['listlanguage'][$request->session()->get('language')]['language_code'];
        $text_value = '{"'.$language.':"'.$data['text_value'].'"}';
        $describe_value = '{"'.$language.':"'.$data['describe_value'].'"}';
        
        $result = $client->post('http://kien.godfath.com/api/v1/categories', [
            'form_params' => [
                'category_code' => $data['category_code'],
                'image' => $data['image'],
                'text_value' => $text_value,
                'describe_value' => $describe_value
            ]
        ]);
        $res = json_decode($result->getBody()->getContents(), true);
        if ($res['code'] == 200) {
            return redirect('admin/categories')->with('noti','Them thanh  cong');
        }else {
            return redirect('admin/categories');
        }
        
    }

    public function putEditCategory()
    {
      
    }

    public function deleteCategory(Request $request)
    {
        $data = $request->all();
        $headers = array('Authorization' =>'Bearer {'.$request->session()->get('token').'}');
        $client = new GuzzleHttpClient(['headers'=> $headers,'debug' => true]);
        $response = $client->delete('http://kien.godfath.com/api/v1/categories/'.$data['cat_id']);
        return redirect('admin/categories');
    }
}
