<table class="table table-striped text-nowrap ">
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Nom</th>
            <th>Description</th>
            <th>Date debut</th>
            <th>Date fin</th>
            @role('leader')
                <th>Action</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @forelse ($tasks as $index => $task)
            <tr>
                {{-- <td>{{ $index + 1 }}</td> --}}
                <td>{{ $task->name }}</td>
                <td>
                    {{ $task->description }}
                </td>
                <td>
                    {{ $task->startDate }}
                </td>
                <td>
                    {{ $task->endDate }}
                </td>
                @role('leader')
                    <td>
                        <a href="{{ route('task.edit', ['project' => $project, 'task' => $task]) }}"
                            class="btn btn-sm btn-default "><i class="fa-solid fa-pen-to-square"></i></a>
                        <form method="POST" action="{{ route('task.destroy', ['project' => $project, 'task' => $task]) }}"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="confirm('vous êtes sûr')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                @endrole
            </tr>
        @empty
            <tr>
                <td colspan="6">Aucun tache trouvé.
                    @role('leader')
                        <a href="{{ route('task.create', $project) }}" class="mx-1">Ajouter tache</a>
                    @endrole
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
