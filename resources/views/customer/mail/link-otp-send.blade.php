<html>

<head>
    <title>Forget Password</title>
    <style>
    .cart {
        margin: auto;
        width: 50%;
        background-color: #FDFEFE;
        border: 0px solid;
        padding: 10px;
        text-align: center;

    }

    img {
        width: 250px;
        height: 67px;
    }
    </style>
</head>
<body>
    <div class="cart">
        <img src="{{asset('assets/img/header-logo.png')}}" />
        <div>
            <p>Your OTP Code {{$code}}</p>
            <br/>
            <p>Reset Password Link {{$link}}</p>
        </div>
    </div>
</body>
</html>
