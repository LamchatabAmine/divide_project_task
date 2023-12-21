{{-- @dd($project) --}}

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ isset($task) ? 'Modifier Tache' : 'Ajouter Tache' }}</h3>
    </div>
    <form method="POST"
        action="{{ isset($task) ? route('task.update', ['project' => $project, 'task' => $task]) : route('task.store', $project) }}">
        @csrf
        @if (isset($task))
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group mb-0">
                <label for="nom">Nom</label>
                <input name="name" type="text" class="form-control" id="nom" placeholder="Enter nom"
                    value="{{ old('name', isset($task) ? $task->name : '') }}">
            </div>
            @error('name')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mt-2 mb-0">
                <label for="Description">Description</label>
                <input name="description" type="text" class="form-control" id="Description" placeholder="Description"
                    value="{{ old('description', isset($task) ? $task->description : '') }}">
            </div>
            @error('description')
                <div class="text-danger ">{{ $message }}</div>
            @enderror
            <div class="form-group mt-3 ">
                <label for="date">date debut</label>
                <input name="startDate" type="date" class="form-control" id="date" placeholder="date debut"
                    value="{{ old('startDate', isset($task) ? $task->startDate : '') }}">
            </div>
            @error('startDate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group ">
                <label for="date">date fin</label>
                <input name="endDate" type="date" class="form-control" id="date" placeholder="date fin"
                    value="{{ old('endDate', isset($task) ? $task->endDate : '') }}">
            </div>
            @error('endDate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="card-footer">
            <a href="{{ route('task.index', $project) }}" class="btn btn-default">Annuler</a>
            <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Modifier' : 'Submit' }}</button>
        </div>
    </form>
</div>
