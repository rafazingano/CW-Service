<header>
    <div class="container">
        <div class="col-sm-12 col-sm-3 col-md-7 logo">
            <a href="{{ url('/') }}" alt="Koote!"><img src="{{ asset('assets/img/logo-topo.png') }}" alt="Koote!"/></a>
        </div>
        @if (Auth::guest())
        <div class="col-sm-12 col-sm-9 col-md-5 login">
            <form role="form" method="POST" action="{{ route('entrar') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>E-mail:</label>
                    <input type="text" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Senha:</label>
                    <input type="password" name="password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <!--a href="{{ route('password.request') }}" class="esqueceu-senha"> Esqueceu a senha? </a-->
                </div>
                <button type="submit" class="btn btn-default">ENTRAR</button>
            </form>
        </div>
        @else
        <div class="col-xs-12 col-sm-12 col-sm-9 col-md-5 bemvindo">
            <span>Bem-vindo, {{ Auth::user()->name }}!</span>
            <a type="submit" class="btn" href="{{ route('sair') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SAIR</a>
            <form id="logout-form" action="{{ route('sair') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        @endif
    </div>
</header>