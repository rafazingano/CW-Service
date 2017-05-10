@extends('layouts.default')

@section('content')
<main>
    <section class="cadastro">
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="container formulario">
                <div class="col-xs-12">
                    <h1 class="cadastrese">Cadastre-se</h1>
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
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="email">E-mail:</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input id="telefone" class="form-control" type="text" name="phone" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-xs-12 col-md-6">
                        <label for="senha">Senha:</label>
                        <input id="senha" class="form-control" type="password" name="password" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="conf-senha">Confirmar senha:</label>
                        <input id="conf-senha" class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group col-xs-12 margintop">
                        <label for="cpf-cnpj"> Informe o seu CPF ou CNPJ da sua empresa:</label>
                        <div class="col-xs-5 col-md-2 nopadding">
                            <select id="cpf-cnpj" name="select_cpf_cnpj" required>
                                <option value="cpf" selected>CPF</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                        </div>
                        <div class="col-xs-7 col-md-10 nopadding">
                            <input id="cpf-cnpj" class="form-control" type="text" name="cpf_cnpj">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 margintop check">
                        <label for="prestador">Gostaria de fazer o cadastro como prestador de serviços?</label>
                        <div id="radioset">
                            <input type="radio" id="radio1" name="service_provider" checked="checked" value="y"><label for="radio1">Sim. Quero prestar serviços.</label>
                            <input type="radio" id="radio2" name="service_provider" value="n"><label for="radio2" >Não. Só quero cotar.</label>
                        </div>
                    </div>    
                    <a class="btn btn-default" id="proxima-etapa">PROXIMA ETAPA</a>

                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-prestador">
                    <div class="form-group col-xs-12 col-md-3 col-lg-2 nopadding">
                        <label for="estado">Estado:</label>
                        <select name="state" id="estado">
                            <option value="todos">Todos</option>
                            @foreach($states as $state)
                                <option value="{{ $state['id'] }}">{{ $state['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-4 col-lg-5 nopadding">
                        <label for="cidade">Cidade:</label>
                        <select name="city" id="cidade">
                            <option value="todos">Selecione um estado</option>                           
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 nopadding">
                        <label for="bairro">Bairro:</label>
                        <select name="neighborhood" id="bairro">
                            <option value="todos">Selecione uma cidade</option> 
                        </select>
                    </div>
                    <span class="mais">+</span>
                    <div class="form-group col-xs-12 col-md-12 nopadding">
                        <label for="regiões">Minhas regiões:</label>
                        <input type="text" data-role="tagsinput" class="label-teste" name='locations'/>
                    </div>
                    <button type="submit" class="btn btn-default" id="proxima-etapa">FINALIZAR</button>

                </div>
                <div class="col-xs-12 col-md-8 div-form form-localizacao-cotar">

                    <div class="form-group col-xs-12 col-md-2 nopadding">
                        <label for="estado">Estado:</label>
                        <select name="location[state_id]" id="estado">
                            <option value="todos">Todos</option>
                            <option value="RS">RS</option>
                            <option value="SP">sp</option>
                            <option value="RJ">Rj</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 nopadding">
                        <label for="cidade">Cidade:</label>
                        <select name="location[city_id]" id="cidade">
                            <option value="Todos">Todas</option>
                            <option value="Porto Alegre">Porto Alegre</option>
                            <option value="Guaíba">Guaíba</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-5 nopadding">
                        <label for="bairro">Bairro:</label>
                        <select name="location[neighborhood_id]" id="bairro">
                            <option value="Todos">Todos</option>
                            <option value="Centro">Centro</option>
                            <option value="Auxiliadora">Auxiliadora</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-md-12 nopadding">

                    </div>
                    <button type="submit" class="btn btn-default" id="proxima-etapa">FINALIZAR</button>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection
