@extends('layouts.app')

@section('title', 'Employee')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Employee') }}</span>
                    <a class="btn btn-primary" href="{{ route('employee.create') }}">
                        Create
                    </a>
                </div>  

                <div class="card-body">
                    
                    @include('message')

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 30%; white-space: nowrap;">Employee Name</th>
                                    <th style="width: 25%">Company</th>
                                    <th style="width: 15%">Email</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)

                                @php
                                    $number = ($employees->currentPage() - 1) * $employees->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        <div class="d-flex flex-row-reverse">
                                            <a class="btn btn-warning btn-sm mx-1" title="Edit" href='{{ route('employee.edit', $employee->id) }}'><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm mx-1" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($employees->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($employees->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $employees->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $employees->lastPage(); $i++)
                                    <li class="page-item {{ ($employees->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $employees->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($employees->currentPage() == $employees->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $employees->url($employees->currentPage() + 1) }}">Next</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
