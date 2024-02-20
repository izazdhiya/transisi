@extends('layouts.app')

@section('title', 'Employee')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (!empty($employee))
                        <span>{{ __('Update Employee') }}</span>
                    @else
                        <span>{{ __('New Employee') }}</span>
                    @endif
                </div>                

                <div class="card-body">
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="employeeId" name="employeeId" value="{{ !empty($employee) ? $employee->id : ""}}">
                        <div class="modal-body">
                            <div class="col-md-12 mb-3">
                                <label for="name">Employee Name</label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Employee Name" value="{{ old('name', !empty($employee) ? $employee->name : "") }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="company_id">Company</label>
                                <select class="form-select" id="company_id" name="company_id">
                                    <option value="" selected>Choose company...</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="employee@example.com" value="{{ old('email', !empty($employee) ? $employee->email : "") }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600" onclick="goBack()">Cancel</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="btn-submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   

@endsection