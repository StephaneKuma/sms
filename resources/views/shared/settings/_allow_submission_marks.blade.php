<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Autoriser la soumission des notes finales</b></h5>
            <small class="text-danger">
                <i class="fa fa-exclamation mr-5"></i>
                Habituellement, les enseignant(e)s sont autorisé(e)s à soumettre
                leur notes finales avant la fin d'un "Semestre".
            </small> <br><br>

            <small class="text-info">
                <i class="fa fa-exclamation mr-5"></i>
                Désactiver au début d'un "Semestre"
            </small>
            <form class="js-validation-material mt-4" action="{{ route('settings.update', $setting) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group row {{ $errors->has('mark_submission_status') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="mark_submission_status"
                                id="marks-radio1" value="off"
                                {{ $setting->mark_submission_status == 'off' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="marks-radio1">Désactiver</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="mark_submission_status"
                                id="marks-radio2" value="on"
                                {{ $setting->mark_submission_status == 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="marks-radio2">Activer</label>
                        </div>

                        @error('mark_submission_status')
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
