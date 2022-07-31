<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Type de présence</b></h5>
            <small class="text-danger">
                <i class="fa fa-exclamation mr-5"></i>
                Ne pas changer de type au milieu d'un semestre
            </small>
            <form class="js-validation-material mt-4" action="{{ route('settings.update', $setting) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group row {{ $errors->has('attendance_type') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="attendance_type"
                                id="example-radio1" value="section"
                                {{ $setting->attendance_type == 'section' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="example-radio1">Présence par
                                section</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="attendance_type"
                                id="example-radio2" value="course"
                                {{ $setting->attendance_type == 'course' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="example-radio2">Présence par
                                cours</label>
                        </div>

                        @error('attendance_type')
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
