<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Créer un cours</b></h5>
            <small></small>
            <form class="js-validation-material" action="{{ route('settings.courses.store') }}" method="POST">
                @csrf

                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" placeholder="Français, SVT, etc." class="form-control" id="name"
                                name="name" value="{{ old('name') }}">
                            <label for="name">Nom</label>
                        </div>
                        @error('name')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row{{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="type" class="js-select2 form-control" name="type"
                                data-placeholder="Choisissez un type">
                                <option></option>
                                <option {{ old('type') == '' ? 'selected' : 'Fondamentale' }} value="Fondamentale">
                                    Fondamentale</option>
                                <option {{ old('type') == '' ? 'selected' : 'Général' }} value="Général">
                                    Général</option>
                                <option {{ old('type') == '' ? 'selected' : 'Spécial' }} value="Spécial">
                                    Spécial</option>
                                <option {{ old('type') == '' ? 'selected' : 'Optionnel' }} value="Optionnel">Optionnel
                                </option>
                            </select>
                            <label for="type">Type de cours :</label>
                        </div>
                        @error('type')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row{{ $errors->has('semester_id') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="semester_id" class="js-select2 form-control" name="semester_id"
                                data-placeholder="Choisissez un semestre">
                                <option></option>
                                @forelse ($semesters as $semester)
                                    <option value="{{ $semester->id }}"
                                        {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                        {{ $semester->name }}</option>
                                @empty
                                    <option value="-1">Veuillez créer un semestre</option>
                                @endforelse
                            </select>
                            <label for="semester_id">Assigner au semestre :</label>
                        </div>
                        @error('semester_id')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="class_id" class="js-select2 form-control" name="class_id"
                                data-placeholder="Choisissez une classe">
                                <option></option>
                                @forelse ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $session->id ? 'selected' : '' }}>
                                        {{ $class->name }}</option>
                                @empty
                                    <option value="-1">Veuillez créer une classe</option>
                                @endforelse
                            </select>
                            <label for="class_id">Assigner à la classe :</label>
                        </div>
                        @error('class_id')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-save mr-5"></i> Soumettre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
