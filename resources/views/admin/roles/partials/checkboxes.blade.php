<ul class="list-unstyled">
    @foreach ($roles as $role)
        <li>
            <label>
                <input name="roles[]" type="checkbox" value="{{ $role->id }}"
                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                {{ $role->name }} <br>
                <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
            </label>
        </li>
    @endforeach
</ul>
