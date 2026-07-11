<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-white border border-outline-variant rounded-lg font-label-medium text-label-medium text-on-surface-variant hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25 transition-colors shadow-sm']) }}>
    {{ $slot }}
</button>
