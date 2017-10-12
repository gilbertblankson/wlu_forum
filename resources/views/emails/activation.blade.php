<!DOCTYPE html>
<html>

<head>
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="http://test.walulel.co.uk/css/main.css" type="text/css">

</head>



<body>

<h1>Welcome to Walulel, {{$user->firstname}}</h1>
<p>Please activate your account with the link below:</p>
<p><a class="btn btn-success" target="_blank" href="http://localhost:8000/walulel/account/activation/{{$user->confirmation_code}}">Activate my account</a></p>
    
</body>
</html>