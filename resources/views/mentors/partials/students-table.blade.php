<div class="responsive-datatable">
    <table class="table  {{ $type == 'appropriate' ? 'matching-datatable' : 'datatable' }} table table-striped table-bordered nowrap" style="border:1px; width: 100%">
        <thead>
        <tr>
            <th>Име</th>
            <th>Град</th>
            <th>Тип проект</th>
            <th>Сфера на развитие</th>
            <th>Ментор - образование</th>
            <th>Ментор - работа</th>
            <th>Часове за проекта</th>
            @if($type == 'appropriate')
                <th>%</th>
            @endif
            <th>...</th>
        </tr>
        </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td><a href="{{ route('student.show', $student->id) }}">{{ $student->name }}</a></td>
                        <td>{{ $student->city->name }}</td>
                        <td>
                            <ul>
                                @foreach($student->projectTypes as $projectType)
                                    <li>
                                        <span style="color: {{ in_array($projectType->id, $mentor->projectTypes->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $projectType->type }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($student->spheres as $sphere)
                                    <li>
                                        <span style="color: {{ in_array($sphere->id, $mentor->spheres->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $sphere->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($student->mentorEducationSpheres as $sphere)
                                    <li>
                                        <span style="color: {{ in_array($sphere->id, $mentor->educationSpheres->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $sphere->sphere }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($student->mentorWorkSpheres as $sphere)
                                    <li>
                                        <span style="color: {{ in_array($sphere->id, $mentor->workSpheres->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $sphere->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td><b style="color: {{ $student->hours == $mentor->hours ? 'green' : 'red' }}">{{ $student->hours }}</b></td>
                        @if($type == 'appropriate')
                            <td>{{ \App\Services\MentorStudentService::matchingCalculation($student, $mentor) }}</td>
                        @endif
                        <td>
                            @if(in_array($student->id, $mentor->students->pluck('id')->toArray()))
                                <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.detach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-danger" {{ Auth::user()->isAdmin() ?: 'disabled' }} onclick="return confirm('Връзката ще бъде премахната!')"><i class="fas fa-user-times"></i></button>
                                </form>
                            @else
                                <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.attach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-success" {{ Auth::user()->isAdmin() ?: 'disabled' }} onclick="return connectConfirm({{ $mentor->students->count() }})"><i class="fas fa-user-plus"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        <tfoot>
        <tr>
            <th>Име</th>
            <th>Град</th>
            <th>Тип проект</th>
            <th>Сфера на развитие</th>
            <th>Ментор - образование</th>
            <th>Ментор - работа</th>
            <th>Часове за проекта</th>
            @if($type == 'appropriate')
                <th>%</th>
            @endif
            <th>...</th>
        </tr>
        </tfoot>
    </table>
</div>

@push('scripts')
    <script>
        function connectConfirm(mentorsCount) {
            if(mentorsCount > 0) {
                return confirm('Менторът има ученик!');
            }
        }
    </script>
@endpush
