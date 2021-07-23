<ul class="list-unstyled">
    @foreach ($permissions as $id => $name)
        <li>
            <div class="icheck-primary">
                <input name="permissions[]" type="checkbox" value="{{ $id }}"
                    id="permission{{ $id }}"
                    {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
                <label for="permission{{ $id }}"> {{ $name }}</label>
            </div>
        </li>
    @endforeach
</ul>
