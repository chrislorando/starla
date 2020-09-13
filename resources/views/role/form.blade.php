@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                {!! $nav::getSideMenu(Auth::user(),'Role') !!}
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-8">
                            {{ !$model->id ? 'Create Role' : 'Edit Role' }}  
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ !$model->id ? route('create-role') : route('edit-role',$model->id) }}">
                        @csrf

                        @if($model->id)
                            <input name="_method" type="hidden" value="PUT">
                        @endif

                        <input type="hidden" name="id" value="{{ $model->id }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $model->name ? $model->name : old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Save') }}
                                </button>

                                <button type="reset" class="btn btn-danger">
                                    <i class="fas fa-times"></i> {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
