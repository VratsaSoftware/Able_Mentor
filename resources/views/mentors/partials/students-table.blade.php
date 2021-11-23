<table class="table datatable table table-striped table-bordered nowrap" style="border:1px; width: 100%">
    <thead>
    <tr>
        <th>Име</th>
        <th>Град</th>
        <th>...</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->city->name }}</td>
            <td>
                @if(in_array($student->id, $mentor->students->pluck('id')->toArray()))
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
        <th>...</th>
    </tr>
    </tfoot>
</table>
