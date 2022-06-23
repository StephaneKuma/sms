@if($studentCount > 0)
    <div class="mt-3 mb-3 d-flex align-items-center">
        <div class="col-3">
            <span class="ps-2 me-2">Elèves %</span>
            <span class="badge rounded-pill border text-white px-3" style="background-color: #1980c4;">Mâle</span>
            <span class="badge rounded-pill border text-white px-3" style="background-color: #49a4fe;">Femelle</span>
        </div>
        @php
            $maleStudentsCount = $maleStudents->count();
            $maleStudentPercentage = round(($maleStudentsCount / $studentCount), 2) * 100;
            $maleStudentPercentageStyle = "style='background-color: #1980c4; width: $maleStudentPercentage%'";

            $femaleStudentPercentage = round((($studentCount - $maleStudentsCount) / $studentCount), 2) * 100;
            $femaleStudentPercentageStyle = "style='background-color: #49a4fe; width: $femaleStudentPercentage%'";
        @endphp
        <div class="col-9">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" {!!$maleStudentPercentageStyle!!} aria-valuenow="{{ $maleStudentPercentage }}" aria-valuemin="0" aria-valuemax="100">
                    {{$maleStudentPercentage}}%
                </div>
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" {!!$femaleStudentPercentageStyle!!} aria-valuenow="{{ $femaleStudentPercentage }}" aria-valuemin="0" aria-valuemax="100">
                    {{$femaleStudentPercentage}}%
                </div>
            </div>
        </div>
    </div>
@endif
