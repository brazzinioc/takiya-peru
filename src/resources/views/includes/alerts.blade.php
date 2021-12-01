
@if (session('status'))
    <div class="text-green-600 py-5" role="alert">
        {{ session('status') }}
    </div>
@endif


@if ($errors->any())
    <div class="py-5" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-500 text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
