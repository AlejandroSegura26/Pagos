@extends('auth.contenido')

@section('login')
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background:url(https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=600)"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-2"><b>Inicio de Sesión</b></h1>
                      <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                    </div>
                  <form class="form-horizontal user was-validated" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                  <div class="form-group {{ $errors->has('usuario' ? 'is-invalid' : '')}}">
                  <input type="text" class="form-control form-control-user" value="{{ old('usuario') }}" name="usuario" id="usuario" placeholder="Ingrese el usuario...">
                        {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                      <div class="form-group {{ $errors->has('password' ? 'is-invalid' : '')}}">
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Ingresa la contraseña...">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Acceder</button>
                      </div>
                    </form>
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection