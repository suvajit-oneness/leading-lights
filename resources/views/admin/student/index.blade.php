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
                        <li><a href="{{ route('admin.students.index') }}" class="active">Student List</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Student (<small>Total: {{ $students->count() }}</small>)</h5>
                    
                    {{-- <a href="{{ route('admin.students.create') }}" class="actionbutton btn btn-sm">ADD STUDENT</a> --}}
                    <button type="button" class="actionbutton btn btn-sm" data-toggle="modal" data-target="#exampleModal">
                        ADD STUDENT
                    </button>
                </div>
                <hr>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive edit-table">
                    <table class="table table-sm table-hover" id="student_table">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Students Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Class</th>
                                <th>Spl. Course</th>
                                <th>Fl. Course</th>
                                <th style="width:100px" class="text-center">Status</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->id_no }}</td>
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        @if ($student->country_code)
                                            {{ $student->mobile ? '+' . $student->country_code . ' ' . $student->mobile : 'N/A' }}
                                        @else
                                            {{ $student->mobile ? $student->mobile : 'N/A' }}
                                        @endif

                                    </td>
                                    <?php
                                    $class_details = App\Models\Classes::find($student->class);
                                    ?>
                                    <td>
                                        @if ($class_details)
                                            <span
                                                class="text-success">{{ $class_details->name ? $class_details->name : '' }}</span>
                                        @else
                                            <span class="text-danger">N</span>
                                        @endif

                                    <td>
                                        <span class="text-info">
                                            @if ($student->special_course_ids !== null)
                                                <span class="text-success">Y</span>
                                            @else
                                                <span class="text-danger">N</span>
                                            @endif

                                        </span>


                                    </td>
                                    <td>
                                        @if ($student->flash_course)
                                            <span class="text-success">Y</span>
                                        @else
                                            <span class="text-danger">N</span>
                                        @endif
                                    </td>
                                    {{-- <td>{{ $course_details->title ? $course_details->title : 'N/A' }}</td> --}}
                                    <td class="text-center">
                                        @if ($student->status == 1 && $student->deactivated == 0)
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($student->status == 1 && $student->deactivated == 1)
                                            <span class="badge badge-danger">Deactivated</span>
                                        @elseif($student->rejected == 1)
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.students.show', $student->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="ml-2"><i class="far fa-edit"></i></a>
                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $student->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $student->id }}"
                                            action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.student.modal.filter')
    <script>
        $(document).ready(function() {
            $('#student_table').DataTable();
        });

        function deleteForm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data  is safe :)',
                        'error'
                    )
                }
            })
        }

        setTimeout(function() {
            $(".alert-success").hide();
        }, 5000);
    </script>
@endsection
