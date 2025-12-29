@props([
    'post' => null,
    'hasFile' => false,
])

@php
    $method = $post ? 'POST' : 'GET';
@endphp

<form {{ $attributes->class(['space-y-4']) }} method="{{ $method }}"
    @if ($hasFile) enctype="multipart/form-data" @endif>
    @csrf
    {{ $slot }}
</form>