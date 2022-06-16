@extends('templates.main')



@push('script')

<script>

function onSubmit(token) {
	console.debug(token);
	var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
	document.getElementById('timezone-input').setAttribute('value', timezone);
	document.getElementById('recaptcha').setAttribute('value', token);
	document.getElementById("contact-form").submit();
}

</script>

<script src="https://www.google.com/recaptcha/api.js"></script>

@endpush



@section('content')

<div class="container pt-3 pb-3 rounded">

	@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{!! $error !!}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<h2 id="send-a-message" class="text-center text-white pb-2">SEND US A MESSAGE</h2>

	<form id="contact-form" action="/forms/contact" method="post">

		<input id="timezone-input" name="timezone" type="hidden" value="">

		<input id="recaptcha" type="hidden" value="">

		{!! csrf_field() !!}

		<div class="row">
			<div class="offset-md-2 col-md-4 mb-3">
				<input type="email" class="form-control" placeholder="EMAIL" name="email" required>
			</div>
			<div class="col-md-4 mb-3">
				<input type="text" class="form-control" placeholder="NAME" name="name" required>
			</div>
		</div>

		<div class="row">
			<div class="offset-md-2 col-md-8 mb-3">
				<input type="text" class="form-control" placeholder="SUBJECT" name="subject" required>
			</div>
		</div>

		<div class="row">
			<div class="offset-md-2 col-md-8 mb-3">
				<textarea rows="5" class="form-control" placeholder="MESSAGE" name="message" required></textarea>
			</div>
		</div>

		<div class="row">
			<div class="offset-md-2 col-md-8 mb-3 text-end">
				<button type="button" class="g-recaptcha btn bg-white" data-sitekey="{!! _c('form.recaptcha.site_key') !!}" data-callback="onSubmit" data-action="submit">SUBMIT</button>
			</div>
		</div>

	</form>

</div>

@endsection