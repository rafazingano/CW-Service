@extends('layouts.default')

@section('content')
<main>
    <section class="perfil publico">
        <div class="container infos-perfil">
            @include('partials.profile-top')
            <div class="conexao col-md-3 col-lg-3 perfil-publico">
                <span class="aba-mobile">REGIÕES</span>
                <span class="x">X</span>
                <div class="aba aba-regioes col-md-12">
                    <div class="conect">
                        <img src="{{ asset('assets/img/icon-map.jpg') }}" alt="Minhas conexões">
                        <span>ÁREAS DE ATUAÇÃO</span>
                    </div>
                </div>
                <div class="minhas-regioes col-xs-12 nopadding">
                    <div class="regiao col-xs-12 nopadding">
                        <div class="img-regiao col-xs-2 nopadding">
                            <img class="regiao" src="{{ asset('assets/img/pin-amarelo.png') }}" alt="GPS">
                        </div>
                        <div class="texto-regiao col-xs-10 nopadding">
                            <p class="cidade-estado">RS - Porto Alegre</p>
                            <p class="bairro">Auxiliadora</p>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="conteudo col-xs-12 col-md-9 perfil-publico ">
                <p class="descricao">{{ $user->content }}</p>
            </div>
        </div>
        <div class="container nopadding">
            <a href="javascript:window.history.go(-1)" class="btn">VOLTAR</a>
        </div>
    </section>
</main>

@endsection

@push('styles')
<link href="{{ asset('assets/css/prestador.css') }}" rel="stylesheet">
@endpush