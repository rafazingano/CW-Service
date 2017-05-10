@extends('layouts.default')

@section('content')
<main>
    <section class="home">
        <div class="container">
            <div class="col-md-offset-7 col-md-5 info" id="home-info">
                <h1>Solicite serviços. Busque oportunidades.</h1>
                <p>Resolva situações do dia-a-dia contando com profissionais e empresas, em qualquer lugar e a qualquer momento.</p>
                <p>Encontre futuros clientes com rapidez e feche bons negócios.</p>
                <a href="{{ route('cadastro') }}" class="btn btn-default">CADASTRE-SE</a>
            </div>


        </div>
    </section>
</main>
@endsection
