@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0f172a;
        color: #f1f5f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #1e293b;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        border: 1px solid #334155;
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-container h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 10px;
        color: #f8fafc;
        font-size: 14px;
        transition: 0.3s border, 0.3s box-shadow;
    }

    input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
    }

    .btn {
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: 0.3s all;
    }

    .btn-primary {
        background-color: #3b82f6;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-secondary {
        color: #94a3b8;
    }

    .btn-secondary:hover {
        color: #3b82f6;
    }

    @media (max-width: 600px) {
        .form-actions {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="form-container">
    <h2> Tambah User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email@example.com" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
        </div>

        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan User</button>
        </div>
    </form>
</div>
@endsection
