@extends('layouts.app')

@section('title', 'Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Company') }}</span>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-company-form">
                        Create
                    </button>
                </div>                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                                <tr>
                                    <td>1</td>
                                    <td>Transisi</td>
                                    <td>admin@transisi.id</td>
                                    <td>test</td>
                                    <td>
                                        <a href="https://transisi.id" target="_blank">https://transisi.id</a>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row-reverse">
                                            <a href="" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="fas fa-pen"></i></a>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm mx-1" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('company.form')

@endsection
