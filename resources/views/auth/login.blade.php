@extends('layouts.guest')

<style>
:root{
	--primary:#02621D;
	--red:#053a14;
	--yellow:#001a08;
}

body{
	background-color: #19123B;
	overflow: hidden;
	margin: 0;
	padding: 0;
	height: 10vh;
	background: rgb(195,195,195);
background: radial-gradient(circle, rgba(195,195,195,1) 0%, rgba(235,247,239,1) 100%);
	/* background-image: linear-gradient(90deg, #d2dad3, #fcfffdec);		
	background-repeat: no-repeat;
	background-size: 100% 100%; */

}


* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;	
	font-family: Raleway, sans-serif;
}

.card{
	border: none;
	border-top: 5px solid  rgb(176,106,252);
	background: #212042;
	color: #57557A;
}
p{
	font-weight: 600;
	font-size: 15px;
}
.fab{
	display: flex;
	justify-content: center;
	align-items: center;
	border: none;
	background: #2A284D;
	height: 40px;
	width: 90px;
}
.fab:hover{
	cursor: pointer;
}
.fa-twitter{
	color: #56ABEC;
}
.fa-facebook{
	color: #1775F1;
}
.fa-google{
	color: #CB5048;
}
.division{
	float: none;
	position: relative;
	margin: 30px auto 20px;
	text-align: center;
	width: 100%;
	box-sizing: border-box;
}
.division .line{
	border-top: 1.5px solid #57557A;;
	position: absolute;
	top: 13px;
	width: 85%;
}
.line.l{
	left: 52px;
}
.line.r{
	right: 45px;

}
.division span{
	font-weight: 600;
	font-size: 14px;
}
.myform{
	padding: 0 25px 0 33px;
}
.form-control{
	border: 1px solid #57557A;
	border-radius: 3px;
	background: #212042;
	margin-bottom: 20px;
	letter-spacing: 1px;
	
}
.form-control:focus{
	border: 1px solid #57557A;
	border-radius: 3px;
	box-shadow: none;
	background: #212042;
	color: #fff;
	letter-spacing: 1px;
}
.bn{
	text-decoration: underline;
}
.bn:hover{
	cursor: pointer;
}
.form-check-input {
    margin-top: 8px!important;
    }
.btn-primary{
background: linear-gradient(135deg, rgba(176,106,252,1) 39%,rgba(116,17,255,1) 101%);
border: none;
border-radius: 50px;
}
.btn-primary:focus{
	box-shadow: none;
	border: none;
}
small{
	color: #F2CEFF;
}
.far.fa-user{
	font-size: 13px;
}

@media(min-width: 767px){
	.bn{
		text-align: right;
	}
}
@media(max-width: 767px){
	.form-check{
		text-align: center;
	}
	.bn{
		text-align: center;
		align-items: center;
	}
}
@media(max-width: 450px){
	.fab{
		width: 100%;
		height: 100%;
	}
	.division .line{
		width: 50%;
	}
}

@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');



.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
	
}

.screen {		
	background: var(--primary);		
	position: relative;	
	height: max-content;
	width: 360px;	
	/* box-shadow: 0px 0px 24px var(--primary); */
	/* box-shadow: 10px 10px 49px 3px rgba(0,0,0,0.75); */
	box-shadow: 17px 32px 53px 3px rgba(0,0,0,0.53);
-webkit-box-shadow: 17px 32px 53px 3px rgba(0,0,0,0.53);
-moz-box-shadow: 17px 32px 53px 3px rgba(0,0,0,0.53);
}

.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #FFF;	
	top: -50px;
	right: 120px;	
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 220px;
	width: 220px;
	background: #02621D;	
	top: -172px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg, #001a08, #053a14 );
	top: -24px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: #001a08;	
	top: 420px;
	right: 50px;	
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 156px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
}

.login__icon {
	position: absolute;
	top: 30px;
	color: var(--red);
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 10px;
	padding-left: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: var(--red);
}

.login__submit {
	background: inherit;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: var(--red);
	box-shadow: 2px 2px 2px #001a08;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: var(--red);
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-left: auto;
	color: var(--red);
}

.social-login {	
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	right: 0px;
	color: #fff;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color: #fff;
	text-decoration: none;	
	text-shadow: 0px 0px 8px #b8a433;
}

.social-login__icon:hover {
	transform: scale(1.5);	
}

.tituloform{
	margin-top: -3rem;
	color: var(--red);
	font-family: Raleway, sans-serif;
	font-size: 2rem;
}
</style>

@section('content')
<div class="container">
	<!-- <img src="{{asset('img/logoRifa.jpeg')}}" alt="..."> -->
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="POST" action="{{ route('login') }}">
			@csrf
			<h3 class="tituloform" style="color: #053a14;"><strong>Inicia Sesión</strong></h3>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="email" id="email" class="login__input" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" id="password" class="login__input" placeholder="Contraseña" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
				</div>
					<button type="submit" class="button login__submit">
					{{ __('Ingresar') }}
				</button>
					<span class="button__text"></span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
@endsection


