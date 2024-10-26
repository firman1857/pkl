<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        user
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="tables.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tables</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                    <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="date" name="from_date" class="form-control" required />
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="to_date" class="form-control" required />
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="export" class="btn btn-success">Export to Excel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <?php
                        // Include the Composer autoload file
                        require 'vendor/autoload.php';
                        use PhpOffice\PhpSpreadsheet\Spreadsheet;
                        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

                        $server = "localhost";
                        $user = "root";
                        $password = "";
                        $database = "dbbuku_tamu";
                        $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

                        if(isset($_POST['delete_id'])) {
                            $delete_id = $_POST['delete_id'];
                            mysqli_query($koneksi, "DELETE FROM ttamu WHERE id='$delete_id'") or die(mysqli_error($koneksi));
                        }

                        if(isset($_POST['export'])) {
                            $from_date = $_POST['from_date'];
                            $to_date = $_POST['to_date'];

                            // Ensure the exports directory exists
                            if (!is_dir('exports')) {
                                mkdir('exports', 0777, true);
                            }

                            $spreadsheet = new Spreadsheet();
                            $sheet = $spreadsheet->getActiveSheet();
                            
                            // Add header
                            $sheet->setCellValue('A1', 'No');
                            $sheet->setCellValue('B1', 'Name');
                            $sheet->setCellValue('C1', 'Alamat');
                            $sheet->setCellValue('D1', 'Nomer HP');
                            $sheet->setCellValue('E1', 'Jenis Kelamin');
                            $sheet->setCellValue('F1', 'Tanggal');
                            $sheet->setCellValue('G1', 'Keterangan');

                            // Fetch data
                            $query = "SELECT * FROM ttamu WHERE Tanggal BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC";
                            $result = mysqli_query($koneksi, $query);
                            $rowNumber = 2;
                            $no = 1;

                            while($row = mysqli_fetch_assoc($result)) {
                                $sheet->setCellValue('A'.$rowNumber, $no++);
                                $sheet->setCellValue('B'.$rowNumber, $row['Nama']);
                                $sheet->setCellValue('C'.$rowNumber, $row['Alamat']);
                                $sheet->setCellValue('D'.$rowNumber, $row['Nomor_hp']);
                                $sheet->setCellValue('E'.$rowNumber, $row['kelamin']);
                                $sheet->setCellValue('F'.$rowNumber, $row['Tanggal']);
                                $sheet->setCellValue('F'.$rowNumber, $row['Keterangan']);
                                $rowNumber++;
                            }

                            $writer = new Xlsx($spreadsheet);
                            $fileName = 'DataExport_'.date('Ymd_His').'.xlsx';
                            $filePath = 'exports/'.$fileName;
                            $writer->save($filePath);

                            echo "<div class='alert alert-success mt-2'>Data exported successfully. <a href='$filePath'>Download here</a></div>";
                        }
                    ?>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Alamat</th>
                                    <th>Nomer HP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Alamat</th>
                                    <th>Nomer HP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu ORDER BY id DESC");
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($tampil)):
                                ?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$data['Nama']?></td>
                                    <td><?=$data['Alamat']?></td>
                                    <td><?=$data['Nomor_hp']?></td>
                                    <td><?=$data['kelamin']?></td>
                                    <td><?=$data['Tanggal']?></td>
                                    <td><?=$data['Keterangan']?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="delete_id" value="<?=$data['id']?>" />
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
