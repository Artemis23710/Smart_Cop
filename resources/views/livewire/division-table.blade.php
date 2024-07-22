<div>
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Province</th>
                <th>District</th>
                <th>Division</th>
                <th class="disabled-sorting text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisions as $division)
                <tr>
                    <td>{{ $division->id}}</td>
                    <td>{{ $division->district->distric_name }}</td>
                    <td>{{ $division->division_name }}</td>
                    <td class="text-right">
                        <!-- Actions (Edit/Delete buttons) -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
