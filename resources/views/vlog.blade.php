@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <section id="vlog" class="all_corce_list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Recent Vlog</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                @foreach ($vlogs as $vlog)
                <div class="col-12 col-lg-4 mb-3">
                    <div class="card border-0 shadow-sm">
                        <a href="{{ route('vlogDetails',$vlog->id) }}">
                                @php
                                    $file_path = $vlog->file_path;
                                    $file_extension= explode('.',$file_path)[1];
                                @endphp
                                @if ($file_extension === 'jpg' || $file_extension === 'jpeg' || $file_extension === 'png')
                                <div class="bl_img">
                                    <img src="{{ asset($file_path) }}" alt="" class="img-fluid mx-auto">
                                </div>
                                @else
                                <div class="bl_img">
                                    <video class="img-fluid mx-auto" controls>
                                        <source src="{{ asset($file_path) }}" type="video/{{ $file_extension }}">
                                    Your browser does not support the video tag.
                                    </video>
                                </div>
                                @endif
                                <div class="card-body">
                                    <div class="date-sec">
                                        <i class="far fa-calendar-alt"></i>{{ date('M',strtotime($vlog->created_at)) }} <span>{{ date('d',strtotime($vlog->created_at)) }}</span>, {{ date('Y',strtotime($vlog->created_at)) }}
                                        {{-- <h5><i class="far fa-user"></i>By Admin</h5> --}}
                                    </div>
                                    <h2>{{ \Illuminate\Support\Str::limit($vlog->title,50) }}</h2>
                                    {!! \Illuminate\Support\Str::limit($vlog->description,350) !!}
                                    <span class="text-right">Read More <i class="fas fa-arrow-right ml-1"></i></span>
                                </div>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="row justify-content-end">
                    {{ $vlogs->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
