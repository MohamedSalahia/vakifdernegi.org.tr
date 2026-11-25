<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tap Payment Laravel - Webappfix</title>
</head>
<body>

<div class="container mt-5">
    <form action="{{ route('tap.payment') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6 m-auto bg-light rounded border p-3">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <h1 class="text-center">Tap Payment - Webappfix.com</h1>
                <div class="form-group mt-3">
                    <label for="first_name" class="text-blue">First Name :</label>
                    <input id="first_name" class="form-control" type="text" name="first_name" placeholder="First Name">
                    @error('first_name')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="last_name" class="text-blue">Last Name :</label>
                    <input id="last_name" class="form-control" type="text" name="last_name" placeholder="Last Name">
                    @error('last_name')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="email" class="text-blue">Email :</label>
                    <input id="email" class="form-control" type="text" name="email" placeholder="Email Address">
                    @error('email')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="phone" class="text-blue">Phone :</label>
                    <input id="phone" class="form-control" type="number" name="phone" placeholder="Phone NUmber">
                    @error('phone')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="currency" class="text-blue">Select Currency :</label>
                    <select class="form-control" name="currency" id="currency" name="currency">
                        <option value="KWD">KWD</option>
                    </select>
                    @error('currency')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="order_id" class="text-blue">Order Id :</label>
                    <input id="order_id" class="form-control" type="text" name="order_id" placeholder="Order Id" value="{{ \Str::random(10) }}">
                    @error('order_id')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="form-group mt-3">
                    <label for="name" class="text-blue">Amount :</label>
                    <input id="name" class="form-control" type="number" name="amount" placeholder="Amount">
                    @error('amount')<font color="red">{{ $message }}</font>@endError
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-success">Pay Now</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>