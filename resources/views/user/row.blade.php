<tr>
    <td class="text-center">{{ $user->nik }}</td>
    <td>{{ $user->nama }}</td>
    <td>{{ $user->role }}</td>
    <td>{{ $user->no_telepon }}</td>
    <td>{{ $user->email }}</td>
    <td class="td-actions text-center">
        <a href="" type="button" rel="tooltip" class="btn btn-info">
            <i class="material-icons">person</i>
        </a>
        <a href="" type="button" rel="tooltip" class="btn btn-success">
            <i class="material-icons">edit</i>
        </a>
        {{-- <a href="" type="button" rel="tooltip" class="btn btn-danger">
            <i class="material-icons">close</i>
        </a> --}}
    </td>
</tr>