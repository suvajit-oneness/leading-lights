@extends('student.layouts.master')
@section('title')
    Testimonial
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Testimonial
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                  @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  <div class="card-header">Add Testimonial</div>
                    <form action="{{ route('user.testimonial') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label class="control-label">Testimonial Content (Word limit 250)<span class="text-danger">*</span> </label>
                          <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                          {{-- <input type="text" class="form-control" name="content" id="content" value="{{ old('content') }}"  required /> --}}
                          @if ($errors->has('content'))
                              <span style="color: red;">{{ $errors->first('content') }}</span>
                          @endif
                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id='update_profile'>Save</button>
                      </div>
                    </form>
                </div>

            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                  <div class="card-header">History Of Testimonial</div>
                      <div class="card-body">
                        @if ($testimonials->count() > 0)
                            @foreach ($testimonials as $testimonial)
                                <div>
                                    {{ $testimonial->content }}
                                </div>
                                <div class="font-weight-bold p-1">
                                    Added Date: {{ date('d-M-Y',strtotime($testimonial->created_at)) }}
                                    <br>
                                    {{-- Status :
                                    @if ($testimonial->status == 0)
                                        Pending
                                    @elseif ($testimonial->status == 1)
                                        Approved
                                    @elseif ($testimonial->status == 2)
                                        Rejected
                                    @endif --}}
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <h5 class="text-danger">No data found</h5>
                        @endif
                      </div>
                </div>

            </div>

        </div>
        @include('teacher.layouts.static_footer')
    </div>
@endsection
