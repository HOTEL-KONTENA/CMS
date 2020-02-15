@extends('template.backend')

@section('menu_promotion')
	active
@stop

@push('content')
<div class="row">
    <div class="col-12">

		@include('components.backend.alertbox')

        <div class="card card-chart">
            <div class="card-header pb-4">
                <div class="row">
					<div class="col-sm-6 text-left pt-3">
						<h2 class="card-title mb-0"> {{ $page_attributes->title }} <small class="card-title">/ {{ $page_attributes->sub_title }}</small></h2>
					</div>
                    <div class="col-sm-6 text-right pt-2">
						<a href="{{ route('backend.promotion.edit', ['id' => $page_datas->id ]) }}" class="btn btn-sm btn-primary btn-simple"><i class="fa fa-edit"></i>&nbsp; Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-simple" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>&nbsp; Delete</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="col-12 pb-4">
					<div class="row">
						<div class="col-12 text-capitalize">
							<h4>{{ $page_datas->datas->title }}</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 mb-3">
							<p>Project Cover :</p>
							<img src="{{ asset($page_datas->datas->cover_image) }}" class="normal pb-4 pr-4 pl-0" alt="logo">
							<br />
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-12"><br></div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Promotion Title :</p>
								</div>
								<div class="col-7 col-md-9">
									<p class="text-capitalize">{{ $page_datas->datas->title }}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Start At :</p>
								</div>
								<div class="col-7 col-md-9">
									<p>
                                        {{ Carbon\Carbon::parse($page_datas->datas['start_at'])->format('d-m-Y H:i') }}
                                    </p>
								</div>
                            </div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>End At :</p>
								</div>
								<div class="col-7 col-md-9">
									<p>
                                        {{ Carbon\Carbon::parse($page_datas->datas['end_at'])->format('d-m-Y H:i') }}
                                    </p>
								</div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Description :</p>
								</div>
								<div class="col-7 col-md-9">
									<p>{{ $page_datas->datas->description }}</p>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12"></br></div>
					</div>

					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.promotion.index') }}" class="btn btn-outline-primary">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endpush

@push("modals")
	@include('components.backend.deleteModal', [
		'title' => 'data',
		'route' => route('backend.promotion.destroy', ['id' => $page_datas->id])
	])
@endpush
