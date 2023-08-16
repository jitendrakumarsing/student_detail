@extends('layouts.site_layout')
@section('title')
Add Student
@endsection
@section('section')
<div class="container">
    <form name="student_form" id="student_form">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div>
            <label for="class">Class</label>
            <input type="number" class="form-control" name="class">
            {{-- <select name="class" class="form-select">
            <option selected disabled> select class </option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="">10</option>
        </select> --}}
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address">
        </div>
        <div>
            <label for="address">DOB</label>
            <input type="text" class="form-control" name="dob" placeholder="10 Jan 2000">
        </div>
        <div>
            <label for="address">Image</label>
            <input type="file" class="form-control" name="image">
        </div>

    </form>
    <a href="javascript:;" id="add_btn" class="btn btn-primary mt-2">Create Record</a>
</div>
@endsection
@section('page_script')
<script>
    $("#add_btn").click(function() {
        var formdata = new FormData($("#student_form")[0])
        // var formdata = new  $("#student_form").serializeArray();

        $.ajax({
            processData: false,
            contentType: false,
            cache: false,
            type: 'post',
            url: '{{ route('addstudent') }}',
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



