@extends('layouts.site_layout')
@section('title')
Update Student
@endsection
@section('section')
<div class="container">
    <div>
        <h3>Update</h3>
    </div>
    <form name="update_form" id="update_form">
        @csrf
        <input type="hidden" name="id" value="{{ $student_detail[0]->id }}">
        <div>
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{ $student_detail[0]->name }}" name="name">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" class="form-control" value="{{ $student_detail[0]->phone }}" name="phone">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" class="form-control" value="{{ $student_detail[0]->email }}" name="email">
        </div>
        <div>
            <label for="class">Class</label>
            <input type="number" class="form-control" value="{{ $student_detail[0]->class }}" name="class">
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" class="form-control" value="{{ $student_detail[0]->address }}" name="address">
        </div>
        <div>
            <label for="dob">DOB</label>
            <input type="text" class="form-control" value="{{ $student_detail[0]->dob ?? '' }}" name="dob">
        </div>
        <div>
        <label for="dob">Image</label>
        <img class="d-block" src="{{asset('image')}}/{{ $student_detail[0]->image}}" alt="image" style="width: 50px; height:50px;">
       <input type="file" name="image" accept="jpg,png/*">
        </div>

    </form>
    <a href="javascript:;" id="update_btn" class="btn btn-primary mt-2">Update</a>
</div>
@endsection
@section('page_script')
<script>
    $("#update_btn").click(function() {
        var formdata = new FormData($("#update_form")[0])

        $.ajax({
            processData: false,
            contentType: false,
            cache: false,
            type: 'post',
            url: '{{ route('update_student') }}',
            data: formdata,
            success: function(response) {
                if (response.status == 1) {
                    alert(response.success_message);
                    window.location.href = '{{ route('student') }}';
                } else {
                    alert(response.error_message);
                }
            }
        })
    })
</script>
@endsection


