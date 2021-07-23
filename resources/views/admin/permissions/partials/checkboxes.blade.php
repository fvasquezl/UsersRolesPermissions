<ul class="list-unstyled">
    @foreach ($permissions as $id => $name)
        <li>
            <label>
                <input name="permissions[]" type="checkbox" value="{{ $id }}"
                    {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
                {{ $name }}
            </label>
        </li>
    @endforeach
</ul>
