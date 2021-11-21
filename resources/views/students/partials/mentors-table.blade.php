<table class="table datatable table table-striped table-bordered nowrap" style="border:1px; width: 100%">
    <thead>
    <tr>
        <th>Име</th>
        <th>Град</th>
        <th>Брой ученици</th>
        <th>...</th>
    </tr>
    </thead>
    <tbody>
        @foreach($mentors as $mentor)
            <tr>
                <td>{{ $mentor->name }}</td>
                <td>{{ $mentor->city->name }}</td>
                <td>{{ $mentor->students->count() }}</td>
                <td>
                    @if(in_array($mentor->id, $student->mentors->pluck('id')->toArray()))
                        <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.detach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                        </form>
                    @else
                        <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.attach', ['student' => $student->id, 'mentor' => $mentor->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="btn btn-success"><i class="fas fa-user-plus"></i></button>
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
        <th>Брой ученици</th>
        <th>...</th>
    </tr>
    </tfoot>
</table>
