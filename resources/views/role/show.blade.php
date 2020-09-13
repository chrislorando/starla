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
                            Role <b>{{ $model->name }}</b>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="table-responsive">
                        <table id='permissionTable' class='table table-condensed table-striped table-hover table-bordered'>
                          <tr>
                            <th>Type</th>
                            <th>Permission</th>
                          </tr>
                  
                          @php($i=0)
                          @foreach ($permissions as $key=>$p)
                          <tr>
                            <th>{{ $key }}</th>
                            <td>
                              @foreach ($p as $a)
                              @php($i++)
                              <label class='label-block'>
                                <div class="form-group">
                                  <div class="form-check form-check-inline" style="padding-right:10px;">
                                    <input id="checkboxPermission{{ $i }}" name="{{ $a['name'] }}" class="form-check-input checkboxPermission"
                                      type="checkbox" title="{{ base64_encode($model->id.'|'.$a['id']) }}" {{ $a['can'] }}>
                                    <label class="form-check-label" for="checkboxPermission{{ $i }}"> {{ $a['name'] }} </label>
                                  </div>
                                </div>
                              </label>
                              @endforeach
                            </td>
                          </tr>
                          @endforeach
                  
                        </table>
                      </form>
                

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js') 
<script>
  function setPermission(permission) {
    $.post("{{ url('role/permission/') }}/" + permission,{ _method: "patch", _token : "{{ csrf_token() }}"}, function (data) {
      console.log(data);
    //   alert(data);
    });
  }

  $( document ).ready(function() {

    $(".checkboxPermission").bind("click", function () {
      setPermission($(this).attr("title"));
    });

  });
</script>
@endsection