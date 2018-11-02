<!DOCTYPE html>
<html>
<head>
    <title>demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
     <div class="col-md-8">
        <table class="table" border="1">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone No.</th>
                <th>Gender</th>
                <th>Nationality</th>
                <th>Date of Birth</th>
                <th>Education</th>
                <th>Preferred Mode of Contact</th>
            </thead>
            <tbody>
                <td>{{$data['name']}}</td>
                <td>{{$data['email']}}</td>
                <td>{{$data['address']}}</td>
                <td>{{$data['number']}}</td>
                <td>{{$data['gender']}}</td>
                <td>{{$data['nationality']}}</td>
                <td>{{$data['dob']}}</td>
                <td>{{$data['education']}}</td>
                <td>{{$data['contact']}}</td>
            </tbody>
        </table>
    </div>





</body>
</html>
