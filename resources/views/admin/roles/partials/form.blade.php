@csrf

<div class="form-group">
    <label for="name">Identifier:</label>
    @if ($role->exists)
        <input value="{{ $role->name }}" class="form-control" disabled>
    @else
        <input name='name' value="{{ old('name', $role->name) }}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>

<div class="form-group">
    <label for="display_name">Name:</label>
    <input name="display_name" value="{{ old('display_name', $role->display_name) }}"
        class="form-control  @error('display_name') is-invalid @enderror">
    @error('display_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="row">

    <div class="form-group col-md-6">
        <label>Permissions:</label>
        @include('admin.permissions.partials.checkboxes',['model'=> $role])
    </div>
</div>
