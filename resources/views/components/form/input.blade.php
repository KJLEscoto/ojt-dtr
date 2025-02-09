@props([
    'label' => false,
    'type' => 'text',
    'name_id',
    'value' => '',
    'placeholder' => '',
    'labelClass' => '',
    'small' => false,
    'big' => false,
    'hidden' => false,
])

<div class="space-y-3">
    @if ($label)
        <label for="{{ $name_id }}" @class([$labelClass, 'border-custom-red' => $errors->has($name_id)])>{{ $label }}</label>
    @endif

    <input @class([
        'border w-full tracking-wider focus:ring-2 focus:ring-custom-orange focus:outline-none',
        'border-custom-red' => $errors->has($name_id),
        'px-4 py-2 rounded-lg' => $small,
        'px-5 py-4 rounded-xl' => $big,
        'hidden' => $hidden,
    ]) type="{{ $type }}" name="{{ $name_id }}" id="{{ $name_id }}"
        value="{{ old($name_id, $value) }}" placeholder="{{ $placeholder }}">

    <x-form.error name="{{ $name_id }}" />
</div>
