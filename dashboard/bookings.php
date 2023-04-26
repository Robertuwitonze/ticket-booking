<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <title>Virunga Express ltd</title>
</head>

<body>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Transaction Id</th>
                <th>Used Phone</th>
                <th>Paid Amount</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // $sql = "SELECT * from payee where status =  'pending'";
            // $querys = mysqli_query($connection, $sql);
            // while ($row = mysqli_fetch_array($querys)) { 
            ?>
            <!-- <tr>
                                <td><?= $row['transactionId']; ?></td>
                                <td><?= $row['usedPhone']; ?></td>
                                <td><?= $row['amount']; ?></td>
                                <td><a href="?validate=<?= $row['id']; ?>"><button class="btn-primary">Validate</button></a>&nbsp;&nbsp;&nbsp;<a href="?del=<?= $row['id']; ?>"><button class="btn-danger">Delete</button></a></td>

                            </tr> -->
            <?php
            // }
            ?>
            <tr>
                <td>Transaction Id</td>
                <td>Used Phone</td>
                <td>Paid Amount</td>
                <td>Action</td>

            </tr>

        </tbody>
        <tfoot>
            <tr>
                <th>Transaction Id</th>
                <th>Used Phone</th>
                <th>Paid Amount</th>
                <th>Action</th>

            </tr>
        </tfoot>
    </table>
</body>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

</html>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>