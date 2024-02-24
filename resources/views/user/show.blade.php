@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row p-3">
        <div class="col-md-12 text-center">
            <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-6 border border-gray p-2">
                <span><b>Name</b></span>
            </div>
            <div class="col-md-6 border border-gray p-2">
                <span>{{$user->name}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 border border-gray p-2">
                <span><b>Email</b></span>
            </div>
            <div class="col-md-6 border border-gray p-2">
                <span>{{$user->email}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 border border-gray p-2">
                <span><b>Mobile No.</b></span>
            </div>
            <div class="col-md-6 border border-gray p-2">
                <span>{{$user->mobile_no}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 border border-gray p-2">
                <span><b>Profile Pic</b></span>
            </div>
            <div class="col-md-6 border border-gray p-2">
                <img class="rounded-3" src="{{ Storage::url($user->profile_pic) }}" alt="Profile Pic" style="max-width: 100px;">
            </div>
        </div>
    </div>
</div>
@endsection