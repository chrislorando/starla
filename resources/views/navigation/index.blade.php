@extends('layouts.app')

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
                            Navigation List
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ url('/navigation/index') }}">
                                <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Search...">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('danger') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Route</th>
                                    <th scope="col">Type</th>
                                    <th scope="col" class="text-nowrap text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($model->count() <= 0)
                                    <tr>
                                        <th colspan="6">No result found</th>
                                    </tr>
                                @else
                                
                                    @php($i=0)
                                    @foreach($model as $key=>$r)
                                        @php($i++)
                                        
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td><i class="{{ $r->icon }}"></i></td>
                                            <td>{{ $r->sort }}</td>
                                            <td>{{ $r->name }}</td>
                                            <td>{{ $r->route }}</td>
                                            <td>{{ $r->type==1 ? 'Top Nav' : 'Side Nav' }}</td>
                                            <td class="text-nowrap text-center">
                                                <form action="{{ url('/navigation/destroy', ['id' => $r->id]) }}" method="post">
                                                    <a href="{{ url('/navigation/edit/'.$r->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" name="_method" value="delete" />
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                        
                                        @if($r->childs->count() > 0)
                                        <tr>
                                            <td colspan="7">
                                                <table class="table table-bordered table-sm table-striped" style="width:100%">
                                                    <thead>
                                                        <tr class="thead-dark">
                                                            <th scope="col">#</th>
                                                            <th scope="col">Icon</th>
                                                            <th scope="col">Order</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Route</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col" class="text-nowrap text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php($n=0)
                                                        @foreach($r->childs as $c)  
                                                            @php($n++)
                                                            <tr>
                                                                <td>{{ $n }}</td>
                                                                <td><i class="{{ $c->icon }}"></i></td>
                                                                <td>{{ $c->sort }}</td>
                                                                <td>{{ $c->name }}</td>
                                                                <td>{{ $c->route }}</td>
                                                                <td>{{ $c->type==1 ? 'Top Nav' : 'Side Nav' }}</td>
                                                                <td class="text-nowrap text-center">
                                                                    <form action="{{ url('/navigation/destroy', ['id' => $c->id]) }}" method="post">
                                                                        <a href="{{ url('/navigation/edit/'.$c->id) }}" class="btn btn-warning btn-sm">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                        <input type="hidden" name="_method" value="delete" />
                                                                        @csrf
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                        
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function(){
    
    });
</script>
@endsection