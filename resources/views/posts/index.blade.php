@extends('layouts.master')

@section('content')
	<div class="main">
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Posts</h3>
									<div class="right">
										<a href="{{route('post.add')}}" class="btn btn-sm btn-primary">Add New Post</a>
									</div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
											<th>ID</th>
											<th>TITLE</th>
											<th>USER</th>
											<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
											<!-- uping untuk mengambil data siswa di database -->
										@foreach($posts as $post)
										<tr>
											<td>{{$post->id}}</td>
											<td>{{$post->title}}</td>
											<td>{{$post->user->name}}</td>	
											<td>
												<a target="_blank" href="{{route('site.single.post',$post->slug)}}" class="btn btn-info btn-sm">View</a>
												<a href="#" class="btn btn-warning btn-sm">Edit</a>
												<a href="{{ route('post.destroy', $post)}}" action="" method="post" class="btn btn-danger btn-sm delete">Delete</a>
											</td>
										</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('footer')
	<script>
		 $('.delete').click(function(){
		 	var post_id = $(this).attr('post-id');
		 	swal({
			  title: "Yakin?",
			  text: "Mau di Hapus siswa dengan No id "+post_id + " ??",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
				console.log(willDelete)
			  if (willDelete) {
			  	window.location = "/post/"+post_id+"/delete";
			  }
			});
		 });
	</script>
@stop