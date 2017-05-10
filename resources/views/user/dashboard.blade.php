@extends('layouts.default')

@section('content')
<main>
    <section class="perfil">
        <div class="container infos-perfil">
            @include('partials.profile-top')
            <div class="conteudo col-xs-12 col-md-9">
                <div class="abas col-xs-12">
                    <div class="aba-new col-xs-6 col-md-4">
                        <div class="aba new active" id="aba-new">
                            <img src="{{ asset('assets/img/nova-solicitacao.png') }}" alt="Nova solicitação">
                            <span>NOVA SOLICITAÇÃO</span>
                        </div>
                    </div>
                    <div class="aba-old col-xs-6 col-md-4">
                        <div class="aba old" id="aba-old">
                            <img src="{{ asset('assets/img/minhas-solicitacoes.png') }}" alt="Minhas solicitações">
                            <span>MINHAS SOLICITAÇÕES</span>
                        </div>
                    </div>
                </div>
                <div class="formulario-new col-xs-12 col-md-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ trans(session('message')) }}
                    </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('demands.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="descricao">O que você deseja solicitar?</label>
                            <textarea placeholder="Descreva detalhes da sua solicitação..." id="descricao" name="content"></textarea>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 nopadding ">
                            <label for="arquivo">Deseja anexar um arquivo?</label>
                            <div class="file">
                                <input type="file" name="file" id="arquivo">
                                <div class="sobre">
                                    <div class="btn-holder holder-left"><img class="icon" src="{{ asset('assets/img/anexo.png') }}"></div>
                                    <span id="nome-arq">Selecione...</span>
                                    <div class="btn-holder holder-right"><a class="btn procura-arq">PROCURAR</a></div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 nopadding">
                            <label for="data">Qual o prazo?</label>
                            <div class="data-max">
                                <img class="icon-data" src="{{ asset('assets/img/calendario.png') }}">
                                <input type="date" name="deadline_date" id="data" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                <select name="deadline_hour" class="hora">
                                    <option value="7:00:00">7:00</option>
                                    <option value="8:00:00">8:00</option>
                                    <option value="9:00:00">9:00</option>
                                    <option value="10:00:00">10:00</option>
                                    <option value="11:00:00">11:00</option>
                                    <option value="12:00:00">12:00</option>
                                    <option value="13:00:00">13:00</option>
                                    <option value="14:00:00">14:00</option>
                                    <option value="15:00:00">15:00</option>
                                    <option value="16:00:00">16:00</option>
                                    <option value="17:00:00">17:00</option>
                                    <option value="18:00:00">18:00</option>
                                    <option value="19:00:00">19:00</option>
                                    <option value="20:00:00">20:00</option>
                                    <option value="21:00:00">21:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group check">
                            <label>Para onde é a sua solicitação?</label>
                            <div id="radioset">
                                <input type="radio" id="my_address" name="address" checked="checked" value="my" class="address"><label for="my_address">Minha localização</label>
                                <input type="radio" id="other_Address" name="address" value="other" class="address"><label for="other_Address">Novo endereço</label>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 col-md-2 nopadding other-location">
                            <label for="estado">Estado:</label>
                            <select name="state_id" id="state">
                                <option value="">Todos</option>
                                @foreach($states as $state)
                                <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 col-md-5 nopadding other-location">
                            <label for="cidade">Cidade:</label>
                            <select name="city_id" id="city">
                                <option value="">Selecione um estado</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 col-md-5 nopadding other-location">
                            <label for="bairro">Bairro:</label>
                            <select name="neighborhood_id" id="neighborhood">
                                <option value="">Selecione uma cidade</option>  
                            </select>
                        </div>
                        <div class="form-group check">
                            <label for="quem">Enviar solicitação para quem?</label>
                            <div id="radioset1">
                                <input type="radio" id="radio3" name="who" checked="checked" value="1"><label for="radio3">Todos</label>
                                <input type="radio" id="radio4" name="who" value="2"><label for="radio4">Minhas conexões</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">ENVIAR</button>
                    </form>
                </div>
                @forelse($my_demands as $my_demand)
                <div class="solicitacoes col-xs-12 col-md-12">                    
                    <article class="koote col-xs-12 col-md-12" id="k-{{ $my_demand->id }}">
                        <div class="topo col-xs-12 col-md-12 nopadding">
                            <div class="col-xs-2 col-md-2 nopadding">
                                <span class="abre" data-target="k-{{ $my_demand->id }}"></span>
                            </div>
                            <div class="col-xs-offset-3 col-sm-offset-5 col-md-offset-6 col-xs-7 col-sm-5 col-md-4 infos-koote">
                                <img class="icone-calendar" src="{{ asset('assets/img/calendario-pequeno.png') }}">
                                <span class="data">{{ date('d/m/Y', strtotime($my_demand->deadline)) }}</span>
                                <span class="hora">{{ date('H:i', strtotime($my_demand->deadline)) }}</span>
                            </div>
                        </div>
                        <div class="descricao col-xs-12">
                            <div class="desc" data-target="k-{{ $my_demand->id }}">
                                <p>{{ $my_demand->content }}</p>
                                <div class="balao">
                                    <span class="quant">{{ $my_demand->contacts()->count() }}</span>
                                </div>
                            </div>
                            <div class="comentarios col-xs-12">
                                @foreach($my_demand->contacts as $contact)
                                <article class="comentario col-xs-12">
                                    <div class="img-comentario col-md-1 nopadding">
                                        <a href="{{ route('users.show', $contact->user) }}">
                                            <img src="{{ asset('upload/user/' . $contact->user->photo) }}" class="img-circle img-responsive">
                                        </a>
                                    </div>
                                    <div class="texto-comentario col-md-9">
                                        <p>{{ $contact->content }}</p>
                                    </div>
                                    <div class="aceitar col-md-2">
                                        @if(!empty($contact->approved))
                                        <b style="color: rgba(59, 61, 64, 0.46);"><i>{{ ($contact->approved == 'y')? 'Aprovado' : 'Reprovado' }}</i></b>
                                        @else
                                        <form role="form" method="POST" action="{{ route('contacts.update', $contact) }}">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <input type="hidden" name="approved" value="y">

                                            <button type="submit" class="btn btn-link">
                                                <img id="y" src="{{ asset('assets/img/botao-check.png') }}">
                                            </button>
                                        </form> 
                                        <form role="form" method="POST" action="{{ route('contacts.update', $contact) }}">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <input type="hidden" name="approved" value="n">
                                            <button type="submit" class="btn btn-link">
                                                <img id="n" src="{{ asset('assets/img/botao-x.png') }}">
                                            </button>
                                        </form> 
                                        @endif
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>  
                    </article>                    
                </div>
                @empty
                <div class="solicitacoes col-xs-12 col-md-12"> 
                    <p>Nenhuma solicitação</p>
                </div>
                @endforelse
            </div>
            <div class="conexao col-md-3 col-lg-3">
                <span class="x">X</span>
                <div class="aba aba-conexao col-md-12">
                    <div class="conect">
                        <img src="{{ asset('assets/img/minhas-conexoes.png') }}" alt="Minhas conexões">
                        <span id="conexoes-desktop">MINHAS CONEXÕES</span>
                        <span id="conexoes-mobile">CONEXÕES</span>
                    </div>
                </div>
                <div class="peoples-conexao">
                    @foreach($my_conections as $m_cnx)
                    <div class="people col-xs-12 col-md-12">
                        <div class="col-xs-2 col-md-2 people-img">
                            <img src="{{ asset('upload/user/' . $m_cnx->photo) }}" width="40" class="img-circle " alt="Foto da conexão">
                        </div>
                        <div class="col-xs-8 col-md-8 people-texto">
                            <p class="nome">{{ $m_cnx->name }}</p>
                            <p class="funcao"> </p>
                        </div>
                        <!--div class="col-xs-2 col-md-2">
                            <img src="{{ asset('assets/img/indicar-ativo.png') }}" alt="Recomendar">
                        </div-->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<link href="{{ asset('assets/css/solicitante.css') }}" rel="stylesheet">
@endpush