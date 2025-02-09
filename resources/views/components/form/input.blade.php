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
    'options' => [], // Add options for dropdown
    'disabled' => false,
])

<div class="space-y-3">
    @if ($label)
        <label for="{{ $name_id }}" @class([$labelClass, 'border-custom-red' => $errors->has($name_id)])>{{ $label }}</label>
    @endif

    @if ($type === 'select')
        <!-- Dropdown Selection -->
        <select id="{{ $name_id }}" name="{{ $name_id }}" @class([
            'border w-full tracking-wider focus:ring-2 focus:ring-custom-orange focus:outline-none',
            'border-custom-red' => $errors->has($name_id),
            'px-4 py-2 rounded-lg' => $small,
            'px-5 py-4 rounded-xl' => $big,
            'hidden' => $hidden,
        ])>
            <option value="" disabled selected>{{ $placeholder }}</option>
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ old($name_id, $value) == $key ? 'selected' : '' }}>
                    {{ $option }}</option>
            @endforeach
        </select>
    @else
        <!-- Normal Input Field -->
        <input :disabled="$disabled" type="{{ $type }}" id="{{ $name_id }}" name="{{ $name_id }}"
            value="{{ old($name_id, $value) }}" placeholder="{{ $placeholder }}" @class([
                'border w-full tracking-wider focus:ring-2 focus:ring-custom-orange focus:outline-none',
                'border-custom-red' => $errors->has($name_id),
                'px-4 py-2 rounded-lg' => $small,
                'px-5 py-4 rounded-xl' => $big,
                'hidden' => $hidden,
                'disabled:opacity-50' => $disabled,
            ])>
    @endif

    <x-form.error name="{{ $name_id }}" />
</div>
