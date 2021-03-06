@extends('admin.layouts.master')
@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.special-courses.index') }}">Special Courses List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add Course</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Course</h5>
                <hr>
                <form action="{{ route('admin.special-courses.store') }}" method="POST" enctype="multipart/form-data"
                id="courseForm">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="review">Course title<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" cols="3" rows="2" class="form-control">
                                    {{ old('description') }}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span style="color: red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="class_id">Class</label> --}}
                                <label for="review">Class</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class_id'))
                                    <span style="color: red;">{{ $errors->first('class_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="start_date">Start Date</label> --}}
                                <label for="review">Start Date<span class="text-danger">*</span></label>
                                <input type="date" id="start_date" class="form-control" name="start_date"
                                    value="{{ old('start_date') }}">
                                @if ($errors->has('start_date'))
                                    <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">End Date<span class="text-danger">*</span></label>
                                <input type="date" id="end_date" class="form-control" name="end_date"
                                    value="{{ old('end_date') }}">
                                @if ($errors->has('end_date'))
                                    <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Fees<span class="text-danger">*</span></label>
                                <input type="number" id="fees" class="form-control" name="fees"
                                    value="{{ old('fees') }}">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image"
                                    value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton" id="btn_submit">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // CKEDITOR.replace('description');
        $('#btn_submit').on("click",function(){
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "To create this course!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('courseForm').submit();
                    setTimeout(() => {
                        window.location.href = "{{ route('teacher.exam.index') }}";
                    }, 2000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'The COURSE has not been created :)',
                        'error'
                    )
                }
            })
        });
    </script>
@endsection
