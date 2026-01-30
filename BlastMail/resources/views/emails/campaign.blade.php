<x-mail::message>

{!! $body !!}

@if(isset($uuid))
<img src="{{ route('track.open', $uuid) }}" width="1" height="1" style="display: none;">
@endif
</x-mail::message>
