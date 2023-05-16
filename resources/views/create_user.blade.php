<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
@php $date= date("Y-m-d H:i:s"); @endphp

<body>
    <form action="{{ route('users.store') }}" method="POST" class="row g-3">
        @csrf
        @method('POST')
        <div class="col-md-6">
            <label for="complainterName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-6">
            <label for="complainterName" class="form-label">User Name</label>
            <input type="text" name="userName" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-6">
            <label for="complainterName" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-6">
            <label for="complainterName" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" id="inputEmail4">
        </div>
        <input type="text" value=0 hidden name="userType" id="">
        <div class="col-md-6">
            <input type="text" hidden name="addressID" value="10" class="form-control" id="inputEmail4">
        </div>

        {{-- <div class="col-md-6"> --}}
        {{-- <input type="text" hidden name="userID" value="1" class="form-control" id="inputEmail4"> --}}
        {{-- </div> --}}
        <div class="mb">

            {{-- <input type="text" name="date" id="" value="{{ date('Y-m-d H:i:s') }}" hidden> --}}
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit Complaint</button>
        </div>
    </form>


    {{-- JavaScript Scripts --}}
    <script src="bootstrap.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>
