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
						'url' => $page_datas->id ? route('backend.promotion.update', ['id' => $page_datas->id]) : route('backend.promotion.store')
					])!!}
						{{ Form::token() }}
						{{ $page_datas->datas ? method_field('PUT') : ''}}
						<div class="row">
							<div class="col-12">
								<h4>Promotion Detail</h4>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-7">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Promotion Title</label>
											{{  Form::text('title', $page_datas->id ? $page_datas->datas->title : null, ['class' => 'form-control']) }}
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Start At</label>
											{{  Form::text('start_at', $page_datas->id ? $page_datas->datas->start_at : null, ['class' => 'form-control', 'id' => 'picker_start']) }}
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>End At</label>
											{{  Form::text('end_at', $page_datas->id ? $page_datas->datas->end_at : null, ['class' => 'form-control', 'id' => 'picker_end']) }}
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Promotion Description</label>
											{{  Form::textarea('description', $page_datas->id ? $page_datas->datas->description : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
								 <label>Cover Image</label>
								  <input type='file' id="imgInp" name="image" />
								  <img id="blah" src="{{ $page_datas->id ? $page_datas->datas->cover_image : asset('img/noimage.png') }}" alt="your image" />
								</div>
							</div>

						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="form-group">
									<a href="{{ $page_datas->id ? route('backend.promotion.show', ['id' => $page_datas->id]) : route('backend.promotion.index') }}" class="btn btn-outline-primary">Cancel</a>
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

    $('#picker_end').datetimepicker({
        inline: true,
        sideBySide: true
    }).data("DateTimePicker").format('DD-MM-YYYY HH:mm').clear().hide();
    $('#picker_start').datetimepicker({
        inline: true,
        sideBySide: true
    }).data("DateTimePicker").format('DD-MM-YYYY HH:mm').clear().hide();
@endpush
