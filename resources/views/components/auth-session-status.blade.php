@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-status-hadir bg-green-50 p-3 rounded-lg border border-green-200']) }}>
        {{ $status }}
    </div>
@endif
