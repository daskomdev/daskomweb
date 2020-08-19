<!DOCTYPE html>
<html>
<head>
	<title>Daskom Photo Upload</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body>
	<div class="flex flex-col bg-green-800">
		<div class="container mx-auto px-4 bg-green-200">
		<span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-5xl">Update your profile photo</span>
		</br>
		<span class="ml-6 font-merri font-medium w-full text-start self-center text-2xl">Make sure the photo is in jpg and has your assistant code as filename</span>
        </br>
		<span class="ml-6 font-merri font-medium w-full text-start self-center text-xl">For example: AND.jpg</span>
            <h4 class="text-center my-5">Sorry i made this in quick, going to repair it soon! Click anywhere outside to go back</h4>
			<div class="col-lg-8 mx-auto my-5">	
 
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
				
				<form action="/upload/proses" method="POST" enctype="multipart/form-data" class="bg-green-400 shadow-md rounded px-8 pt-6 pb-8 mb-4">
					{{ csrf_field() }}
 
					<div class="mb-4 self-center">
						</br>
						<input type="file" name="file">
					</div>
					</br>
					<input type="submit" value="Upload" >
				</form>
			</div>
		</div>
	</div>
</body>
</html>