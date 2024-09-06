@include('admin.layouts.header')
<body>
    <div class="row">
        <div class="col-sm-12">
            <span class="mb-3">
                {{$message}}
                @if (session()->has('message'))
                    {{session()->get('message')}}
                @endif
        </span>
            <span>Regards</span>
            <span>info@MedLegal.com</span>
            <a class="d-flex justify-content-center btn btn-primary">Continue</a>     
    </div>
</body>
</html>