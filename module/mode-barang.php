<?php
if (barangLogin()['level'] != 1) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data)
{
    global $koneksi;

    $kode = strtolower(mysqli_real_escape_string($koneksi, $data['kode']));
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $namabarang = mysqli_real_escape_string($koneksi, $data['namabarang']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $hargabeli = mysqli_real_escape_string($koneksi, $data['hargabeli']);
    $hargajual = mysqli_real_escape_string($koneksi, $data['hargajual']);
    $stockminimal  = mysqli_real_escape_string($koneksi, $data['stockminimal']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['']);

    // if ($password !== $password2) {
    //     echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
    //     return false;
    // }

    // $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekbarang = mysqli_query($koneksi, "SELECT barang FROM tbl_barang WHERE barang = '$barang'");
    if (mysqli_num_rows($cekbarang) > 0) {
        echo "<script>alert('barang sudah terpakai')</script>";
        return false;
    }

    if ($gambar != null) {
        $gambar = uploadimg();
    } else {
        $gambar = 'default.jpg';
    }

    //gambar tidak sesuai validasi
    if ($gambar == '') {
        return false;
    }

    $sqlBarang = "INSERT INTO tbl_barang VALUE (null, '$barang', '$full', '$pass', '$address', '$level', '$gambar')";
    mysqli_query($koneksi, $sqlBarang);
    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto)
{
    global $koneksi;

    $sqlData = "DELETE FROM tbl_barang WHERE barangid = $id";
    mysqli_query($koneksi, $sqlData);
    if ($foto != 'default.png') {
        unlink('../assets/image/' . $foto);
    }
    return mysqli_affected_rows($koneksi);
}

function selectbarang1($level)
{
    $result = null;
    if ($level == 1) {
        $result = "selected";
    }
    return $result;
}
function selectbarang2($level)
{
    $result = null;
    if ($level == 2) {
        $result = "selected";
    }
    return $result;
}
function selectbarang3($level)
{
    $result = null;
    if ($level == 3) {
        $result = "selected";
    }
    return $result;
}

function update($data)
{
    global $koneksi;

    $idbarang = mysqli_real_escape_string($koneksi, $data['id']);
    $barang = strtolower(mysqli_real_escape_string($koneksi, $data['barang']));
    $full = mysqli_real_escape_string($koneksi, $data['full']);
    $level = mysqli_real_escape_string($koneksi, $data['level']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['']);
    $fotoLama = mysqli_real_escape_string($koneksi, $data['oldImg']);

    // cek barang sekarang
    $querybarang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barangid = '$idbarang'");
    $databarang = mysqli_fetch_assoc($querybarang);
    $curbarang = $databarang['barang'];

    // cek barang baru
    $newbarang = mysqli_query($koneksi, "SELECT barang FROM tbl_barang WHERE barang = '$barang'");

    if ($barang !== $curbarang) {
        if (mysqli_num_rows($newbarang)) {
            echo "<script>alert('barang sudah terpakai, update data barang gagal !');
        document.location.href = 'data-barang.php';
        </script>";
            return false;
        }
    }

    // cek gambar
    if ($gambar != null) {
        $url = "data-barang.php";
        $imgbarang = uploadimg($url);
        if ($fotoLama != 'default.png') {
            @unlink('../assets/image/' . $fotoLama);
        }
    } else {
        $imgbarang = $fotoLama;
    }
    mysqli_query($koneksi, "UPDATE tbl_barang SET barang = '$barang', full = '$full', address = '$address', level = '$level', foto = '$imgbarang' WHERE barangid = '$idbarang'");

    return mysqli_affected_rows($koneksi);
}
