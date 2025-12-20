@extends('account.layouts.app')
@section('title', 'Edit Farmer')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 1])

        @include('account.farmer.edit.steps.basic', ['farmer' => $farmer])

    </div>
@endsection
