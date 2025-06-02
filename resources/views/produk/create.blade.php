<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Tambah Produk - Dark Mode</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    padding: 40px;
    transition: background-color 0.3s, color 0.3s;
  }

  body.dark {
    background-color: #1e1e2f;
    color: #ddd;
  }

  form {
    max-width: 700px;
    margin: 0 auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  body.dark form {
    background: #2e2e42;
    box-shadow: 0 0 15px rgba(0,0,0,0.6);
  }

  label {
    font-weight: bold;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 15px 20px;
  }

  input[type="text"],
  input[type="number"],
  textarea,
  input[type="file"] {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    transition: background-color 0.3s, color 0.3s, border-color 0.3s;
  }

  body.dark input[type="text"],
  body.dark input[type="number"],
  body.dark textarea,
  body.dark input[type="file"] {
    background-color: #1e1e2f;
    color: #ddd;
    border-color: #555;
  }

  button.submit-btn {
    padding: 12px 25px;
    background-color: #6b46c1;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  button.submit-btn:hover {
    background-color: #5936a1;
  }
</style>
</head>
<body class="dark">

<form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
  @csrf
  <table>
    <tr>
      <td><label for="nama_produk">Nama Produk</label></td>
      <td><input type="text" name="nama_produk" id="nama_produk" required></td>
    </tr>
    <tr>
  <td><label for="kategori">Kategori</label></td>
  <td>
    <select name="kategori" id="kategori" required style="width: 105%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
      <option value="">-- Pilih Kategori --</option>
      <option value="gitar">Gitar</option>
      <option value="drum">Drum</option>
      <option value="bass">Bass</option>
      <option value="keyboard">Keyboard</option>
      <!-- Bisa tambah kategori lain disini -->
    </select>
  </td>
</tr>

    <tr>
      <td><label for="deskripsi">Deskripsi</label></td>
      <td><textarea name="deskripsi" id="deskripsi" rows="4" required></textarea></td>
    </tr>
    <tr>
      <td><label for="harga">Harga</label></td>
      <td><input type="number" name="harga" id="harga" required></td>
    </tr>
    <tr>
      <td><label for="stok">Stok</label></td>
      <td><input type="number" name="stok" id="stok" required></td>
    </tr>
    <tr>
      <td><label for="gambar">Gambar Produk</label></td>
      <td><input type="file" name="gambar" id="gambar" accept="image/*" required></td>
    </tr>
    <tr>
      <td></td>
      <td><button type="submit" class="submit-btn">Simpan</button></td>
    </tr>
  </table>
</form>

</body>
</html>
