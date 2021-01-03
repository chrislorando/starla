@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                {!! $nav::getSideMenu(Auth::user(),'User') !!}
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-8">
                            User History List
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ url('/user/history') }}">
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
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated By</th>
                                    <th scope="col">Updated At</th>
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
                                    @php($count = $model->firstItem() + $key)
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $r->username }}</td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ $r->role->name }}</td>
                                        <td>{{ $r->created_by }}</td>
                                        <td>{{ $r->created_at }}</td>
                                        <td>{{ $r->updated_by }}</td>
                                        <td>{{ $r->updated_at }}</td>
                                        <td class="text-nowrap text-center">
                                            <form action="{{ url('/user/recover', ['id' => $r->id]) }}" method="post">
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
