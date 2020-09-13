@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                {!! $nav::getSideMenu(Auth::user(),'Movie') !!}
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-8">
                            {{ !$model->id ? 'Create Movie' : 'Edit Movie' }}  
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ !$model->id ? route('create-movie') : route('edit-movie',$model->id) }}">
                        @csrf

                        @if($model->id)
                            <input name="_method" type="hidden" value="PUT">
                        @endif

                        <input type="hidden" name="id" value="{{ $model->id }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $model->title ? $model->title : old('title') }}" autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $model->category ? $model->category : old('category') }}">

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Overview') }}</label>

                            <div class="col-md-6">
                                <textarea id="overview" type="text" class="form-control @error('overview') is-invalid @enderror" name="overview">{{ $model->overview ? $model->overview : old('overview') }}</textarea>

                                @error('overview')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Release Date') }}</label>

                            <div class="col-md-6">
                                <input id="release_date" type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ $model->release_date ? date('Y-m-d',strtotime($model->release_date)) : old('release_date') }}">

                                @error('release_date')
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
