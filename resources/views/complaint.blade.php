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
    <form action="{{ route('complaints.store') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="complainterName" class="form-label">Complainter Name</label>
            <input type="text" name="complainterName" class="form-control" id="inputEmail4">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">discription</label>
            <textarea name="discription" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId"
                placeholder="abc@mail.com">
            <small id="emailHelpId" class="form-text text-muted">email most contain @ and .</small>
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
