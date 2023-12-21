<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ isset($member) ? 'Modifier membre' : 'Ajouter membre' }}</h3>
    </div>
    <form method="POST" action="{{ isset($member) ? route('member.update', $member->id) : route('member.store') }}">
        @csrf
        @if (isset($member))
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group mb-0">
                <label for="firstName mb-0">Nom</label>
                <input name="firstName" type="text" class="form-control" id="firstName" placeholder="Enter nom"
                    value="{{ old('firstName', isset($member) ? $member->firstName : '') }}">
            </div>
            @error('firstName')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mb-0 mt-3">
                <label for="Prenom">Prenom</label>
                <input name="lastName" type="text" class="form-control" id="Prenom" placeholder="Prenom"
                    value="{{ old('lastName', isset($member) ? $member->lastName : '') }}">
            </div>
            @error('lastName')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mb-0 mt-3">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="email"
                    value="{{ old('email', isset($member) ? $member->email : '') }}">
            </div>
            @error('email')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mb-0 mt-3">
                <label for="Password">Password</label>
                <input name="password" type="Password" class="form-control" id="Password" placeholder="password">
            </div>
            @error('password')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
        </div>

        <div class="card-footer">
            <a href="{{ route('member.index') }}" class="btn btn-default">Annuler</a>
            <button type="submit" class="btn btn-primary">{{ isset($member) ? 'Modifier' : 'Submit' }}</button>
        </div>
    </form>
</div>
