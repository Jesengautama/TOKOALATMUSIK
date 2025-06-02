@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    h2 {
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .add-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .add-button:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 5px;
    }

    .btn-edit {
        background-color: #f39c12;
    }

    .btn-edit:hover {
        background-color: #e67e22;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="container">
    <h2>Daftar Pengguna</h2>
    <a href="{{ route('users.create') }}" class="add-button">+ Tambah User</a>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada pengguna.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
