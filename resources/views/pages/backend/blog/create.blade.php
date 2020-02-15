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
					<div class="col-sm-6 text-left">
						<h2 class="card-title pt-3 mb-0"> {{ $page_attributes->title }} <small class="card-title">/ {{ $page_attributes->sub_title }}</small></h2>
					</div>
					<div class="col-sm-6 text-right">
						{{-- <a href="{{ route('backend.user.edit', ['id' => 1]) }}" class="btn btn-info btn-round ml-auto">
							<i class="fa fa-pencil"></i> <span class="d-none d-sm-inline">Edit User</span>
						</a> --}}
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="col-12">

					{!! Form::open([
						'url' => $page_datas->id ? route('backend.blog.update', ['id' => $page_datas->id]) : route('backend.blog.store'),
						'files' => true
					])!!}
						{{ $page_datas->datas ? method_field('PUT') : ''}}
						{{ Form::token() }}

						<div class="row">
							<div class="col-12">
								<h4>Post Detail</h4>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-sm-8 col-md-8 pt-3">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Title</label>
											{{  Form::text('title', $page_datas->id ? $page_datas->datas->title : null, ['class' => 'form-control']) }}
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Published At</label>
                                            @php
                                                $published_at = $page_datas->id ? date_create($page_datas->datas->published_at) : null;
                                            @endphp
											{{  Form::text('published_at', $page_datas->id ? date_format($published_at,"d/m/Y") : null, ['class' => 'form-control', 'id' => 'date_picker']) }}
										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label>External Link</label>
											{{  Form::text('external_link', $page_datas->id ? $page_datas->datas->external_link : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
                            </div>
							<div class="col-12 col-sm-4">
								<div class="form-group">
								 <label>Cover Image</label>
								  <input type='file' id="imgInp" name="image" />
								  <img id="blah" src="{{ $page_datas->id ? $page_datas->datas->cover_image : asset('img/noimage.png') }}" alt="your image" />
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-12 pt-3">
								<div class="form-group">
									<label>Content</label>
									<div id="editor"></div>
									{{  Form::hidden('content', null, ['id' => 'content']) }}
								</div>
							</div>
						</div> -->

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="form-group">
									<a href="{{ $page_datas->id ? route('backend.blog.show', ['id' => $page_datas->id]) : route('backend.blog.index') }}" class="btn btn-outline-primary">Cancel</a>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
    </div>
</div>
@endpush


@push('scripts')
	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#blah').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#imgInp").change(function() {
	  readURL(this);
	});

    $('#date_picker').datetimepicker({
        inline: true,
        sideBySide: true
    }).data("DateTimePicker").format('DD-MM-YYYY HH:mm').clear().hide();
@endpush
