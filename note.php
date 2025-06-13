<?php
include 'db_keuangan.php';

$bulan = $_GET['bulan'] ?? date('n');
$tahun = $_GET['tahun'] ?? date('Y');
$kas_id = $_GET['kas_id'] ?? 'semua';

// Ambil data kas
$kas_result = $conn->query("SELECT * FROM kas ORDER BY nama_kas");

// Query untuk laporan laba rugi
$laporan_summary_query = $conn->query("
    SELECT 
        COALESCE(SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END), 0) as total_pemasukan,
        COALESCE(SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END), 0) as total_pengeluaran,
        COALESCE(SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END), 0) - 
        COALESCE(SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END), 0) as laba_rugi
    FROM transaksi 
    WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
");
$laporan_summary = $laporan_summary_query->fetch_assoc();

// Tambahkan status
$laporan_summary['status'] = $laporan_summary['laba_rugi'] >= 0 ? 'UNTUNG' : 'RUGI';

// Query detail pemasukan
$pemasukan_detail = $conn->query("
    SELECT 
        kt.nama_kategori,
        SUM(t.jumlah) as total
    FROM transaksi t
    JOIN kategori_transaksi kt ON t.kategori_id = kt.id
    WHERE t.jenis = 'pemasukan' 
        AND MONTH(t.tanggal) = $bulan 
        AND YEAR(t.tanggal) = $tahun
    GROUP BY kt.id, kt.nama_kategori
    HAVING total > 0
    ORDER BY total DESC
");

// Query detail pengeluaran
$pengeluaran_detail = $conn->query("
    SELECT 
        kt.nama_kategori,
        SUM(t.jumlah) as total
    FROM transaksi t
    JOIN kategori_transaksi kt ON t.kategori_id = kt.id
    WHERE t.jenis = 'pengeluaran' 
        AND MONTH(t.tanggal) = $bulan 
        AND YEAR(t.tanggal) = $tahun
    GROUP BY kt.id, kt.nama_kategori
    HAVING total > 0
    ORDER BY total DESC
");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan - Sistem Keuangan UKM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #4ED7F1;
            --secondary-blue: #6FE6FC;
            --light-blue: #A8F1FF;
            --accent-yellow: #FFFA8D;
            --white: #ffffff;
            --dark: #2c3e50;
            --gray: #95a5a6;
            --success: #27ae60;
            --danger: #e74c3c;
            --shadow: rgba(78, 215, 241, 0.2);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--secondary-blue) 50%, var(--primary-blue) 100%);
            min-height: 100vh;
            color: var(--dark);
            padding-bottom: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px var(--shadow);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue), var(--accent-yellow));
        }

        .header h1 {
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header .subtitle {
            color: var(--gray);
            font-size: 1.1rem;
        }

        .nav-container {
            background: var(--white);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px var(--shadow);
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .nav-item {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(78, 215, 241, 0.4);
            background: linear-gradient(135deg, var(--secondary-blue), var(--light-blue));
        }

        .nav-item.active {
            background: var(--accent-yellow);
            color: var(--dark);
        }

        .grid {
            display: grid;
            gap: 25px;
            margin-bottom: 30px;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        }

        .grid-1 {
            grid-template-columns: 1fr;
        }

        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(78, 215, 241, 0.3);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-blue);
        }

        .card-header h2 {
            color: var(--dark);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card-header i {
            font-size: 1.8rem;
            color: var(--primary-blue);
            margin-right: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: linear-gradient(135deg, var(--light-blue), var(--secondary-blue));
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: scale(1.05);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--white);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--white);
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
        }

        th {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
            transition: background-color 0.3s ease;
        }

        tr:hover td {
            background-color: var(--light-blue);
        }

        .amount-positive {
            color: var(--success);
            font-weight: 600;
        }

        .amount-negative {
            color: var(--danger);
            font-weight: 600;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(78, 215, 241, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #c0392b);
            color: var(--white);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
        }

        .profit-positive {
            background: linear-gradient(135deg, var(--success), #2ecc71) !important;
            color: var(--white);
        }

        .profit-negative {
            background: linear-gradient(135deg, var(--danger), #c0392b) !important;
            color: var(--white);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 8px 0;
            background: var(--light-blue);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .summary-item:hover {
            transform: translateX(5px);
            background: var(--secondary-blue);
        }

        .category-header {
            background: var(--accent-yellow) !important;
            color: var(--dark) !important;
            font-weight: bold;
            text-transform: uppercase;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow);
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid var(--light-blue);
            border-radius: 50%;
            border-top-color: var(--primary-blue);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .nav {
                flex-direction: column;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Laporan Specific Styles */
        .period-title {
            background: linear-gradient(135deg, var(--accent-yellow), #f1c40f);
            color: var(--dark);
            padding: 15px 20px;
            border-radius: 15px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.2rem;
        }

        .filter-form {
            background: var(--light-blue);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            justify-content: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .filter-group select {
            padding: 10px 15px;
            border: 2px solid var(--white);
            border-radius: 10px;
            background: var(--white);
            color: var(--dark);
            font-size: 1rem;
            min-width: 150px;
            transition: all 0.3s ease;
        }

        .filter-group select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(78, 215, 241, 0.2);
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .category-tag {
            background: var(--light-blue);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: var(--gray);
            font-style: italic;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .print-actions {
            text-align: center;
            margin: 30px 0;
        }

        .summary-item.profit {
            background: linear-gradient(135deg, var(--success), #2ecc71);
        }

        .summary-item.loss {
            background: linear-gradient(135deg, var(--danger), #c0392b);
        }

        .summary-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--white);
            margin-bottom: 5px;
        }

        .summary-label {
            color: var(--white);
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Print Styles */
        @media print {
            body {
                background: white !important;
                color: black !important;
                font-size: 12px;
                margin: 0;
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }

            .container {
                max-width: none;
                padding: 0;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
                margin-bottom: 20px;
            }

            .header {
                box-shadow: none;
                border-bottom: 2px solid #000;
            }

            h1,
            h2,
            h3 {
                color: black !important;
                page-break-after: avoid;
            }

            table {
                border: 1px solid black;
                page-break-inside: auto;
            }

            th,
            td {
                border: 1px solid black !important;
                padding: 5px;
            }

            th {
                background-color: #f0f0f0 !important;
                color: black !important;
            }

            .summary-grid {
                display: block;
            }

            .summary-item {
                background: #f0f0f0 !important;
                color: black !important;
                border: 1px solid #ddd;
                margin-bottom: 10px;
                display: inline-block;
                width: 48%;
                margin-right: 2%;
            }

            .summary-value,
            .summary-label {
                color: black !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header fade-in">
            <h1><i class="fas fa-chart-bar"></i> Laporan Keuangan</h1>
            <p class="subtitle">Analisis Keuangan UKM yang Komprehensif</p>
        </div>

        <div class="nav-container fade-in no-print">
            <nav class="nav">
                <a href="index.php" class="nav-item">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="tambah_transaksi.php" class="nav-item">
                    <i class="fas fa-plus-circle"></i> Tambah Transaksi
                </a>
                <a href="kelola_kategori.php" class="nav-item">
                    <i class="fas fa-tags"></i> Kelola Kategori
                </a>
                <a href="kelola_kas.php" class="nav-item">
                    <i class="fas fa-wallet"></i> Kelola Kas
                </a>
                <a href="laporan.php" class="nav-item active">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
                <a href="log_aktivitas.php" class="nav-item">
                    <i class="fas fa-history"></i> Log Aktivitas
                </a>
            </nav>
        </div>

        <div class="card fade-in no-print">
            <div class="card-header">
                <i class="fas fa-filter"></i>
                <h2>Filter Laporan</h2>
            </div>
            <form method="GET" class="filter-form">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="bulan"><i class="fas fa-calendar-alt"></i> Bulan</label>
                        <select name="bulan" id="bulan">
                            <?php
                            $nama_bulan = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember'
                            ];
                            for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?= $i ?>" <?= $bulan == $i ? 'selected' : '' ?>>
                                    <?= $nama_bulan[$i] ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="tahun"><i class="fas fa-calendar"></i> Tahun</label>
                        <select name="tahun" id="tahun">
                            <?php for ($i = date('Y') - 2; $i <= date('Y') + 1; $i++): ?>
                                <option value="<?= $i ?>" <?= $tahun == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="period-title fade-in">
            <i class="fas fa-calendar-check"></i>
            Laporan Periode: <?= $nama_bulan[$bulan] ?> <?= $tahun ?>
        </div>

        <?php if ($laporan_summary): ?>
            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-chart-pie"></i>
                    <h2>Ringkasan Laba/Rugi</h2>
                </div>
                <div class="summary-grid">
                    <div class="stat-item">
                        <div class="summary-value amount-positive">
                            <?= formatRupiah($laporan_summary['total_pemasukan']) ?>
                        </div>
                        <div class="summary-label">
                            <i class="fas fa-arrow-up"></i> Total Pemasukan
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="summary-value amount-negative">
                            <?= formatRupiah($laporan_summary['total_pengeluaran']) ?>
                        </div>
                        <div class="summary-label">
                            <i class="fas fa-arrow-down"></i> Total Pengeluaran
                        </div>
                    </div>
                    <div class="stat-item <?= $laporan_summary['laba_rugi'] >= 0 ? 'profit-positive' : 'profit-negative' ?>">
                        <div class="summary-value">
                            <?= formatRupiah($laporan_summary['laba_rugi']) ?>
                        </div>
                        <div class="summary-label">
                            <i class="fas fa-<?= $laporan_summary['laba_rugi'] >= 0 ? 'chart-line' : 'chart-line-down' ?>"></i>
                            <?= $laporan_summary['laba_rugi'] >= 0 ? 'Laba Bersih' : 'Rugi Bersih' ?>
                        </div>
                    </div>
                    <div class="stat-item <?= $laporan_summary['laba_rugi'] >= 0 ? 'profit-positive' : 'profit-negative' ?>">
                        <div class="summary-value">
                            <?= $laporan_summary['status'] ?>
                        </div>
                        <div class="summary-label">
                            <i class="fas fa-<?= $laporan_summary['laba_rugi'] >= 0 ? 'thumbs-up' : 'thumbs-down' ?>"></i>
                            Status Keuangan
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-arrow-up" style="color: var(--success);"></i>
                    <h3>Detail Pemasukan per Kategori</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-tag"></i> Kategori</th>
                                <th><i class="fas fa-money-bill-wave"></i> Total</th>
                                <th><i class="fas fa-percentage"></i> Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($pemasukan_detail && $pemasukan_detail->num_rows > 0):
                                while ($row = $pemasukan_detail->fetch_assoc()):
                                    $persentase = $laporan_summary['total_pemasukan'] > 0 ?
                                        ($row['total'] / $laporan_summary['total_pemasukan']) * 100 : 0;
                            ?>
                                    <tr>
                                        <td>
                                            <span class="category-tag">
                                                <?= htmlspecialchars($row['nama_kategori']) ?>
                                            </span>
                                        </td>
                                        <td class="text-right amount-positive">
                                            <strong><?= formatRupiah($row['total']) ?></strong>
                                        </td>
                                        <td class="text-right">
                                            <strong><?= number_format($persentase, 1) ?>%</strong>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="3" class="no-data">
                                        <i class="fas fa-inbox"></i>
                                        <strong>Tidak ada pemasukan pada periode ini</strong>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-arrow-down" style="color: var(--danger);"></i>
                    <h3>Detail Pengeluaran per Kategori</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-tag"></i> Kategori</th>
                                <th><i class="fas fa-money-bill-wave"></i> Total</th>
                                <th><i class="fas fa-percentage"></i> Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($pengeluaran_detail && $pengeluaran_detail->num_rows > 0):
                                while ($row = $pengeluaran_detail->fetch_assoc()):
                                    $persentase = $laporan_summary['total_pengeluaran'] > 0 ?
                                        ($row['total'] / $laporan_summary['total_pengeluaran']) * 100 : 0;
                            ?>
                                    <tr>
                                        <td>
                                            <span class="category-tag">
                                                <?= htmlspecialchars($row['nama_kategori']) ?>
                                            </span>
                                        </td>
                                        <td class="text-right amount-negative">
                                            <strong><?= formatRupiah($row['total']) ?></strong>
                                        </td>
                                        <td class="text-right">
                                            <strong><?= number_format($persentase, 1) ?>%</strong>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="3" class="no-data">
                                        <i class="fas fa-inbox"></i>
                                        <strong>Tidak ada pengeluaran pada periode ini</strong>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else: ?>
            <div class="card fade-in">
                <div class="no-data">
                    <i class="fas fa-chart-bar"></i>
                    <strong>Tidak ada data untuk periode yang dipilih</strong>
                    <p>Silakan pilih periode lain atau tambahkan transaksi terlebih dahulu.</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="card fade-in">
            <div class="card-header">
                <i class="fas fa-list-alt"></i>
                <h2>Detail Transaksi - <?= $nama_bulan[$bulan] ?> <?= $tahun ?></h2>
            </div>
            <?php
            $detail_transaksi = $conn->query("
                SELECT t.*, kt.nama_kategori, k.nama_kas
                FROM transaksi t 
                JOIN kategori_transaksi kt ON t.kategori_id = kt.id 
                JOIN kas k ON t.kas_id = k.id
                WHERE MONTH(t.tanggal) = $bulan AND YEAR(t.tanggal) = $tahun
                ORDER BY t.tanggal DESC, t.created_at DESC
            ");
            ?>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fas fa-calendar"></i> Tanggal</th>
                            <th><i class="fas fa-university"></i> Kas</th>
                            <th><i class="fas fa-tag"></i> Kategori</th>
                            <th><i class="fas fa-exchange-alt"></i> Jenis</th>
                            <th><i class="fas fa-money-bill"></i> Jumlah</th>
                            <th><i class="fas fa-sticky-note"></i> Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($detail_transaksi->num_rows > 0):
                            while ($row = $detail_transaksi->fetch_assoc()):
                        ?>
                                <tr>
                                    <td><strong><?= tanggalIndo($row['tanggal']) ?></strong></td>
                                    <td><?= htmlspecialchars($row['nama_kas']) ?></td>
                                    <td>
                                        <span class="category-tag">
                                            <?= htmlspecialchars($row['nama_kategori']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="<?= $row['jenis'] == 'pemasukan' ? 'amount-positive' : 'amount-negative' ?>">
                                            <i class="fas fa-<?= $row['jenis'] == 'pemasukan' ? 'arrow-up' : 'arrow-down' ?>"></i>
                                            <?= ucfirst($row['jenis']) ?>
                                        </span>
                                    </td>
                                    <td class="text-right <?= $row['jenis'] == 'pemasukan' ? 'amount-positive' : 'amount-negative' ?>">
                                        <strong><?= formatRupiah($row['jumlah']) ?></strong>
                                    </td>
                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                </tr>
                            <?php
                            endwhile;
                        else:
                            ?>
                            <tr>
                                <td colspan="6" class="no-data">
                                    <i class="fas fa-inbox"></i>
                                    <strong>Tidak ada transaksi pada periode ini</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form method="post" action="export_excel.php">
            <button type="submit" name="export" class="btn btn-success">Export ke Excel</button>
        </form>
    </div>

    <div class="footer fade-in">
        <p>
            <i class="fas fa-sync-alt loading"></i>
            Laporan terakhir diperbarui: <strong><?= date('d/m/Y H:i:s') ?></strong>
        </p>
        <p style="margin-top: 10px; color: var(--gray); font-size: 0.9rem;">
            <i class="fas fa-heart" style="color: var(--danger);"></i>
            Sistem Keuangan UKM - Kelola keuangan dengan mudah dan efisien
        </p>
    </div>
    </div>

    <script>
        // Animasi loading untuk refresh data
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in animation untuk semua elemen
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Hover effect untuk cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
            // Auto refresh setiap 5 menit
            setInterval(function() {
                const loading = document.querySelector('.loading');
                if (loading) {
                    loading.style.animation = 'spin 0.5s ease-in-out infinite';
                    setTimeout(() => {
                        loading.style.animation = 'spin 1s ease-in-out infinite';
                    }, 2000);
                }
            }, 300000);
        });

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--primary-blue)'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // CSS untuk animasi notifikasi
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>