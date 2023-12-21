<table class="table table-striped text-nowrap">
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Nom</th>
            <th>Prenom</th>
            <th>email</th>
            {{-- <th>Mode de passe</th> --}}
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($members as $item => $member)
            <tr>
                {{-- <td>1</td> --}}
                <td>{{ $member->firstName }}</td>
                <td>
                    {{ $member->lastName }}
                </td>
                <td>
                    {{ $member->email }}
                </td>
                <td>
                    <a href="{{ route('member.edit', $member) }}" class="btn btn-sm btn-default"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <form method="POST" action="{{ route('member.destroy', $member) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirm('vous êtes sûr')" class="btn btn-sm btn-danger"><i
                                class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucun member trouvé.
                    <a href="{{ route('member.create') }}" class="mx-1">Ajouter member</a>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
