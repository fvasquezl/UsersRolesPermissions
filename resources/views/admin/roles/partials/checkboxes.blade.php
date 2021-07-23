<ul class="list-unstyled">
    @foreach ($roles as $role)
        <li class="icheck-primary">
            <div class="icheck-primary">
                <input name="roles[]" type="checkbox" value="{{ $role->id }}" id="role{{ $role->id }}"
                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                <label for="role{{ $role->id }}">{{ $role->name }}</label><br>
                <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
            </div>
        </li>
    @endforeach
</ul>
