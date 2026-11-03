<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
</head>
<body>
<table class="table" style="padding:2px; border: 1px solid;" border="2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mark</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $st)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $st['name'] }}</td>
            <td>{{ $st['mark'] }}</td>
        </tr>
    @endforeach
    </tbody>

    
</table>
</body>
</html>