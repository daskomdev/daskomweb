<!DOCTYPE html>
<html>
<head>
	<title>Daskom Photo Upload</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
</head>
<body>
	<div class="row">
		<div class="container">
			<h2 class="text-center my-5">Upload your Profile Photo here!</h2>
            </br>
			<h2 class="text-center my-5">Make sure its a jpg and named same as your Assistant code! (Ex: AND.jpg)</h2>
            </br>
            <h4 class="text-center my-5">Sorry i made this in quick, going to repair it soon!</h4>
			<div class="col-lg-8 mx-auto my-5">	
 
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
 
				<form action="/upload/proses" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
 
					<div class="form-group">
						<b>Your Profile Pic here</b><br/>
						<input type="file" name="file">
					</div>
 
					<input type="submit" value="Upload" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</body>
</html>