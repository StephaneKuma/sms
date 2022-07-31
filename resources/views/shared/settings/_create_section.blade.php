<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Créer une section</b></h5>
            <small></small>
            <form class="js-validation-material" action="{{ route('settings.sections.store') }}" method="POST">
                @csrf

                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" placeholder="A, B, C, etc." class="form-control" id="name"
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
                <div class="form-group row {{ $errors->has('room_no') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" placeholder="1, 2, 3, etc." class="form-control" id="room_no"
                                name="room_no" value="{{ old('room_no') }}">
                            <label for="room_no">Salle N°</label>
                        </div>
                        @error('room_no')
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
                            <label for="class_id">Assigner la section à la classe :</label>
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
