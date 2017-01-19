<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Google;
use Session;
use Input;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class DriverController extends Controller
{
	public function getUploadImage()
	{
		return view('frontend.upload-image');
	}
    public function postUploadImage(Request $request) {
    	$name = $request->file('file')->getClientOriginalName();
    	$request->file('file')->move('drive', 'save.jpg');

    	$client = Google::getClient();
    	
    	// if (!$client->getAccessToken() && !Session::get('token')) {
    	// 	// dd(1);
	    //     $authUrl = $client->createAuthUrl();

	    //     echo "<p><a class='login' href='$authUrl'>Login in</a></p>";
     //  	}

      	// Step 2: The user accepted your access now you need to exchange it.
      	// if (Input::has('code')) {
          
       //  	$accessToken = $client->authenticate(Input::get('code'));
       //  	dd($accessToken);
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
        	echo " <img src='".$content."' alt=''> ";
        	
        	return $content;
    	}
    }
}
