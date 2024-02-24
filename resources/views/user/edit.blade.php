@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="row p-3">
            <div class="col-md-12 text-center">
                <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Update Form
                </div>
                <div class="card-body">
                    <div class="alert alert-danger d-none" id="error_message">
                        <ul>

                        </ul>
                    </div>
                    <form id="update_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" value="{{$user->name}}" type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input name="email" value="{{$user->email}}" type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input name="mobile_number" value="{{$user->mobile_no}}" type="tel" class="form-control" id="mobile" placeholder="Enter mobile number">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" value="{{$user->password}}" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="profile-pic">Profile Picture</label>
                            <input name="profile_pic" type="file" class="form-control-file" id="profile-pic">
                        </div>
                        <button type="button" class="btn btn-primary" id="update_btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#update_btn').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = new FormData(document.getElementById('update_form'));

            console.log('formdata', formData);

            // Send AJAX request
            $.ajax({
                url: '/user/' + @json($user->id),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#error_message').addClass('d-none');
                    // Handle success response
                    console.log(response);
                    alert('Record saved successfully!');
                },
                error: function(xhr, status, errors) {
                    // Handle error response
                    const errorMsg = xhr.responseJSON.error;
                    $.each(errorMsg, function(key, value) {
                        $('#error_message').removeClass('d-none');
                        console.log('value', value)
                        $('#error_message ul').append('<li>' + value + '</liv>');
                    })
                    console.error(xhr.responseJSON.errors);
                }
            });
        });
    });
</script>