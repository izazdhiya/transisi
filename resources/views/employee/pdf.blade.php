<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Transisi | Employee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Employee Data</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody class="small">
                @php
                    $number = 1;
                @endphp

                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $number++ }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>{{ $employee->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>