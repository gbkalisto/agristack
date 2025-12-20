<style>
    .stepper {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px;
        background: #fff;
    }

    .stepper .nav-item {
        margin-right: 6px;
    }

    .stepper .nav-link {
        border: 1px solid #dee2e6;
        color: #495057;
        background: #f8f9fa;
        border-radius: 6px;
        padding: 8px 14px;
        font-weight: 500;
        cursor: default;
    }

    .stepper .nav-link.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .stepper .step-number {
        display: inline-block;
        width: 22px;
        height: 22px;
        line-height: 22px;
        text-align: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        margin-right: 6px;
        font-size: 12px;
    }
</style>
@php
    $steps = [
        1 => 'Basic',
        2 => 'Land',
        3 => 'Crop',
        4 => 'Bank',
        5 => 'Documents',
        6 => 'Residential',
    ];
@endphp

{{-- <ul class="nav nav-pills mb-4">
    @foreach ($steps as $step => $label)
        <li class="nav-item"">
            <span class="nav-link {{ $currentStep == $step ? 'active' : '' }}">
                Step {{ $step }}: {{ $label }}
            </span>
        </li>
    @endforeach
</ul> --}}
<ul class="nav nav-pills stepper mb-4">
    @foreach ($steps as $step => $label)
        <li class="nav-item">
            <span class="nav-link {{ $currentStep == $step ? 'active' : '' }}">
                <span class="step-number">{{ $step }}</span>
                {{ $label }}
            </span>
        </li>
    @endforeach
</ul>
