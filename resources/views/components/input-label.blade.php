@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-label-medium text-on-surface-variant']) }}>
    {{ $value ?? $slot }}
</label>
