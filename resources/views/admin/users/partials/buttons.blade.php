@can('view', $user)
    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-eye"></i>
    </a>
@endcan

@can('update', $user)
    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-success">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endcan

@can('delete', $user)
    <button class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash-alt"></i></button>
@endcan
