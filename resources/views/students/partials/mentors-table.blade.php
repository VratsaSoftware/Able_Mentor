<table class="table {{ $type == 'appropriate' ? 'datatable-mentors' : 'datatable' }} table table-striped table-bordered nowrap" style="border:1px; width: 100%">
    <thead>
        <tr>
            <th>Име</th>
            <th>Град</th>
            <th>Тип проект</th>
            <th>Часове за проекта</th>
            @if($type == 'appropriate')
                <th>%</th>
            @endif
            <th>Брой ученици</th>
            <th>...</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mentors as $mentor)
            <tr>
                <td>{{ $mentor->name }}</td>
                <td>{{ $mentor->city->name }}</td>
                <td>
                    <ul>
                        @foreach($mentor->projectTypes as $projectType)
                            <li>
                                <span style="color: {{ in_array($projectType->id, $student->projectTypes->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $projectType->type }}</span>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td><b style="color: {{ $mentor->hours == $student->hours ? 'green' : 'red' }}">{{ $mentor->hours }}</b></td>
                @if($type == 'appropriate')
                    <td>{{ \App\Services\MentorStudentService::matchingCalculation($student, $mentor) }}</td>
                @endif
                <td>{{ $mentor->students->count() }}</td>
                <td>
                    @if(in_array($mentor->id, $student->mentors->pluck('id')->toArray()))
                        <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.detach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="btn btn-danger" {{ Auth::user()->isAdmin() ?: 'disabled' }} onclick="return confirm('Връзката ще бъде премахната!')"><i class="fas fa-user-times"></i></button>
                        </form>
                    @else
                        <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.attach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="btn btn-success" {{ Auth::user()->isAdmin() ?: 'disabled' }} {{ $student->mentors->count() ? 'disabled' : null }}><i class="fas fa-user-plus"></i></button>
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
            <th>Часове за проекта</th>
            @if($type == 'appropriate')
                <th>%</th>
            @endif
            <th>Брой ученици</th>
            <th>...</th>
        </tr>
    </tfoot>
</table>
