@php
    $steps = [
        1 => 'Basic',
        2 => 'Land',
        3 => 'Crop',
        4 => 'Bank',
        5 => 'Documents',
    ];
@endphp

<ul class="nav nav-pills mb-4">
    @foreach ($steps as $step => $label)
        <li class="nav-item">
            <span class="nav-link {{ $currentStep == $step ? 'active' : '' }}">
                Step {{ $step }}: {{ $label }}
            </span>
        </li>
    @endforeach
</ul>
