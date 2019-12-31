@extends('layouts.master')

@section('content')
<div class="main">
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Rangking 5 Besar</h3>
							</div>
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>RANGKING</th>
											<th>NAMA</th>
											<th>NILAI</th>
										</tr>
									</thead>
									<tbody>
										@php
											$ranking = 1;
										@endphp
										@foreach (rangking5Besar() as $s)
										<tr>
											<td>{{$ranking}}</td>
											<!-- harus di akhiri () karna dia function -->
											<td>{{$s->nama_lengkap()}}</td>
											<td>{{$s->rataratanilai}}</td>
										</tr>
										@php
											$ranking++;
										@endphp
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>	
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-user"></i></span>
								<p>
									<span class="number">{{totalSiswa()}}</span>
									<span class="title">Total Siswa</span>
								</p>
							</div>
						</div>
						<div class="metric">
								<span class="icon"><i class="fa fa-user"></i></span>
								<p>
									<span class="number">{{totalGuru()}}</span>
									<span class="title">Total Guru</span>
								</p>
						</div>
				</div>
			</div>
		</div>
	</div>
@stop