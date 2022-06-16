@foreach($form_data as $label => $value)
{!! ucwords(str_replace('_', ' ', $label)) !!}: {!! $value !!}
@endforeach