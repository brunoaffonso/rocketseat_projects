@props([
    'post' => null,
    'action' => null,
    'hasFile' => false,
])

@php
    $url = $post ?? $action;
    $method = $post || $attributes->has('post') ? 'POST' : 'GET';
@endphp

<form {{ $attributes->except(['post', 'has-file'])->class(['space-y-4']) }} method="{{ $method }}" action="{{ $url }}"
    @if ($hasFile || $attributes->has('has-file')) enctype="multipart/form-data" @endif>
    @csrf
    {{ $slot }}
</form>