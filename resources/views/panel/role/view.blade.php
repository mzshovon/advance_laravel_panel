@extends('panel.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Projects</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Roles</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        @include('panel.layouts.alert')
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Role Name
                    </th>
                    <th style="width: 30%">
                        Total Permissions
                    </th>
                    <th>
                        Total Members
                    </th>
                    <th style="width: 8%" class="text-center">
                        Create At
                    </th>
                    <th style="width: 20%">
                      Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr data-id={{$role->id}}>
                    <td>
                        {{$role->id}}
                    </td>
                    <td>
                        {{$role->name}}
                    </td>
                    <td>
                        {{$role->permissions->count()}}
                    </td>
                    <td class="project_progress">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{$role->users->count()}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$role->users->count()}}%">
                            </div>
                        </div>
                        <small>
                            {{$role->users->count()}}% Complete
                        </small>
                    </td>
                    <td class="project-state">
                        {{$role->created_at}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{route('role-permission',['id'=>$role->id])}}">
                            <i class="fas fa-key">
                            </i>
                            Permissions
                        </a>
                        <a class="btn btn-info btn-sm" href="{{route('role-update',['id'=>$role->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        {{-- </a>href="{{route('role-delete',['id'=>$role->id])}}" --}}
                        <button class="btn btn-danger btn-sm" onclick ="deleteRole({{$role->id}})" >
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </button>
                    </td>
                </tr> 
                @empty
                <tr class="text-center">
                    No Data available!
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="float: right">
          {{$roles->links()}}
        </div>
      </div>
    </div>
  </section>
@endsection
@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function deleteRole(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          url: "{{route('role-delete',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
            $('tr[data-id='+id+']').remove();
              if(status.status==200){
                Swal.fire(
                  'Deleted!',
                  'Your selected role has been deleted.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection