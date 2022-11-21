<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['name']}} Payslip</title>

</head>
<body>

    <div style="display:flex justify-content:center">
        <div class="">
            header
        </div>

    </div>
    <div class="font-1 font-weight-bold">
        {{$data['name']}}
    </div>
    
    @if(!Route::is('admin.generatePDF.generate'))
    <a href="{{route('admin.generatePDF.generate')}}">Print</a>
    @endif
</body>
</html>