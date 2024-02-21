@extends('layouts.app')

@section('title', 'Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Company') }}</span>
                    <a class="btn btn-primary" href="{{ route('company.create') }}">
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
                                    <th style="width: 25%; white-space: nowrap;">Company Name</th>
                                    <th style="width: 25%">Email</th>
                                    <th style="width: 20%">Logo</th>
                                    <th style="width: 20%">Website</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $index => $company)

                                @php
                                    $number = ($companies->currentPage() - 1) * $companies->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        <img height="70px" src="{{ asset('storage/' . $company->logo) }}" style="border-radius: 5px;">
                                    </td>
                                    <td>
                                        <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row-reverse">
                                            <a class="btn btn-warning btn-sm mx-1" title="Edit" href='{{ route('company.edit', $company->id) }}'><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('company.destroy', $company->id) }}" method="POST">
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
                        @if ($companies->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($companies->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $companies->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $companies->lastPage(); $i++)
                                    <li class="page-item {{ ($companies->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $companies->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($companies->currentPage() == $companies->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $companies->url($companies->currentPage() + 1) }}">Next</a>
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
