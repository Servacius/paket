<tr>
    <td class="text-center">{{ $user->nik }}</td>
    <td>{{ $user->nama }}</td>
    @if ($user->role == 'petugas')
        <td>{{ 'Petugas' }}</td>
    @elseif ($user->role == 'admin')
        <td>{{ 'Admin' }}</td>
    @else
        <td>{{ 'Karyawan' }}</td>
    @endif
    <td>{{ $user->no_telepon }}</td>
    <td>{{ $user->email }}</td>
    <td class="td-actions text-center">
        {{-- <a href="" type="button" rel="tooltip" class="btn btn-info">
            <i class="material-icons">person</i>
        </a> --}}
        <a href="{{ route('user.edit.custom', ['id' => $user->id]) }}" type="button" rel="tooltip"
            class="btn btn-warning">
            <i class="material-icons">edit</i>
        </a>
        {{-- <a href="" type="button" rel="tooltip" class="btn btn-danger">
            <i class="material-icons">close</i>
        </a> --}}
    </td>
</tr>