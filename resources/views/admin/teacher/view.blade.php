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
                        <li><a href="{{ route('admin.teachers.index') }}">Teacher List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.teachers.show', $teacher->id) }}" class="active">Teacher
                                Details</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa fa-text-height"></i>
                                </div>
                                <div>Teacher Profile
                                </div>
                            </div>
                            <div class="ml-5">
                                @if ($teacher->status == 0)
                                    @if ($teacher->rejected == 0)
                                        <a href="{{ route('admin.teacher.approve', $teacher->id) }}"
                                            class="btn btn-info pull-right" onclick="activeAccount({{ $teacher->id }})"
                                            id="activeAccount">Approve</a>
                                        <a href="{{ route('admin.teacher.reject', $teacher->id) }}"
                                            class="btn btn-info pull-right mr-2"
                                            onclick="rejectAccount({{ $teacher->id }})" id="rejectAccount">Reject</a>
                                    @elseif ($teacher->rejected == 1 && $teacher->is_rejected_document_uploaded == 0)
                                        <button class="btn btn-info pull-right mr-2" data-toggle="tooltip"
                                            data-placement="top" title="This account is  rejected">Rejected</button>
                                    @elseif ($teacher->rejected == 1 && $teacher->is_rejected_document_uploaded == 1)
                                        <a href="{{ route('admin.teacher.approve', $teacher->id) }}"
                                            class="btn btn-info pull-right" onclick="activeAccount({{ $teacher->id }})"
                                            id="activeAccount">Approve</a>
                                    @endif
                                @else
                                    <a href="{{ route('admin.teacher.approve', $teacher->id) }}"
                                        class="btn btn-danger pull-right" onclick="activeAccount({{ $teacher->id }})"
                                        id="activeAccount" data-toggl="tooltip">Deactivate</a>
                                    <a href="#" class="btn btn-info pull-right ml-2" id="RejectedAccount"
                                        style="display: none;">Rejected</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tabs-animation">
                        <div class="bg-edit2 p-4">
                            @if ($teacher->status == 1)
                                <h5 class="">This account is verified <i
                                        class="text-success fa fa-check-circle"></i></h5>
                            @elseif ($teacher->status == 0 && $teacher->rejected == 0)
                                <h5 class="">This account is not verified <i
                                        class="text-danger fa fa-exclamation-circle"></i></h5>
                            @elseif ($teacher->status == 0 && $teacher->rejected == 1)
                                <h5 class="">This account is rejected <i
                                        class="text-danger fa fa-times-circle"></i></h5>
                            @endif
                            <div class="row">
                                <div class="col-lg-5 col-sm-4">
                                    <img src="{{ asset($teacher->image ? $teacher->image : 'frontend/assets/images/avata3.jpg') }}"
                                        class="img-fluid mx-auto" width="60%" height="100%">
                                </div>
                                <div class="col-lg-7 col-sm-8 not2">
                                    <p>Joined-
                                        {{ $teacher->created_at ? date('d-m-Y', strtotime($teacher->created_at)) : 'N/A' }}
                                    </p>
                                    <h4 class="mb-4">{{ $teacher->first_name }}
                                        {{ $teacher->last_name }}<span class="ml-3">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                        </span></h4>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Address:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p id="address">{{ $teacher->address ? $teacher->address : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Mob. No:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>
                                                @if ($teacher->country_code)
                                                    {{ $teacher->mobile ? '+' . $teacher->country_code . ' ' . $teacher->mobile : 'N/A' }}
                                                @else
                                                    {{ $teacher->mobile ? $teacher->mobile : 'N/A' }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Email Id:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>{{ $teacher->email ? $teacher->email : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Employee ID:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>{{ $teacher->id_no ? $teacher->id_no : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Academic Qualification:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            @php
                                                $qualification = App\Models\Qualification::find($teacher->qualification_id);
                                            @endphp
                                            <p id="qualification">
                                                {{ $teacher->qualification_id ? $qualification->name : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-header-title font-size-lg text-capitalize mb-4">
                                                Expertise in Subject Area
                                            </div>
                                            <p>Math / Physice / Chemistry<span class="ml-3"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-header-title font-size-lg text-capitalize mb-4">
                                                Certificate & Documents
                                            </div>
                                            <ul class="list">
                                                @forelse ($certificates as $certificate)
                                                    <li>
                                                        {{-- <img src="{{ asset($certificate->image) }}"
                                            class="img-fluid mx-auto w-100"> --}}
                                                        <a href="{{ asset($certificate->image) }}" target="_blank"
                                                            class="img-fluid mx-auto w-100">Upload
                                                            documents on
                                                            <span
                                                                title="Update on">{{ date('Y-m-d', strtotime($certificate->created_at)) }}</span>
                                                            <i class="fas fa-arrow-right"></i></a>
                                                    </li>
                                                @empty
                                                    <li>Not Available</li>
                                                @endforelse
                                            </ul>
                                            {{-- <div class="d-sm-flex align-items-baseline justify-content-between">
											<label class="check">PRESENT<span class="ml-2"><i
														class="fa fa-check-circle text-success"></i></span></label>
										</div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-right">
                                <ul class="header-megamenu nav">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            Copyright &copy; 2021 | All Right Reserved
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function activeAccount(teacher_id, status) {
            event.preventDefault();
            let url = $("#activeAccount").attr('href');
            let data = {
                teacher_id: teacher_id,
                status: status
            };
            $.ajax({
                url: url,
                type: "PUT",
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $("#activeAccount").text('Loading...')
                },
                success: function(response) {
                    if (response.data === 'activated') {
                        $("#activeAccount").text('Approved');
                    } else {
                        $("#activeAccount").text('Pending');
                    }
                }
            })

        }

        function rejectAccount(student_id) {
            event.preventDefault();
            let url = $("#rejectAccount").attr('href');
            let data = {
                student_id: student_id
            };
            $.ajax({
                url: url,
                type: "PUT",
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $("#rejectAccount").text('Loading...')
                },
                success: function(response) {
                    if (response.data === 'rejected') {
                        location.reload();
                    }
                }
            })

        }
    </script>
@endsection
