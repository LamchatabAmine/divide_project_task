<table class="table table-striped text-nowrap">
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>{{ __('Nom') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Date debut') }}</th>
            <th>{{ __('Date fin') }}</th>
            {{-- <th>{{__('Taches')}}</th> --}}
            {{-- @role('leader') --}}
            <th>{{ __('Action') }}</th>
            {{-- @endrole --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $index => $project)
            <tr>
                {{-- <td>{{ $index + 1 }}</td> --}}
                <td>{{ $project->name }}</td>
                <td>
                    {{ $project->description }}
                </td>
                <td>{{ $project->startDate }}</td>
                <td>{{ $project->endDate }}</td>
                {{-- <td>
                    <a href="{{ route('task.index', $project) }}" class="btn btn-sm btn-primary">view tasks</a>
                </td> --}}
                <td>
                    @role('leader')
                        <a href="{{ route('project.edit', $project) }}" class="btn btn-sm btn-default ">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    @endrole
                    <a href="{{ route('task.index', $project) }}" class="btn btn-sm btn-primary">view tasks</a>
                    @role('leader')
                        <form method="POST" action="{{ route('project.destroy', $project) }}" style="display: inline-block;"
                            onsubmit="return confirm('Vous êtes sûr ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    @endrole
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Aucun projet trouvé.
                    @role('leader')
                        <a href="{{ route('project.create') }}" class="mx-1">Ajouter projet</a>
                    @endrole
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
