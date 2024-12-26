<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  {{-- Boot strapが　使えないので　CSSでスタイルをあてる--}}
  <style>
    .btn{
      padding:10px 20px;
      background-color:#007bff;
      color:white;
      text-align:center;
      border-radius:5px;
      text-decoration:none;
      cursor:pointer;
    }
    .title{
      text-align:center;
    }
    span{
      font-weight: bold;
    }
    .btn{
      margin-top: 3;
      margin-bottom: 3;
    }
    .notice{
      font-size:0.8rem;
      margin-top: 3;
      margin-bottom: 3;
    }
    .trademark{
      font-size:0.8rem;
      text:muted;
      text-align:center;


    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-10">
        <div class="title">
          <h2>Welcome to Insta app!</h2>
          <hr>
        </div>
        <div class="row">
          <p>
            <span>Hi {{$name}},</span><br>
            Thank you for signup to Insta app. We're excited to have you on board!<br>
            To get started, please confirm your email addressby clicking the button below:
          </p>
          <a href="{{route('index')}}" class="btn">Confirm Email Address</a>
          <p>
            Best regards,<br>
            Kredo Team<br>
          </p>
          <p class="notice">
            If you did not sign up for this account, you can ignore this email.
          </p>
  
          <hr>
        </div>
        <div class="trademark">
          <p class="">©2024 Kredo Insta App. All rights reserved.</p>
        </div>
      </div>
      
    </div>
  </div>
  
</body>
</html>

