@extends('layouts.app')

@section('title', 'New Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (!empty($company))
                        <span>{{ __('Update Company') }}</span>
                    @else
                        <span>{{ __('New Company') }}</span>
                    @endif
                </div>                

                <div class="card-body">
                    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="companyId" name="companyId" value="{{ !empty($company) ? $company->id : ""}}">
                        <div class="modal-body">
                            @if (!empty($company))
                                <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center">
                                    <img width="20%" style="border-radius: 5px;" src="{{ asset('storage/' . $company->logo) }}" alt="Preview Image">
                                </div>
                            @endif
                            
                            <div class="col-md-12 mb-3">
                                <label for="name">Company Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Company Name" value="{{ old('name', !empty($company) ? $company->name : "") }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="company@example.com" value="{{ old('email', !empty($company) ? $company->email : "") }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="logo">Logo</label>
                                <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" accept="image/png">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="website">Website</label>
                                <input class="form-control @error('website') is-invalid @enderror" id="website" name="website" type="text" placeholder="https://example.com" value="{{ old('website', !empty($company) ? $company->website : "") }}">
                                @error('website')
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

@endsection