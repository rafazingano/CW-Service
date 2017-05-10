@extends('layouts.default')

@section('content')
<main>
    <section class="perfil">
        <div class="container infos-perfil">
            @include('partials.profile-top')
            <div class="conteudo col-xs-12 col-md-9">
                <div class="abas col-xs-12">
                    <div class="aba-rel col-xs-6 col-md-4">
                        <div class="aba new active" id="aba-rel">
                            <img src="{{ asset('assets/img/icon-aprovados-e-pendentes.png') }}" alt="Nova solicitação">
                            <span>KOOTES RELACIONADOS</span>
                        </div>
                    </div>
                    <div class="aba-apr col-xs-6 col-md-4">
                        <div class="aba old" id="aba-apr">
                            <img src="{{ asset('assets/img/icone-aprovadospendentes-2.png') }}" alt="Minhas solicitações">
                            <span>APROVADOS E PENDENTES</span>
                        </div>
                    </div>
                </div>
                <div class="relacionados col-xs-12 col-md-12">
                    @if(isset($demands) && count($demands) > 0)
                    @foreach($demands as $m_demand)
                    <article class="koote col-xs-12 col-md-12" id="k-{{ $m_demand->id }}">
                        <div class="topo col-xs-12 col-md-12 nopadding">
                            <div class="col-xs-1 col-md-1 nopadding">
                                <span class="abre" data-target="k-{{ $m_demand->id }}"></span>
                            </div>
                            <div class="col-xs-10 col-md-10 nopadding infos-koote">
                                <div class="col-xs-8 col-sm-6 col-md-5 nopadding local">
                                    <img src="{{ asset('assets/img/mini-localizacao.png') }}">
                                    <span class="local">
                                        {{ $m_demand->location->state->abbr }} - 
                                        {{ $m_demand->location->city->title }} - 
                                        {{ $m_demand->location->neighborhood->title }}
                                    </span>
                                </div>
                                <div class="col-xs-4 col-sm-6 col-md-7 nopadding">
                                    <img src="{{ asset('assets/img/relogio.png') }}">
                                    <span class="horario">
                                        @php
                                        $date = strtotime($m_demand->deadline);
                                        $remaining = $date - time();
                                        $days_remaining = floor($remaining / 86400);
                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                        @endphp
                                        @if($days_remaining > 0)
                                        {{ $days_remaining }} dias
                                        @elseif ($hours_remaining > 0)
                                        {{ $hours_remaining }} horas
                                        @else 
                                        Finalizado
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-1 col-md-1 nopadding">
                                <span class="remover" data-target="k-{{ $m_demand->id }}"></span>
                            </div>
                        </div>
                        <div class="descricao col-xs-12">
                            <div class="desc" data-target="k-{{ $m_demand->id }}">
                                <p>{{ $m_demand->content }}</p>
                                <div class="tag">                                    
                                    <div class="tags-balao" id="t-{{ $m_demand->id }}">
                                        @if($m_demand->tags()->count() > 0)
                                        @php
                                        $contags = 0;
                                        @endphp
                                        @foreach($m_demand->tags as $tag)
                                        @if(in_array($tag->slug, $user->tags->pluck('slug')->all()))
                                        @php 
                                        $contags++
                                        @endphp
                                        <span class="tag-balao"> {{ $tag->title }} </span>
                                        @endif
                                        @endforeach
                                        @else
                                        <span class="tag-balao"> Nenhuma tag relacionada :(</span>
                                        @endif
                                    </div>
                                    <span class="quant" data-target="t-{{ $m_demand->id }}">{{ $contags }}</span>
                                </div>
                                <div class="anexo">
                                </div>
                            </div>
                            <div class="comentarios col-xs-12">
                                <article class="col-xs-12 comentario nopadding">
                                    <div class="img-comentario col-md-1 nopadding">
                                        <img src="{{ asset('assets/img/avatar-cpf.png') }}">
                                    </div>
                                    <div class="col-xs-11 resposta-prestador">
                                        <form role="form" method="POST" action="{{ route('contacts.store') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="demand_id" value="{{ $m_demand->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="22" viewBox="0 0 17 22" class="indicador-balao">
                                            <metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?>
                                            <x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        ">
                                                <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                                                    <rdf:Description rdf:about=""/>
                                                </rdf:RDF>
                                            </x:xmpmeta>                       
                                            <?xpacket end="w"?></metadata>
                                            <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #fff;
                                                    fill-rule: evenodd;
                                                }
                                            </style>
                                            </defs>
                                            <path id="Polígono_2" data-name="Polígono 2" class="cls-1" d="M0.224,1.411L33.842-.01,21.495,27.482Z"/>
                                            </svg>
                                            <textarea name="content" class="proposta" placeholder="Envie uma mensagem para oferecer a sua proposta..."></textarea>
                                            <button type="submit" class="btn btn-default">ACEITAR</button>
                                        </form> 
                                    </div>
                                </article>
                            </div>
                        </div>  
                    </article>
                    @endforeach
                    @else
                    <h4>Nenhum Koote relacionado até o momento!</h4>
                    @endif
                </div>
                <div class="aprovados-pendentes col-xs-12 col-md-12">
                    @if(isset($pending_demands) && count($pending_demands) > 0)
                    @foreach($pending_demands as $p_demand)
                    <article class="koote col-xs-12 col-md-12" id="k-{{ $p_demand->id }}">
                        <div class="topo col-xs-12 col-md-12 nopadding">
                            <div class="col-xs-1 col-md-1 nopadding">
                                <span class="abre" data-target="k-{{ $p_demand->id }}"></span>
                            </div>
                            <div class="col-xs-10 col-md-10 nopadding infos-koote">
                                <div class="col-xs-8 col-sm-6 col-md-5 nopadding local">
                                    <img src="{{ asset('assets/img/mini-localizacao.png') }}">
                                    <span class="local">
                                        {{ $p_demand->location->state->abbr }} - 
                                        {{ $p_demand->location->city->title }} - 
                                        {{ $p_demand->location->neighborhood->title }}
                                    </span>
                                </div>
                                <div class="col-xs-4 col-sm-6 col-md-7 nopadding">
                                    <img src="{{ asset('assets/img/relogio.png') }}">
                                    <span class="horario">
                                        @php
                                        $date = strtotime($p_demand->deadline);
                                        $remaining = $date - time();
                                        $days_remaining = floor($remaining / 86400);
                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                        @endphp
                                        @if($days_remaining > 0)
                                        {{ $days_remaining }} dias
                                        @elseif ($hours_remaining > 0)
                                        {{ $hours_remaining }} horas
                                        @else 
                                        Finalizado
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-1 col-md-1 nopadding">
                                <span class="remover" data-target="k-{{ $p_demand->id }}"></span>
                            </div>
                        </div>
                        <div class="descricao col-xs-12">
                            <div class="desc" data-target="k-10">
                                <div class="v col-md-1 nopadding">
                                    @if($p_demand->contacts()->where(['user_id' => $user->id, 'approved' => 'y'])->count() > 0)
                                    <img src="{{ asset('assets/img/V-verde.png') }}">
                                    @endif
                                </div>
                                <p>{{ $p_demand->content }}</p>                                    
                                <div class="tag"  data-target="t-{{ $p_demand->id }}">                                    
                                    <div class="tags-balao" id="t-{{ $p_demand->id }}">                                       
                                        @if($p_demand->tags()->count() > 0)
                                        @php
                                        $conttags = 0;
                                        @endphp
                                        @foreach($p_demand->tags as $tag)
                                        @if(in_array($tag->slug, $user->tags->pluck('slug')->all()))
                                        @php 
                                        $conttags++
                                        @endphp
                                        <span class="tag-balao"> {{ $tag->title }} </span>
                                        @endif
                                        @endforeach
                                        @else
                                        <span class="tag-balao"> Nenhuma tag relacionada :(</span>
                                        @endif
                                    </div>
                                    <span class="quant">{{ $conttags }}</span>
                                </div>
                                @if(count($p_demand->files) > 0)
                                @foreach($p_demand->files as $file)
                                <a href="{{ $file->file }}" target="_blank" class="anexo">
                                </a>
                                @endforeach
                                @endif
                            </div>
                            <div class="comentarios col-xs-12">
                                @if($p_demand->contacts->count() > 0)
                                @foreach($p_demand->contacts()->where('user_id', $user->id)->get() as $p_contact)
                                <article class="col-xs-12 comentario nopadding">
                                    <div class="img-comentario col-md-1 nopadding">
                                        <a href="{{ route('users.show', $p_contact->user) }}">
                                            <img src="{{ asset('upload/user/' . $p_contact->user->photo) }}" class="img-circle img-responsive">
                                        </a>
                                    </div>
                                    <div class="col-xs-11 resposta-prestador">
                                        <form>
                                            <p class="proposta"> 
                                                {{ $p_contact->content }}
                                            </p>
                                        </form> 
                                    </div>
                                </article>
                                @if($p_contact->approved == 'y')
                                <article class="col-xs-12 comentario nopadding">
                                    <div class="img-comentario col-md-1 nopadding">
                                        <a href="{{ route('users.show', $p_contact->demand->user) }}">
                                            <img src="{{ asset('upload/user/' . $p_contact->demand->user->photo) }}" class="img-circle img-responsive">
                                        </a>
                                    </div>
                                    <div class="col-xs-11 resposta-prestador">
                                        <form>
                                            <p class="proposta"> 
                                                Solicitação aprovada, Meu nome é {{ $p_contact->demand->user->name }}.<br>
                                                Meu email é {{ $p_contact->demand->user->email }}.<br>
                                                Meu telefone é {{ $p_contact->demand->user->phone }}.
                                            </p>
                                        </form> 
                                    </div>
                                </article>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>  
                    </article>
                    @endforeach
                    @else
                    <h4>Nenhum Koote pendente até o momento!</h4>
                    @endif
                </div>
            </div>
            <div class="conexao col-md-3 col-lg-3">
                <span class="aba-mobile">REGIÕES E TAGS</span>
                <span class="x">X</span>
                <div class="aba aba-regioes col-md-12">
                    <div class="conect">
                        <img src="{{ asset('assets/img/icon-map.jpg') }}" alt="Minhas conexões">
                        <span>MINHAS REGIÕES</span>
                    </div>
                </div>
                <div class="minhas-regioes col-xs-12">
                    @foreach($my_regions as $mr)
                    <div class="regiao col-xs-12">
                        <div class="img-regiao col-xs-2 nopadding">
                            <img class="regiao" src="{{ asset('assets/img/pin-amarelo.png') }}" alt="GPS">
                        </div>
                        <div class="texto-regiao col-xs-10 nopadding">
                            <p class="cidade-estado">{{ $mr->state->title }} - {{ $mr->city->title }}</p>
                            <p class="bairro">{{ $mr->neighborhood->title }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="aba aba-tags col-md-12">
                    <div class="conect">
                        <img src="{{ asset('assets/img/minhas-tags.png') }}" alt="Minhas conexões">
                        <span>MINHAS TAGS</span>
                    </div>
                </div>
                <div class="minhas-tags">
                    @foreach($my_tags as $mt)
                    <span class="tag">{{ $mt->title }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<link href="{{ asset('assets/css/prestador.css') }}" rel="stylesheet">
@endpush