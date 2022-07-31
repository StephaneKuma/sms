<div class="myBlock">
    <div class="block block-rounded">
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
                            <input type="text" placeholder="2023 - 2024" class="form-control" id="name"
                                name="name" value="{{ old('name') }}">
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
