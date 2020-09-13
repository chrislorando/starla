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
                            Movie List
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ url('/movie/index') }}">
                                <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Search...">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Overview</th>
                                    <th scope="col">Release</th>
                                    <th scope="col" class="text-nowrap text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($model->count() <= 0)
                                    <th colspan="6">No result found</th>
                                @else
                                    @php($i=0)
                                    @foreach($model as $key=>$r)   
                                    @php($i++)
                                    @php($count = $model->firstItem() + $key)
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $r->title }}</td>
                                        <td>{{ $r->category }}</td>
                                        <td>{{ substr($r->overview,'0','50') }}...</td>
                                        <td style="white-space:nowrap">{{ date('d F Y',strtotime($r->release_date)) }}</td>
                                        <td class="text-nowrap text-center">
                                            <form action="{{ url('/movie/destroy', ['id' => $r->id]) }}" method="post">
                                                <a href="{{ url('/movie/edit/'.$r->id) }}" class="btn btn-warning btn-sm">
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
                                @endif
                        
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            {{ $model->links('pagination::bootstrap-4') }}
                        </div>
                        <div class="col-lg-4 text-right">
                            <p>Showing {{ $model->firstItem() }} to {{ $model->lastItem() }} of {{ $model->total() }} entries</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
