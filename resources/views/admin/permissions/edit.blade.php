@extends('layouts.master')


@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Permissions',
    'subtitle' => 'Administration',
    'breadCrumbs' =>['permissions','edit']
    ])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Permissions Info</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="PUT" id="permissionsForm" name="permissionsForm"
                            action="{{ route('admin.permissions.update', $permission) }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Identifier:</label>
                                <input name="name" value="{{ $permission->name }}" class="form-control" disabled>
                            </div>


                            <div class="form-group">
                                <label for="display_name">Name:</label>
                                <input name="display_name" value="{{ old('display_name', $permission->display_name) }}"
                                    class="form-control">

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <button class="btn btn-primary btn-block">Update Permission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#permissionsForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });

        });
    </script>
@endpush
