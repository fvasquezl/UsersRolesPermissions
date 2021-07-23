<!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $info['title'] ?? '' }}

                <small class="text-muted text-md">{{ $info['subtitle'] ?? '' }}</small>
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Admin</a></li>

                @foreach ($info['breadCrumbs'] as $breadCrumb)
                    @if ($loop->last)
                        <li class="breadcrumb-item active">{{ ucfirst($breadCrumb) }}</li>
                    @else
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.' . $breadCrumb . '.index') }}">{{ ucfirst($breadCrumb) }}</a></li>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
