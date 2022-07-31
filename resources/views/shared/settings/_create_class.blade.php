<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Créer une classe</b></h5>
            <small></small>
            <form class="js-validation-material" action="{{ route('settings.classes.store') }}" method="POST">
                @csrf

                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <input type="text" placeholder="6ième" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                            <label for="name">Nom</label>
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
