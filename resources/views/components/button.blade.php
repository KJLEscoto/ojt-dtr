@props([
    'label' => 'label',
    'labelClass' => '',
    'leftIcon' => '',
    'rightIcon' => '',
    'className' => '',
    'submit' => false,
    'button' => false,
    'routePath' => '',
    'closeModal' => false,
    'openModal' => false,
    'primary' => false,
    'secondary' => false,
    'tertiary' => false,
    'onClick' => '', // New: JavaScript function or event handler
])

@php
    $primaryClasses =
        'px-16 py-3 rounded-full relative overflow-hidden font-medium text-white flex items-center justify-center gap-2 animate-transition bg-gradient-to-r from-custom-orange via-custom-orange/70 to-custom-red hover:bg-custom-red';
    $secondaryClasses =
        'px-16 py-3 border rounded-full hover:bg-white border-white hover:text-custom-orange animate-transition flex items-center justify-center';
    $tertiaryClasses =
        'px-16 py-3 border rounded-full text-custom-orange hover:border-custom-orange animate-transition flex items-center justify-center gap-2';

    // Assign correct classes based on button type
    $buttonClass = $primary ? $primaryClasses : ($secondary ? $secondaryClasses : ($tertiary ? $tertiaryClasses : ''));

@endphp

<!-- Main Button -->
<button class="{{ $className }} {{ $buttonClass }}"
    @if ($closeModal) data-pd-overlay="{{ $closeModal }}" data-modal-target="{{ $closeModal }}" @endif
    @if ($openModal) data-pd-overlay="# . {{ $openModal }}" data-modal-target="{{ $openModal }}" data-modal-toggle="{{ $openModal }}" @endif
    @if ($submit) type="submit" @elseif ($button) type="button" @endif
    @if ($onClick) onclick="{{ $onClick }}" @endif
    @if ($routePath) onclick="window.location.href='{{ route($routePath) }}'" @endif>

    @if ($leftIcon)
        <span class="{{ $leftIcon }}"></span>
    @endif

    <p>{{ $label }}</p>

    @if ($rightIcon)
        <span class="{{ $rightIcon }}"></span>
    @endif
</button>

<script>
    //testing if the onClick="even()" in the dashboard.php to onclick="even()" button.php
    //for now its not working
    //oridinary button like <button> with event is working normally
    function myFunction() {
        console.log('hello');
    }
</script>
