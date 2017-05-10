<div class="topo-perfil col-xs-12 col-sm-12 col-md-12">
    <div class="img-perfil col-xs-12 col-sm-3 col-md-2">
        <img src="{{ asset(isset($user->photo)? 'upload/user/' . $user->photo : 'upload/user/default.jpg') }}" class="img-responsive" alt="Foto de perfil">
    </div>
    <div class="nome-perfil col-xs-12 col-sm-9 col-md-10">
        <div class="nome col-xs-10 col-sm-10 col-md-8">
            <h1 class="nome">{{ $user->name }}</h1>
        </div>
        <div class="conf col-xs-2 col-sm-2 col-md-4">
            @if($user->service_provider == 'y')
            <form role="form" method="POST" action="{{ route('user-change-account') }}">
                {{ csrf_field() }}
                <select onchange="this.form.submit()" name="service_provider" class="troca-perfil">
                    <option value="y" 
                            @if($service_provider == 'y')
                            selected
                            @endif
                            >PRESTADOR DE SERVIÇOS</option>
                    <option value="n" 
                            @if($service_provider == 'n')
                            selected
                            @endif
                            >SOLICITANTE</option>
                </select>
            </form>
            @endif
            <a href="{{ route('account') }}">
                <img src="{{ asset('assets/img/config.png') }}" id="config-img" alt="conf-img">
            </a>
        </div>
        <hr class="hr-topo-perfil col-sm-12">
        <div class="col-xs-12 col-md-12 estrelas-cidade">
            <div class="estrelas col-xs-6 col-md-4">
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
            </div>
            <div class="col-xs-6 col-md-4">
                <h4 class="cidade">
                    {{ isset($user->locations[0])? $user->locations[0]->neighborhood->city->title : '' }}
                    {{ isset($user->locations[0])? $user->locations[0]->neighborhood->city->state->abbr : '' }}
                </h4>
            </div>
        </div>
    </div>
</div>