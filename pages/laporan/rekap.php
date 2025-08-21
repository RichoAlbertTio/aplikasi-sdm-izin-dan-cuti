<?php


// Query rekap cuti & ijin
$rekap = $conn->query("
    SELECT p.id, p.nama_personel,
           SUM(CASE WHEN c.status = 'Cuti' THEN 1 ELSE 0 END) AS total_cuti,
           SUM(CASE WHEN c.status = 'Ijin' THEN 1 ELSE 0 END) AS total_ijin,
           COUNT(c.id) AS total_semua
    FROM personel p
    LEFT JOIN cuti_ijin c ON p.id = c.id_personel
    GROUP BY p.id, p.nama_personel
    ORDER BY p.nama_personel ASC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Cuti & Ijin Personel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Rekapitulasi Cuti & Ijin Personel</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Personel</th>
            <th>Jumlah Cuti</th>
            <th>Jumlah Ijin</th>
            <th>Total</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $rekap->fetch_assoc()) {
            echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['nama_personel'] . "</td>
                    <td>" . $row['total_cuti'] . "</td>
                    <td>" . $row['total_ijin'] . "</td>
                    <td>" . $row['total_semua'] . "</td>
                  </tr>";
        }
        ?>
    </table>
</body>

</html>