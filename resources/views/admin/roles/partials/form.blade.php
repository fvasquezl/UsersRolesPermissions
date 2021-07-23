@csrf

<div class="form-group">
    <label for="name">Identifier:</label>
    @if ($role->exists)
        <input value="{{ $role->name }}" class="form-control" disabled>
    @else
        <input name='name' value="{{ old('name', $role->name) }}" class="form-control">
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>

    @endif
</div>

<div class="form-group">
    <label for="display_name">Name:</label>
    <input name="display_name" value="{{ old('display_name', $role->display_name) }}" class="form-control">
    <span class="invalid-feedback" role="alert">
        <strong></strong>
    </span>
</div>


<div class="row">
    <div class="form-group col-md-6">
        <label>Permissions:</label>
        @include('admin.permissions.partials.checkboxes',['model'=> $role])
    </div>
</div>
