@extends('layouts.default')

@section('content')
<main>
    <section class="cadastro">
        <form role="form" method="POST" action="{{ route('cadastro') }}">
            {{ csrf_field() }}
            <input type="hidden" name="status" value="1">
            <div class="container formulario">
                <div class="col-xs-12">
                    <h1 class="cadastrese">Cadastre-se</h1>
                </div>
                <div class="col-xs-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-xs-12 col-md-4 menu">
                    <ul>
                        <li id="menu-1" class="active"><span>1</span>DADOS PESSOAIS</li>
                        <li id="menu-2"><span>2</span>LOCALIZAÇÃO</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-dados-pessoais">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-xs-12 col-md-12">
                        <label for="name">Nome:</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="email">E-mail:</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input id="telefone" class="form-control" type="text" name="phone" value="{{ old('phone') }}" required>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="senha">Senha:</label>
                        <input id="senha" class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="conf-senha">Confirmar senha:</label>
                        <input id="conf-senha" class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group col-xs-12 margintop check">
                        <label for="prestador">Gostaria de fazer o cadastro como prestador de serviços?</label>
                        <div id="radioset">
                            <input type="radio" id="radio1" name="service_provider" value="y"><label for="radio1">Sim. Quero prestar serviços.</label>
                            <input type="radio" id="radio2" name="service_provider" checked="checked" value="n"><label for="radio2" >Não. Só quero cotar.</label>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 margintop div-cpf-cnpj">
                        <label for="cpf-cnpj"> Informe o seu CPF ou CNPJ da sua empresa:</label>
                        <div class="col-xs-5 col-md-2 nopadding">
                            <select class="select_cpf_cnpj" id="cpf-cnpj" name="select_cpf_cnpj">
                                <option value="cpf" selected>CPF</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                        </div>
                        <div class="col-xs-7 col-md-10 nopadding">
                            <input id="cpf-cnpj" class="form-control input_cpf_cnpj" type="text" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}">
                        </div>
                    </div>    
                    <a class="btn btn-default" id="proxima-etapa">PROXIMA ETAPA</a>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao">
                    <div class="form-group col-xs-12 col-md-3 col-lg-2 nopadding">
                        <label for="estado">Estado:</label>
                        <select name="state_id" id="state">
                            <option value="">Todos</option>
                            @foreach($states as $state)
                            <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-4 col-lg-5 nopadding">
                        <label for="cidade">Cidade:</label>
                        <select name="city_id" id="city">
                            <option value="">Selecione um estado</option>                           
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 nopadding">
                        <label for="bairro">Bairro:</label>
                        <select name="neighborhood_id" id="neighborhood">
                            <option value="">Selecione uma cidade</option> 
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-prestador">
                    <span class="mais">+</span>
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <label for="regiões">Minhas regiões:</label>
                        <input type="text" data-role="tagsinput" class="label-teste" />
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-cotar">

                </div>
                <div class="col-xs-12 col-md-offset-4 col-md-8 div-form form-localizacao">
                    <button type="submit" class="btn btn-default" id="proxima-etapa">FINALIZAR</button>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection
