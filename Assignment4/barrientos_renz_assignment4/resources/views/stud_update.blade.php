<html>

<head>
    <title>Student Management | Edit</title>
</head>

<body>
    <form action="/edit/<?php echo $users[0]->id; ?>" method="post">
        @csrf
        <table>
            <tr>
                <td>Name</td>
                <td>
                    <input type='text' name='stud_name' value='<?php echo $users[0]->name; ?>' />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value="Update student" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>