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
						'url' => $page_datas->id ? route('backend.blog.update', ['id' => $page_datas->id]) : route('backend.blog.store')
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
									<br/>
									<img id="cover_image" src="{{ asset('img/noimage.png') }}" class="normal pr-4 pl-0" alt="cover image">
									<br />
									{{-- load data from old input --}}
									{{  Form::file('cover_image', [
										'class' => 'form-control image-send',
										"imagePreload" => ( $page_datas->id ? $page_datas->datas->cover_image : null )
									]) }}
									<small class="text-secondary"><i> *rasio gambar 4:3, ukuran file maks 200kb</i></small>
									<a href="#" class="btn btn-sm btn-outline-primary">Change</a>
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
	imageSend.setCsrfToken('{{ csrf_token() }}');
	imageSend.setUrl('{{ route('backend.media.upload.article') }}');

    $('#date_picker').datetimepicker({
        inline: true,
        sideBySide: true
    }).data("DateTimePicker").format('DD-MM-YYYY HH:mm').clear().hide();

	var quill = new Quill('#editor', {
        theme: 'snow',
        placeHolder: 'Enter your blog content here'
	});

	var blogPreload = '{!! old('content') ? old('content') : ($page_datas->datas && $page_datas->datas->content ? $page_datas->datas->content : null) !!}';
	if (blogPreload) {
		quill.root.innerHTML = blogPreload;
	}

	$('form').on('submit', function(e){
        <!-- e.preventDefault(); -->

		var length = quill.getLength();
		if (length > 1) {
			<!-- var tmp = JSON.stringify(quill.getContents()); -->
            <!-- var description = document.querySelector('input[name=content]'); -->
			$('#content').val(quill.container.firstChild.innerHTML);
            <!-- console.log(quil.container.firstChild.innerHTML) -->
		}else{
			$('#content').val(null);
		}


        // submit
        return true
	})
@endpush
