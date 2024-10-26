<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "dbbuku_tamu";

    $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

    $alert = "";

    // jika tombol simpan diklik
    if (isset($_POST['bsimpan'])) {
        // Check if form fields are not empty
        $nama = $_POST['Nama'] ?? '';
        $alamat = $_POST['Alamat'] ?? '';
        $nomor_hp = $_POST['Nomor_hp'] ?? '';
        $kelamin = $_POST['kelamin'] ?? '';
        $Keterangan = $_POST['Keterangan'] ?? '';

        if (!empty($nama) && !empty($alamat) && !empty($nomor_hp)) {
            // persiapan simpan data ke database
            $stmt = $koneksi->prepare("INSERT INTO ttamu (Nama, Alamat, Nomor_hp, kelamin, Keterangan) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nama, $alamat, $nomor_hp, $kelamin, $Keterangan);
            
            if ($stmt->execute()) {
                $alert = "success";
            } else {
                $alert = "error";
            }
        } else {
            $alert = "empty";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buku Tamu</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="docs/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="docs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/keyboard.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <!-- JS -->
    <script type="text/javascript" src="docs/js/jquery-latest-slim.min.js"></script>
    <script type="text/javascript" src="docs/js/jquery-ui-custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style type="text/css">
    .form-group, .form-group input {
        text-align: center;
    }
</style>

<body>
<div class="container">
    <div class="col-md-12">
    <form class="form" method="post">
            <center><img src="img/logo.png" width="130px;"></center>
            <div class="panel panel-warning">
                <div class="panel-heading text-center">
                    <b>BUKU TAMU BSIP</b>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="Nama" id="Nama" class="form-control" placeholder="Masukan Nama Anda Disini..!">
                    </div>
                    <div class="form-group">
                        <label>Alamat/Instansi</label>
                        <input type="text" name="Alamat" id="Alamat" class="form-control" placeholder="Masukan Alamat Anda Disini..!">
                    </div>
                    <div class="form-group">
                        <label>No.HP</label>
                        <input type="text" name="Nomor_hp" id="Nomor_hp" class="form-control" placeholder="Masukan No.HP Anda Disini..!">
                    </div>
                    <div class="form-group">
                    <label for="kelamin">Jenis Kelamin</label>
                    <select name="kelamin" id="kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>                      

                    </select>
                </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="Keterangan" id="Keterangan" class="form-control" placeholder="Masukan Keterangan Anda Disini..!">
                    </div>
                    <button type="submit" name="bsimpan" class="btn btn-success center-block">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var alertType = "<?php echo $alert; ?>";
        if (alertType == "success") {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan!'
            });
        } else if (alertType == "error") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data gagal disimpan!'
            });
        } else if (alertType == "empty") {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Semua kolom harus diisi!'
            });
        }
    });
</script>
</body>
</html>