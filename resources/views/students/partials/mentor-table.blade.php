<table class="table datatable table table-striped table-bordered nowrap" style="border:1px; width: 100%">
    <thead>
    <tr>
        <th>Име</th>
        <th>Град</th>
        <th>Брой студенти</th>
        <th>...</th>
    </tr>
    </thead>
    <tbody>
        @foreach($mentors as $mentor)
            <tr>
                <td>{{ $mentor->name }}</td>
                <td>{{ $mentor->city->name }}</td>
                <td>{{ $mentor->students->count() }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Име</th>
        <th>Град</th>
        <th>Брой студенти</th>
        <th>...</th>
    </tr>
    </tfoot>
</table>
