@can('update', $role)
    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-success">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endcan

@can('delete', $role)
    @if ($role->id !== 1)
        <button class="btn btn-sm btn-danger delete-btn">
            <i class="fas fa-trash-alt"></i></button>
    @endif
@endcan
