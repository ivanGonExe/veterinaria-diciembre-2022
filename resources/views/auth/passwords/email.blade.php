@extends('layouts.app') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 <!--  iconos -->
    <script src="https://kit.fontawesome.com/b610c83f26.js" crossorigin="anonymous"></script>
 <!-- fontawesome link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.navBar {
    display : none;
}

body{
        min-height:            100vh;
	    background-image:      url('../img_veterinaria/perroContrasenia.jpg') !important;
        background-size:       cover;
        background-repeat:     no-repeat;
        background-position:   center !important;   
        background-attachment: fixed !important;
        font-weight: 14px !important;
    }
input{
    border-radius: 10px !important;
}

.container{
    margin-top: 5rem !important;
}

input:active{
        transform:  translateY(2px);
        transform:  translatex(2px);
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
        background-color: rgba(0, 0, 0, 0.4);
        height: 95%;
        width:95%;
    }

    .box{
        display:         flex;
        justify-content: center;
        align-items:     center !important;
        min-height:      90vh !important;
    }

    .card-header{
        background-color: rgba(100, 83, 153, 1) !important;
        border-left-color: #CCC;
        color:#ffffff;
    }

    .card{
        background-color: rgba(255, 255, 255, 1); 
        border-radius: 10px !important;
        width: 400px !important;
    }

    .card-body{
        background-color: none !important; 
    }

    .botonEntrar{
        border-radius: 10px !important;
    }
    .recordar:active{
        height:48%;
        width:12%;
    }
    .botonEntrar:active {
        transform:  translateY(2px);
        transform:  translatex(2px);
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
        background-color: rgba(0,111,230,0.9);
        height:47%;
        width:81%;
    }
    .form-check{
        padding-left: 8em !important;
    }
    .olvidaste{
        padding-left: 50px !important;
    }

</style> 
@section('content')

<body>
<div class="container-fluid d-flex justify-content-center mp-2">
        <div class="col-md-6 box">
            <div class="card">
                <div class="card-header container-fluid d-flex justify-content-center">{{ __('Recuperar contraseña') }} </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="container-fluid d-flex justify-content-center ">
                            <img src="/iconos/logo_footer.png"  height="150" width="150"> 
                        </div>
                        <div class="form-group row m-1 p-1">
                            
                            <div class="col-md-12">
                                <input style="font: var(--fa-font-solid); content: '\f007'; font-size:10px;"  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder= "&#xf0e0; Email" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="text-center">
                                <a href="/login" class="btn btn-secondary" tabindex="6">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    Aceptar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
