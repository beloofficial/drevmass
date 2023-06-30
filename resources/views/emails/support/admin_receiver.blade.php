<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach
{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{!! $salutation !!}

</x-mail::message>
