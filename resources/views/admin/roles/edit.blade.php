@extends('layouts.master')


@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Roles',
    'subtitle' => 'Administration',
    'breadCrumbs' =>['roles','edit']
    ])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3>Role Info</h3>
                    </div>
                    <div class="card-body">
                        <form method="PUT" id="updateRolesForm" name="updateRolesForm"
                            action="{{ route('admin.roles.update', $role) }}">

                            @include('admin.roles.partials.form')

                            <button class="btn btn-primary btn-block">Update Role</button>
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

            $('#updateRolesForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });

        });
    </script>
@endpush
