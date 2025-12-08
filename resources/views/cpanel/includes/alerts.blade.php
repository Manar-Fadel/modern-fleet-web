@if ($errors->any())
    <div class="flex items-center gap-2 text-sm font-normal text-gray-700 mt-2">
        <div class="alert alert-danger" style="color: red; padding: 5px 25px; border-radius: 5px; background-color: #f2baba;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (Illuminate\Support\Facades\Session::has("error"))
    <div class="flex items-center gap-2 text-sm font-normal text-gray-700 mt-2">
        <div class="alert alert-danger" style="color: red; padding: 5px 25px; border-radius: 5px; background-color: #f2baba;">
            {{ Illuminate\Support\Facades\Session::get("error") }}
        </div>
    </div>
@endif


@if (Illuminate\Support\Facades\Session::has("message"))
    <div class="flex items-center gap-2 text-sm font-normal text-gray-700 mt-2">
        <div class="alert alert-success" style="color: green; padding: 5px 25px; border-radius: 5px; background-color: #d6fad6;">
            {{ Illuminate\Support\Facades\Session::get("message") }}
        </div>
    </div>
@endif
