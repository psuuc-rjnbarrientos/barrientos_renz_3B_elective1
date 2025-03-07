<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000;
            /* Pitch black background */
            color: white;
        }

        .card-custom {
            background-color: #121212;
            /* Slightly lighter black for the card */
            border: 1px solid red;
            /* Red border */
        }

        .form-control {
            background-color: #343a40 !important;
            /* Dark gray fields */
            color: white !important;
            border: 1px solid red !important;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="card card-custom shadow p-4 text-white">
            <h2 class="text-center text-danger">Personal Information</h2>
            <hr class="border-danger">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>First Name</b></label>
                        <input type="text" name="firstName" class="form-control" value="{{ old('firstName') }}">
                        @error('firstName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Last Name</b></label>
                        <input type="text" name="lastName" class="form-control" value="{{ old('lastName') }}">
                        @error('lastName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block"><b>Sex</b></label>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sex" id="male" value="male" class="form-check-input">
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sex" id="female" value="female" class="form-check-input">
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Mobile Phone</b></label>
                        <input type="text" name="mobilePhone" class="form-control" value="{{ old('mobilePhone') }}">
                        @error('mobilePhone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Tel No.</b></label>
                        <input type="tel" name="telNo" class="form-control" value="{{ old('telNo') }}">
                        @error('telNo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Birth Date</b></label>
                        <input type="date" name="birthDate" class="form-control"
                            value="{{ old('birthDate', date('Y-m-d')) }}">
                        @error('birthDate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Address</b></label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Email</b></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><b>Website</b></label>
                        <input type="text" name="website" class="form-control" value="{{ old('website') }}">
                        @error('website')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-danger px-5">Submit</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>