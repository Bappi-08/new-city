<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Who Have Been Registered</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #bbc2b9;
            color: #fff;
        }
        .card-header b {
            font-size: 1.2rem;
        }
        #daterange {
            background: rgb(126, 131, 124);
            color: #fff;
            border-radius: 5px;
        }
        #daterange:hover {
            background: #5f645e;
            color: #fff;
        }
        .table th {
            background-color: #bbc2b9;
            color: #fff;
        }
        .table tbody tr {
            background-color: #f8f9fa;
            color: #212529;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center text-dark mt-5 mb-5"><b>Users Who Have Been Registered</b></h1>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-9"><b>Users</b></div>
                    <div class="col col-3">
                        <div id="daterange" class="float-end" style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> 
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="daterange_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created On</th>
                            <th>Action</th> <!-- Add this line -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="daterange_table">
            <!-- Table content here -->
        </table>
        <div class="text-center mt-4">
            <a href="{{ route('admin.') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
     $(function () {
    var start_date = moment().subtract(1, 'months');
    var end_date = moment();

    $('#daterange').daterangepicker({
        startDate: start_date,
        endDate: end_date,
        ranges: {
            'Today': [moment().startOf('day'), moment().endOf('day')],
            'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Custom Range': [moment().subtract(1, 'months'), moment()]
        },
        locale: {
            format: 'YYYY-MM-DD' // Ensure this format matches your server-side expectations
        }
    }, function(start_date, end_date){
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
        table.draw();
    });

    var table = $('#daterange_table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: -1, // Show all records
        ajax: {
            
            url: "{{ route('admin.users') }}",
            type: 'GET',
            data: function(data){
                data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#daterange_table').on('click', '.deleteUser', function () {
        var id = $(this).data('id');
        var url = "{{ route('admin.users.destroy', ':id') }}".replace(':id', id);

        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        table.draw(); // Refresh DataTable after delete
                        alert(response.success);
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                error: function (response) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    });
});


    </script>

</body>
</html>
