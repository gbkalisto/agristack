@extends('admin.layouts.app')
@section('title', 'Edit Farmer')

@section('content')
    <div class="page-content">

        @include('admin.farmer.stepper', ['currentStep' => 1])

        @include('admin.farmer.edit.steps.basic', ['farmer' => $farmer])

    </div>
@endsection
