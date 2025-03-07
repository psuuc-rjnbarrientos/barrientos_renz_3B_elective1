<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>

<body>
    <h1>Personal Information</h1>
    <hr>
    @if (session('success'))
        <h4 style="color:green">{{ session('success') }}</h4>
        <hr>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/" method="post">
        @csrf
        <table>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="firstName" value="{{ old('firstName') }}"></td>
                <td>
                    @error('firstName')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lastName" value="{{ old('lastName') }}"></td>
                <td>
                    @error('lastName')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Sex</td>
                <td>

                    <input type="radio" name="sex" id="male" value="male">Male
                    <input type="radio" name="sex" id="female" value="female">Female
                </td>
            </tr>

            <tr>
                <td>Mobile Phone</td>
                <td><input type="text" name="mobilePhone" value="{{ old('mobilePhone') }}"></td>
                <td>
                    @error('mobilePhone')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Tel No.</td>
                <td><input type="tel" name="telNo" value="{{ old('telNo') }}"></td>
                <td>
                    @error('telNo')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Birth date</td>
                <td><input type="date" name="birthDate" value="{{ old('birthDate', date('Y-m-d')) }}"></td>
                <td>
                    @error('birthDate')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td><input type="text" name="address" value="{{ old('address') }}"></td>
                <td>
                    @error('address')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="{{ old('email') }}"></td>
                <td>
                    @error('email')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Website</td>
                <td><input type="text" name="website" value="{{ old('website') }}"></td>
                <td>
                    @error('website')
                        <div class="text-red-500 text-sm">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <button type="submit">Submit</button>
                </td>
            </tr>

        </table>
    </form>
</body>

</html>
