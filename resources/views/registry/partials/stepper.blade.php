@php
    $steps = [
        1 => 'Basic',
        2 => 'Residential',
        3 => 'Land',
        4 => 'Crop',
        5 => 'Bank',
        6 => 'Documents',
    ];
@endphp

<div class="card mb-3">
    <div class="card-body py-2">

        <div class="d-flex align-items-center justify-content-left gap-2 flex-wrap">

            @foreach ($steps as $step => $label)
                @php
                    $isCompleted = $step < $currentStep;
                    $isActive = $step == $currentStep;
                @endphp

                {{-- Completed --}}
                @if ($isCompleted)
                    <a href="{{ route('registry.step', $step) }}" class="step-btn completed">
                        <span class="step-circle bg-primary">{{ $step }}</span>
                        {{ $label }}
                    </a>

                    {{-- Active --}}
                @elseif($isActive)
                    <span class="step-btn active">
                        <span class="step-circle bg-success">{{ $step }}</span>
                        {{ $label }}
                    </span>

                    {{-- Disabled --}}
                @else
                    <span class="step-btn disabled">
                        <span class="step-circle bg-secondary">{{ $step }}</span>
                        {{ $label }}
                    </span>
                @endif
            @endforeach

        </div>

    </div>
</div>

{{-- Local styles (safe & clean) --}}
<style>
    .step-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        border: 1px solid #0d6efd;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        text-decoration: none;
        background: #fff;
        color: #0d6efd;
    }

    .step-btn.active {
        background: #0d6efd;
        color: #fff;
    }

    .step-btn.completed {
        background: #fff;
        color: #0d6efd;
    }

    .step-btn.disabled {
        border-color: #ced4da;
        color: #6c757d;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .step-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
    }
</style>
