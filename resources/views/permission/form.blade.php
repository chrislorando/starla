@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                {!! $nav::getSideMenu(Auth::user(),'Permission') !!}
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-8">
                            {{ !$model->id ? 'Create Permission' : 'Edit Permission' }}  
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ !$model->id ? route('create-permission') : route('edit-permission',$model->id) }}">
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

                        <div class="form-group row">
                            <label for="controller" class="col-md-4 col-form-label text-md-right">{{ __('Controller') }}</label>

                            <div class="col-md-6">
                                <input id="controller" type="text" class="form-control @error('controller') is-invalid @enderror" name="controller" value="{{ $model->controller ? $model->controller : old('controller') }}">

                                @error('controller')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="action" class="col-md-4 col-form-label text-md-right">{{ __('Action') }}</label>

                            <div class="col-md-6">
                                <input id="action" type="text" class="form-control @error('action') is-invalid @enderror" name="action" value="{{ $model->action ? $model->action : old('action') }}">

                                @error('action')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="method" class="col-md-4 col-form-label text-md-right">{{ __('Method') }}</label>

                            <div class="col-md-6">
                                <input id="method" type="text" class="form-control @error('method') is-invalid @enderror" name="method" value="{{ $model->method ? $model->method : old('method') }}">

                                @error('method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="params" class="col-md-4 col-form-label text-md-right">{{ __('Params') }}</label>

                            <div class="col-md-6">
                                <input id="params" type="text" class="form-control @error('params') is-invalid @enderror" name="params" value="{{ $model->params ? $model->params : old('params') }}">

                                @error('params')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Alias') }}</label>

                            <div class="col-md-6">
                                <input id="alias" type="text" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ $model->alias ? $model->alias : old('alias') }}">

                                @error('alias')
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
