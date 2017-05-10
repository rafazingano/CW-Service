@extends('layouts.default')

@section('content')
<main>
    <section class="minha-conta">
        <div class="container formulario">
            <div class="col-xs-12">
                <h1 class="cadastrese">Minha Conta</h1>
            </div>
            <div class="col-xs-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ trans($error) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Muito bem!</strong> {{ trans(session('message')) }}
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-md-4 menu">
                <ul>
                    <li id="menu-1" class="active"><span>1</span>DADOS PESSOAIS</li>
                    <li id="menu-2"><span>2</span>LOCALIZAÇÃO</li>
                    <li id="menu-3"><span>3</span>PRESTADOR</li>
                </ul>
                <div class="foto">
                    <img class="foto-img img-responsive" src="{{ asset(isset($user->photo)? 'upload/user/' . $user->photo : 'upload/user/default.jpg') }}">
                    <div class="file">
                        <form role="form" method="POST" action="{{ route('user-change-photo', $user) }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="photo" id="arquivo" onchange="this.form.submit()">
                        </form>
                        <div class="sobre">
                            <div class="btn-holder holder-right"><a class="btn procura-arq"><img src="{{ asset('assets/img/foto.png') }}">Alterar foto</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <form role="form" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="status" value="1">
                <div class="col-xs-12 col-md-4 menu menu-mobile">
                    <ul>
                        <li id="menu-1" class="active"><span>1</span>DADOS PESSOAIS</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-dados-pessoais">
                    <div class="form-group col-xs-12 col-md-12">
                        <label for="nome">Nome:</label>
                        <input id="nome" class="form-control" type="text" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="email">E-mail:</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input id="telefone" class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="senha">Senha:</label>
                        <input id="senha" class="form-control" type="password" name="password" value="">
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="conf-senha">Confirmar senha:</label>
                        <input id="conf-senha" class="form-control" type="password" name="password_confirmation" value="">
                    </div>
                    <div class="form-group col-xs-12 margintop">
                        <label for="cpf-cnpj"> Informe o seu CPF ou CNPJ da sua empresa:</label>
                        <div class="col-xs-5 col-md-2 nopadding">
                            <select id="cpf-cnpj" name="select_cpf_cnpj">
                                <option value="cpf" selected>CPF</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                        </div>
                        <div class="col-xs-7 col-md-10 nopadding">
                            <input id="cpf-cnpj" class="form-control" type="text" name="cpf_cnpj" value="{{ $user->cpf_cnpj }}">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 margintop check">
                        <label for="prestador">Gostaria de fazer o cadastro como prestador de serviços?</label>
                        <div id="radioset">
                            <input type="radio" id="radio1" name="service_provider" 
                                   @if($user->service_provider == 'y')
                                   checked="checked"
                                   @endif
                                   value="y"><label for="radio1">Sim. Quero prestar serviços.</label>
                            <input type="radio" id="radio2" name="service_provider" 
                                   @if($user->service_provider == 'n')
                                   checked="checked"
                                   @endif
                                   value="n"><label for="radio2">Não. Só quero cotar.</label>
                        </div>
                    </div>    
                    <a class="btn btn-default" id="proxima-etapa">AVANÇAR</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-default" id="">VOLTAR</a>
                </div>
                <div class="col-xs-12 col-md-4 menu menu-mobile">
                    <ul>
                        <li id="menu-2"><span>2</span>LOCALIZAÇÃO</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao">
                    <div class="form-group col-xs-12 col-md-3 col-lg-2 nopadding">
                        <label for="estado">Estado:</label>
                        <select name="location[1][state_id]" id="state">
                            <option value="">Todos</option>
                            @foreach($states as $state)
                            <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-4 col-lg-5 nopadding">
                        <label for="cidade">Cidade:</label>
                        <select name="location[1][city_id]" id="city">
                            <option value="">Selecione um estado</option>                           
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 nopadding">
                        <label for="bairro">Bairro:</label>
                        <select name="location[1][neighborhood_id]" id="neighborhood">
                            <option value="">Selecione uma cidade</option> 
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-prestador">
                    @php
                    $tagsinput = null;
                    @endphp
                    @foreach($my_locations as $m_l)
                    @php
                    $tagsinput .= $m_l->state->title . ' - ' . $m_l->city->title . ' - ' . $m_l->neighborhood->title . ',';
                    @endphp
                    <input type="hidden" name="location[{{ $m_l->state->id . $m_l->city->id . $m_l->neighborhood->id }}][state_id]" value="{{ $m_l->state->id }}">
                    <input type="hidden" name="location[{{ $m_l->state->id . $m_l->city->id . $m_l->neighborhood->id }}][city_id]" value="{{ $m_l->city->id }}">
                    <input type="hidden" name="location[{{ $m_l->state->id . $m_l->city->id . $m_l->neighborhood->id }}][neighborhood_id]" value="{{ $m_l->neighborhood->id }}">
                    @endforeach
                    <span class="mais">+</span>
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <label for="regiões">Minhas regiões:</label>
                        <input type="text" data-role="tagsinput" class="label-teste" value="{{ $tagsinput }}"/>
                    </div>                    
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-cotar">  
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao">
                    <a class="btn btn-default" id="proxima-etapa-3">AVANÇAR</a>
                    <button type="submit" class="btn btn-default" id="salvar">SALVAR</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-default" id="">VOLTAR</a>
                </div>
                <div class="col-xs-12 col-md-4 menu menu-mobile">
                    <ul>
                        <li id="menu-3"><span>3</span>PRESTADOR</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-prestador">
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <div class="col-xs-12 nopadding">
                            <label for="descricao">Apresentação:</label>
                        </div>
                        <div class="col-xs-12 nopadding">
                            <textarea name="content" id="descricao">{{ $user->content }}</textarea>
                        </div>                            
                    </div>
                    <div class="form-group col-xs-12 col-md-12 nopadding form-tag-prestador">
                        
                        @php
                    $tagsinput1 = null;
                    @endphp
                    @foreach($my_tags as $m_t)
                    @php
                    $tagsinput1 .= $m_t->title . ',';
                    @endphp
                    <input type="hidden" name="tag[]" value="{{ $m_t->title }}">
                    @endforeach
                    
                    </div>
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <label for="tag">Criar nova tag:</label>
                        <input type="text" name="add_tag" id="tag" maxlength="15">
                        <span class="txto-input-tag">Cadastre palavras-chave à sua área de atuação</span>
                        <span class="mais-tag">+</span> 
                    </div>
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <label for="regiões">Minhas tags:</label>
                        <input type="text" data-role="tagsinput" class="label-tag" value="{{ $tagsinput1 }}"/>
                    </div>
                    <button type="submit" class="btn btn-default" id="salvar">SALVAR</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-default" id="">VOLTAR</a>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection

@push('styles')
<link href="{{ asset('assets/css/minha-conta.css') }}" rel="stylesheet">
@endpush