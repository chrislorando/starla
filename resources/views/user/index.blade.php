@extends('layouts.app')

@section('content')
{{-- {{ Request::path() }} --}}
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
                            User List
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ url('/user/index') }}">
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
                                    <th colspan="6">No result found</th>
                                @else
                                    @php($i=0)
                                    @foreach($model as $key=>$r)   
                                    @php($i++)
                                    @php($count = $model->firstItem() + $key)
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $r->username }}</td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ $r->role->name ?? '' }}</td>
                                        <td>{{ $r->created_by }}</td>
                                        <td>{{ $r->created_at }}</td>
                                        <td>{{ $r->updated_by }}</td>
                                        <td>{{ $r->updated_at }}</td>
                                        <td class="text-nowrap text-center">
                                            <form action="{{ url('/user/destroy', ['id' => $r->id]) }}" method="post">
                                                <a href="{{ url('/user/edit/'.$r->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($r->id>1)
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" name="_method" value="delete" />
                                                @endif
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

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>

function destroy(url,name,confirm=false)
{
    if(confirm==false){
        $("#myModal").modal();
        $("#myModal").find('.modal-title').text('Permanently Removed');
        $("#myModal").find('.modal-body').html('Are you sure want to remove <b>'+name+'</b>?');
        $("#myModal").find('.modal-footer').html('<button type="button" class="btn btn-danger" onclick="destroy(\''+url+'\',\''+name+'\',true)">Submit</button>');
    }else{
        var form = '<form method="POST" action="'+url+'">';
        form+= '<input type="hidden" name="_method" value="delete" />';
        form+= '@csrf';
        form+= '</form>';

        $(form).appendTo('body').submit();
    }
}
</script>
@endsection
