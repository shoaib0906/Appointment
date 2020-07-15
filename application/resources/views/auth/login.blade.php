@extends('layouts.auth')

@section('content')
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* style the container */
.container {
  position: relative;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 0px 0 30px 0;
} 

/* style inputs and link buttons */
input,
.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

/* Two-column layout */
.col {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 50px;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* vertical line */
.vl {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  border: 2px solid #ddd;
  height: 175px;
}

/* text inside the vertical line */
.vl-innertext {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 50%;
  padding: 8px 10px;
}

/* hide some text on medium and large screens */
.hide-md-lg {
  display: none;
}

/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
    .col {
      width: 100%;
      margin-top: 0;
    }
    /* hide the vertical line */
    .vl {
      display: none;
    }
    /* show the hidden text on small screens */
    .hide-md-lg {
      display: block;
      text-align: center;
    }
    .btn {
          margin-left: 0px!important;
      }
  }
</style>

<div class="row  ">



<div class="col-md-3">

</div>

<div class="container col-md-6 col-sm-6 col-lg-6">
  <div class="col-offset-md-5">
  <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
    <div class="row">
      <h2 style="text-align:center">@lang('quickadmin.quickadmin_title')</h2>      
      <h2 style="text-align:center">Login with Social Media or Manually</h2>
      @if (count($errors) > 0)
                        <div class="">    
                        <div class="google btn">                                                   
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach                        
                              </div>
                        </div>
      @endif

      <div class="vl">
        <span class="vl-innertext">or</span>
      </div>

      <div class="col">
        <a href="{{ url('login/facebook') }}" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
        <a href="{{ url('login/twitter') }}" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
        <a href="{{ url('login/google') }}" class="google btn"><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </a>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <p>Or sign in manually:</p>
        </div>

        

        <form >
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}" >

                        <div class="form-group">
                            

                            <div class="col-md-12">
                                <input type="email"
                                       class="form-control" 
                                       name="email"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input type="password"
                                        class="form-control" 
                                       name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-success"
                                        style="margin-right: 15px;">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
      </div>
      
    </div>
  </form>
  </div>
  <hr>
  <div class="col-offset-md-5 bottom-container">

  <div class="row">
    <div class="col">
      <a href=" {{ route('auth.register') }}" style="color:white" class="btn">Sign up</a>
    </div>
    <div class="col">
      <a href="{{ route('auth.password.reset') }}" style="color:white" class="btn">Forgot password?</a>
    </div>
  </div>
</div>
</div>


</div>
@endsection