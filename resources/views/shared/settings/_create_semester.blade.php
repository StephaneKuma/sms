<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Créer un semestre pour la session courante</b></h5>
            <small></small>
            <form class="js-validation-material" action="{{ route('settings.semesters.store') }}" method="POST">
                @csrf

                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                <div class="form-group row">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" placeholder="Semestre 1" class="form-control" id="name"
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
                <div class="form-group row{{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" class="js-flatpickr form-control" placeholder="01-01-2023"
                                data-date-format="d-m-Y" id="start_at" name="start_at" value="{{ old('start_at') }}">
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
                            <input type="text" class="js-flatpickr form-control" placeholder="01-01-2023"
                                data-date-format="d-m-Y" id="end_at" name="end_at" value="{{ old('end_at') }}">
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
