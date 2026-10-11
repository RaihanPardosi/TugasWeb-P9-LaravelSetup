@php
    $icons = [
        'check' => 'm4.5 12.75 6 6 9-13.5',
        'x-mark' => 'M6 18 18 6M6 6l12 12',
        'send' => 'M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5',
        'arrow-left' => 'M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18',
    ];
@endphp
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="{{ $class ?? 'size-5' }}" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$name] }}" /></svg>
