@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row p-3">
        <div class="col-md-12 text-center">
            <h2>Select an audio file</h2>
            <form method="POST" action="{{ route('calculate-length') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="audio_file">
                <button class="btn btn-success" type="submit">Calculate Length</button>
            </form>
        </div>
    </div>
</div>
@endsection