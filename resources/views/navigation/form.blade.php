@extends('layouts.app')


@section('css')
<style>
    .select2-selection__rendered {
        line-height: 32px !important;
    }
    .select2-container .select2-selection--single {
        height: 36px !important;
    }
    .select2-selection__arrow {
        height: 35px !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                {!! $nav::getSideMenu(Auth::user(),'Navigation') !!}
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-8">
                            {{ !$model->id ? 'Create Navigation' : 'Edit Navigation' }}  
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ !$model->id ? route('create-navigation') : route('edit-navigation',$model->id) }}">
                        @csrf

                        @if($model->id)
                            <input name="_method" type="hidden" value="PUT">
                        @endif

                        <input type="hidden" name="id" value="{{ $model->id }}">

                        <div class="form-group row">
                            <label for="sort" class="col-md-4 col-form-label text-md-right">{{ __('Order') }}</label>

                            <div class="col-md-6">
                                <input id="sort" type="text" class="form-control @error('sort') is-invalid @enderror" name="sort" value="{{ $model->sort ? $model->sort : old('sort') }}" autocomplete="name" autofocus>

                                @error('sort')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="parent" class="col-md-4 col-form-label text-md-right">{{ __('Parent') }}</label>

                            <div class="col-md-6">
                                <select id="parent" type="text" class="form-control @error('parent') is-invalid @enderror" name="parent"></select>

                                @error('parent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                            <label for="route" class="col-md-4 col-form-label text-md-right">{{ __('Route') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="route" type="text" class="form-control @error('route') is-invalid @enderror" name="route" value="{{ $model->route ? $model->route : old('route') }}" autocomplete="name" autofocus> --}}
                                <select id="route" class="js-data-example-ajax form-control @error('route') is-invalid @enderror" name="route" value="{{ $model->route ? $model->route : old('route') }}"></select>
                                @error('route')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $model->type ? $model->type : old('type') }}">
                                    <option value="1" {{ $model->type==1 ? 'selected' : '' }}>Topnav</option>
                                    <option value="2" {{ $model->type==2 ? 'selected' : '' }}>Sidenav</option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>

                            <div class="col-md-6">
                                <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ $model->icon ? $model->icon : old('icon') }}" autocomplete="name" autofocus>

                                @error('icon')
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

@section('js')
<script>

    $(document).ready(function(){
        
        $('#route').select2({
            allowClear: true,
            placeholder :'select..',
            minimumInputLength: 2,
            ajax: {
                url: "{{ url('navigation/routes') }}",
                dataType: 'json'
            },
        });

        $('#route').on('select2:clear', function (e) {
            var data = e.params.data;
            console.log(data);
            $('#route').val(null).trigger('change');
            var newOption = new Option("", "", false, false);
            $('#route').append(newOption).trigger('change');
        });

        @if($model->id)
            var newRoute = new Option("{{ $model->route }}", "{{ $model->route }}", false, false);
            $('#route').append(newRoute).trigger('change');
        @endif

        $('#route').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data);
            var newRoute = new Option(data.name, data.name, false, false);
            $('#route').append(newRoute).trigger('change');
        });

        $('#parent').select2({
            allowClear: true,
            placeholder :'select..',
            minimumInputLength: 2,
            ajax: {
                url: "{{ url('navigation/parents') }}",
                dataType: 'json'
            }
        });

        $('#parent').on('select2:clear', function (e) {
            var data = e.params.data;
            console.log(data);
            $('#parent').val(null).trigger('change');
            var newOption = new Option("", "", false, false);
            $('#parent').append(newOption).trigger('change');
        });

        @if($model->id)
            var newParent = new Option("{{ $model->parentNav->name ?? '' }}", "{{ $model->parent }}", false, false);
            $('#parent').append(newParent).trigger('change');
        @endif
    });
</script>
@endsection