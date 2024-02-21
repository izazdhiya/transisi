@extends('layouts.app')

@section('title', 'Employee')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Employee Name" value="{{ old('name', !empty($employee) ? $employee->name : "") }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="company_id">Company</label>
                                <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" data-old-value="{{ old('company_id', !empty($employee) ? $employee->company->id : "") }}">
                                    <option value="" selected>Choose company...</option>
                                </select>
                                @error('company_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="employee@example.com" value="{{ old('email', !empty($employee) ? $employee->email : "") }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
            }
        });

        // var initialValue = $('#company_id').data('old-value');
        // if (initialValue) {
        //     $('#company_id').append(new Option(initialValue, initialValue, true, true));
        //     $('#company_id').trigger('change');
        // }
    });
</script>

@endsection