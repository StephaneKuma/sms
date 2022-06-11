<div class="row">
    @if ($currentSessionId == $latestSessionId)
        <div class="col-md-4">
            <div class="block">
                <div class="block-content">
                    <h5><b>Créer une session</b></h5>
                    <small class="text-danger">
                        <i class="fa fa-exclamation mr-5"></i>
                        Créez une session par année académique. La dernière session
                        créée est considérée comme la dernière session académique.
                    </small>
                    <form class="js-validation-material" action="{{ route('settings.sessions.store') }}" method="POST">
                        @csrf

                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" placeholder="2023 - 2024" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
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
    @endif

    <div class="col-md-4">
        <div class="block">
            <div class="block-content">
                <h5><b>Naviguer dans une session</b></h5>
                <small class="text-danger">
                    <i class="fa fa-exclamation mr-5"></i>
                    Utilisez ceci seulement quand vous souhaitez naviguez
                    dans les données des précédentes sessions.
                </small>
                <form class="js-validation-material" action="{{ route('settings.sessions.browse') }}" method="POST">
                    @csrf

                    <div class="form-group row{{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                        <div class="col-12">
                            <div class="form-material">
                                <select id="session_id" class="js-select2 form-control" name="session_id" data-placeholder="Choisissez une session">
                                    <option></option>
                                    @forelse ($sessions as $session)
                                        <option value="{{ $session->id }}" {{ ((isset($section) && $section->session_id == $session->id) || old('session_id') == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
                                    @empty
                                        <option value="-1">Veuillez créer une session</option>
                                    @endforelse
                                </select>
                            </div>
                            @error('session_id')
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

    @if ($currentSessionId == $latestSessionId)
        <div class="col-md-4">
            <div class="block">
                <div class="block-content">
                    <h5><b>Créer un semestre pour la session courante</b></h5>
                    <form class="js-validation-material"
                        action="{{ route('settings.semesters.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="session_id"
                            value="{{ $currentSessionId }}">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" placeholder="Semestre 1"
                                        class="form-control" id="name" name="name"
                                        value="{{ old('name') }}">
                                </div>
                                <label for="name">Nom</label>
                                @error('name')
                                    <div class="invalid-feedback animated fadeInDown">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" class="js-flatpickr form-control"
                                        placeholder="01-01-2023" data-date-format="d-m-Y"
                                        id="start_at" name="start_at" value="{{ old('start_at') }}">
                                    <label for="start_at">Date de début</label>
                                </div>
                                @error('start_at')
                                    <div class="invalid-feedback animated fadeInDown">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('end_at') ? 'is-invalid' : '' }}">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" class="js-flatpickr form-control"
                                        placeholder="01-01-2023" data-date-format="d-m-Y"
                                        id="end_at" name="end_at" value="{{ old('end_at') }}">
                                    <label for="end_at">Date de fin</label>
                                </div>
                                @error('end_at')
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
        <div class="col-md-4">
            <div class="block">
                <div class="block-content">
                    <h5><b>Créer une classe</b></h5>
                    <form class="js-validation-material" action="{{ route('settings.classes.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" placeholder="2023 - 2024" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
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
    @endif
</div>
