@if(session()->has('success'))
    <div class="alert alert-success" role="alert" style="font-size: 20px;">
        @lang(session()->get('success'))
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger" role="alert" style="font-size: 20px;">
        @lang(session()->get('error'))
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="font-size: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif