@props([
    'post' => null,
    'put' => null,
    'patch' => null,
    'delete' => null,
    'action' => null,
    'hasFile' => false,
])


@php
    $url = $action ?? $post ?? $put ?? $patch ?? $delete;
    $method = ($post || $put || $patch || $delete) ? 'POST' : 'GET';
    $spoofMethod = match (true) {
        (bool) $put => 'PUT',
        (bool) $patch => 'PATCH',
        (bool) $delete => 'DELETE',
        default => null,
    };
@endphp

<form {{ $attributes->except(['post', 'put', 'patch', 'delete', 'has-file'])->class(['space-y-4']) }} method="{{ $method }}" action="{{ $url }}"
    @if ($hasFile || $attributes->has('has-file')) enctype="multipart/form-data" @endif>
    @csrf
    @if($spoofMethod)
        @method($spoofMethod)
    @endif
    {{ $slot }}
</form>