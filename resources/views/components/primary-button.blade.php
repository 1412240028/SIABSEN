<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-primary border border-transparent rounded-lg font-label-medium text-label-medium text-white hover:bg-primary-container focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 active:bg-primary-container transition-colors shadow-sm']) }}>
    {{ $slot }}
</button>
