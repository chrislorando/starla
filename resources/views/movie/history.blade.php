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
                            Movie Trash List
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ url('/movie/history') }}">
                                <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Search...">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped">
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
                                    <tr>
                                        <th scope="row">{{ $model->firstItem() + $key }}</th>
                                        <td>{{ $r->title }}</td>
                                        <td>{{ $r->category }}</td>
                                        <td>{{ $r->overview }}</td>
                                        <td class="text-nowrap text-center">{{ date('d F Y',strtotime($r->release_date)) }}</td>
                                        <td>
                                            <form action="{{ url('/movie/recover', ['id' => $r->id]) }}" method="post">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="patch" />
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
