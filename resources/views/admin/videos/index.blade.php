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
              <li><a href="#" class="active">All VLOG List</a></li>

          </ul>
      </div>
      @include('admin.layouts.navbar')
      </div>
      <hr>
	<div class="dashboard-body-content">
		<div class="d-flex justify-content-between align-items-center">
			<h5>Videos</h5>
			<a href="{{ route('admin.video.create') }}" class="actionbutton btn btn-sm">ADD Video</a>
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
			<table class="table table-sm table-hover" id="teacher_table">
				<thead>
					<tr>
						<th>Serial No</th>
						<th>Title</th>
						<th>Video Type</th>
                        <th>Amount</th>
						<th style="width:100px" class="text-center">Status</th>
						<th style="width:100px">Action</th>
					</tr>
				</thead>
				<tbody>
					 @foreach ($videos as $key => $video)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $video->title }}</td>
							<td>
								@if ($video->video_type == 1)
								<span class="badge badge-warning">Paid</span>
								@else
								<span class="badge badge-success">Free</span>
								@endif
							</td>
                            <td>
                                 {{ $video->amount ?  'Rs. '.$video->amount : 'N/A'}}
                            </td>
							<td class="text-center">
								@if ($video->status == 1)
								<span class="badge badge-success">Published</span>
								@else
								<span class="badge badge-warning">Inactive</span>
								@endif
							</td>
							<td>
								{{-- <a href="{{ route('admin.video.show',$video->id) }}"><i class="far fa-eye"></i></a> --}}
								<a href="{{ route('admin.video.edit',$video->id) }}" class="ml-2"><i class="far fa-edit"></i></a>
								<a href="javascript:void(0);" class="ml-2" data-toggle="modal" data-target="#exampleModal" onclick="deleteForm({{ $video->id }})"><i class="far fa-trash-alt text-danger"></i></a>
								<form id="delete_form_{{ $video->id }}" action="{{ route('admin.video.destroy',$video->id) }}" method="POST">
									@csrf
									@method('DELETE')
								</form></td>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
    </div>
    </div>
	<script>
	$(document).ready( function () {
        $('#teacher_table').DataTable();
    } );
	function deleteForm(id){
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
			document.getElementById('delete_form_'+id).submit();
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

		setTimeout(function(){
  			$(".alert-success").hide();
		}, 5000);
	</script>
 @endsection
