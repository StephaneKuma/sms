<div class="myBlock">
    <div class="block block-rounded">
        <div class="block-content">
            <h5><b>Assigner un enseignant</b></h5>
            <small></small>
            <form class="js-validation-material" action="{{ route('settings.assignedTeachers.store') }}" method="POST">
                @csrf

                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                <div class="form-group row{{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="type" class="js-select2 form-control" name="teacher_id"
                                data-placeholder="Choisissez un enseignant">
                                <option></option>
                                @forelse ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @empty
                                    <option value="-1">Veuillez créer un enseignant</option>
                                @endforelse
                            </select>
                            <label for="teacher_id">Enseignant :</label>
                        </div>
                        @error('teacher_id')
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
                            <select onchange="getCoursesAndSections(this);" id="class_id"
                                class="js-select2 form-control" name="class_id"
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
                <div class="form-group row{{ $errors->has('section_id') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="section_id" class="js-select2 form-control section_id" name="section_id">
                            </select>
                            <label for="section_id">Assigner à la section :</label>
                        </div>
                        @error('section_id')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row{{ $errors->has('course_id') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material">
                            <select id="course_id" class="js-select2 form-control course_id" name="course_id">
                            </select>
                            <label for="course_id">Assigner à la section :</label>
                        </div>
                        @error('course_id')
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
