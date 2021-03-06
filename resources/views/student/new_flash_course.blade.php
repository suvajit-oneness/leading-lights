@extends('student.layouts.master')
@section('title')
    Flash Course
@endsection
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-upload"></i>
                    </div>
                    <div>Available Flash Courses
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header-title mb-4">
                            Available Flash Courses
                        </div>
                        @if($courses)
                            <form action="{{ route('user.add_flash_courses') }}" method="post">
                                @csrf
                                <div class="row course_item m-0">
                                    @foreach($courses as $course)
                                        <div class="col-md-4 plr-2">
                                            <div class="items card" id="course_box{{ $course->id }}">
                                                <div class="course-box">
                                                    <h4>{{ $course->title }}</h4>
                                                    <ul class="mb-0">
                                                        <li>Monthly Fees : <b>&#8377;{{ $course->fees }}</b>
                                                        </li>
                                                        <li>Start Date : <b>{{ date('d-F-Y',strtotime($course->start_date)) }}</b></li>
                                                    </ul>
                                                    <div class="sec_check">
                                                        <input class="form-check-input-field largerCheckbox" type="checkbox"
                                                        value="{{ $course->id }}" id="course_id{{ $course->id }}"
                                                        name="course_id[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <hr>
                                <span class="err-text text-danger"></span>
                                <input type="submit" value="Proceed" class="btn-pill btn btn-primary btn-lg"
                                    id="submit_btn">
                            </form>
                        @else
                            <div class="col-md-3">
                                <div class="align-items-center">
                                    <span class="text-bold text-center text-capitalize">Currently No Courses
                                        Available</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('student.layouts.static_footer')
</div>
<script>
    $('input[type="checkbox"]').click(function () {
        if ($(this).prop('checked') == true) {
            let course_id = $(this)[0].value;
            $(`#course_box${course_id}`).addClass('bg-dark');
        }
        if ($(this).prop('checked') == false) {
            let course_id = $(this)[0].value;
            $(`#course_box${course_id}`).removeClass('bg-dark');
        }
    });

</script>
@endsection
