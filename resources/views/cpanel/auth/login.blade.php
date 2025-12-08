@extends('cpanel.layout.login')
@section('content')
<div class="card max-w-[370px] w-full">
    <form action="{{ route("admin.login") }}" class="card-body flex flex-col gap-5 p-10" id="sign_in_form" method="post">
        @csrf
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-medium text-gray-900 leading-none mb-2.5">
                Sign in
            </h3>
            <div class="flex items-center justify-center font-medium">
               <span class="text-2sm text-gray-700 me-1.5">
                Admin Cpanel login
               </span>
            </div>
        </div>
        <div class="flex items-center gap-2">
          <span class="border-t border-gray-200 w-full">
          </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="form-label font-normal text-gray-900">
                Email
            </label>
            <input name="email" id="email" class="input" placeholder="email@email.com" type="text" value=""/>
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex items-center justify-between gap-1">
                <label class="form-label font-normal text-gray-900">
                    Password
                </label>
            </div>
            <div class="input" data-toggle-password="true">
                <input name="password" id="password" placeholder="Enter Password" type="password" value=""/>
                <button class="btn btn-icon" data-toggle-password-trigger="true" type="button">
                    <i class="ki-filled ki-eye text-gray-500 toggle-password-active:hidden">
                    </i>
                    <i class="ki-filled ki-eye-slash text-gray-500 hidden toggle-password-active:block">
                    </i>
                </button>
            </div>
        </div>
        <label class="checkbox-group">
            <input class="checkbox checkbox-sm" name="check" type="checkbox" value="1"/>
            <span class="checkbox-label">
               Remember me
            </span>
        </label>
        <button class="btn btn-primary flex justify-center grow">
            Sign In
        </button>
    </form>
</div>
@endsection
