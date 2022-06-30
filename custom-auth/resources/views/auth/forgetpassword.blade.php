<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form action="{{route("custom_forget_password")}}" method="post">
                    <br>
                    @if(Session::has("fail"))
                        <div class="alert alert-danger"> {{Session::get("fail")}} </div>
                    @endif
                    <h3>Forget password</h3>
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{old("email")}}" placeholder="Please enter email to reset password" class="form-control">
                        <span class="text-danger"> @error("email") {{$message}} @enderror  </span>
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="submit" name="submit" value="submit" class="form-control btn btn-primary">
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="form-group">
                            <a href="{{route("login")}}" class="form-control btn btn-success"> Back To login </a>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-sm-3"> </div>
        </div>
    </div>
</body>
</html>