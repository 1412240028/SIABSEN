@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg text-body-sm font-body-sm bg-white transition-colors']) }}>
