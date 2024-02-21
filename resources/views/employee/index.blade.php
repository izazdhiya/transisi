@extends('layouts.app')

@section('title', 'Employee')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Employee') }}</span>
                    <div>
                        <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-import-employee">
                            Import
                        </a>
                        <a class="btn btn-primary" href="{{ route('employee.create') }}">
                            Create
                        </a>
                    </div>
                </div>  

                <div class="card-body">
                    
                    @include('message')

                    <div class="d-flex justify-content-between align-items-center">
                        <form class="row g-2 mb-3" action="{{ route('export-employee') }}" method="GET">
                            <div class="col-auto">
                                <label for="company_id" class="visually-hidden">Password</label>
                                <select class="form-select" id="company_id" name="company_id">
                                    <option value="" selected>Choose company...</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary" style="height: 30px; padding: 3px;">Export PDF</button>
                            </div>
                        </form>
                    </div> 
                
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

@include('employee.import')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";

        $('#company_id').select2({
            ajax: {
                url: baseUrl + '/get-company',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    console.log("page " + params.page);
                    console.log("totalData " + data.total_count);
                    if (data.error) {
                        console.error('Error fetching data:', data.error);
                        return { results: [] };
                    }
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page || 1) * 5 < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Choose company...',
            minimumInputLength: 0,
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(data) {
                return data.text;
            },
            templateSelection: function(data) {
                return data.text;
            },
        });
    });
</script>

@endsection
