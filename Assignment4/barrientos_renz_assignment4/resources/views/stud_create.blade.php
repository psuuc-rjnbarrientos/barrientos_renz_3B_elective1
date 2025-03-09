<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Management | Add</title>
</head>
<body>
    <form action="/create" method="POST">
        @csrf
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="stud_name"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" value="Add Student"></td>
            </tr>
        </table>
    </form>
</body>
</html>