@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>

<body>
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%;">
        <a href="/" style="background-color: black"
            class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <svg class="bi me-2" width="30" height="24">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-5 fw-semibold">List group</span>
        </a>
        <div class="list-group list-group-flush border-bottom scrollarea">
            @php
                $i = 0;
                $arr = ['yellow', 'black'];
            @endphp
            @foreach ($Complaints as $Complaint)
                <a href="{{ route('response', $Complaint->id) }}"
                    style="background-color: {{ $arr[$i] }}; color: {{ $arr[$i] == 'yellow' ? 'black' : 'white' }}"
                    class="list-group-item list-group-item-action active py-3 lh-tight" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">{{ $Complaint->complainterName }}</strong>
                        <small>{{ Carbon::parse($Complaint->date)->format('l') }}</small>
                    </div>
                    <div class="col-10 mb-1 small">{{ $Complaint->discription }}
                    </div>
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">{{ $Complaint->email }}</strong>
                    </div>
                    <br>
                </a>
                @php
                    if ($i == count($arr) - 1) {
                        $i = 0;
                        continue;
                    }
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</body>

</html>
