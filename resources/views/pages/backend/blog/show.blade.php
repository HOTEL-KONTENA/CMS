@extends('template.backend')

@section('menu_blog')
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
						<a href="{{ route('backend.blog.edit', ['id' => $page_datas->id ]) }}" class="btn btn-sm btn-primary btn-simple"><i class="fa fa-edit"></i>&nbsp; Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-simple" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>&nbsp; Delete</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="col-12 pb-4">
					<div class="row">
                        <div class="col-md-4">
							<img src="{{ asset($page_datas->datas->cover_image) }}" class="normal pb-4 pr-4 pl-0" alt="profile">
							<br />
						</div>
						<div class="col-md-8">
                            <div class="row">
                                <div class="col-3">
                                    <p>Title :</p>
                                </div>
                                <div class="col-9">
                                    <p class="text-capitalize">{{ $page_datas->datas->title }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p>Published At :</p>
                                </div>
                                <div class="col-9">
                                    <p>
                                        @php
                                        $published_at = date_create($page_datas->datas->published_at);
                                        echo date_format($published_at,"d M Y");
                                        @endphp
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p>External Link :</p>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <a href="{!!$page_datas->datas->external_link!!}" target="_blank">
                                            {!! $page_datas->datas->external_link !!}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-12 pt-3">
                                    <p>Article :</p>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-12 pt-3">
                                    {!! $page_datas->datas->content !!}
                                </div>
                            </div> -->
                        </div>
					</div>

					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.blog.index') }}" class="btn btn-outline-primary">Back</a>
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
		'route' => route('backend.blog.destroy', ['id' => $page_datas->id])
	])
@endpush


