<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
	<style>
    @import url(//fonts.googleapis.com/css?family=Lato:700);
    body {
      margin:0;
      font-family:'Lato', sans-serif;
      text-align:center;
      color: #999;
    }
    a, a:visited {
      text-decoration:none;
    }
    </style>
</head>
<body>
    <form action=" {{ route('upload') }} " method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="file" name="file">
        <input type="submit">
    </form>
	
</body>
</html>