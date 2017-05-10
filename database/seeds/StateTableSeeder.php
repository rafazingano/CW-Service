<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $states = [
            ['id' => 1, 'abbr' => 'AC', 'title' => 'Acre', 'slug' => 'acre'],
            ['id' => 2, 'abbr' => 'AL', 'title' => 'Alagoas', 'slug' => 'alagoas'],
            ['id' => 3, 'abbr' => 'AM', 'title' => 'Amazonas', 'slug' => 'amazonas'],
            ['id' => 4, 'abbr' => 'AP', 'title' => 'Amapá', 'slug' => 'amapa'],
            ['id' => 5, 'abbr' => 'BA', 'title' => 'Bahia', 'slug' => 'bahia'],
            ['id' => 6, 'abbr' => 'CE', 'title' => 'Ceará', 'slug' => 'ceara'],
            ['id' => 7, 'abbr' => 'DF', 'title' => 'Distrito Federal', 'slug' => 'distrito-federal'],
            ['id' => 8, 'abbr' => 'ES', 'title' => 'Espírito Santo', 'slug' => 'espirito-santo'],
            ['id' => 9, 'abbr' => 'GO', 'title' => 'Goiás', 'slug' => 'goias'],
            ['id' => 10, 'abbr' => 'MA', 'title' => 'Maranhão', 'slug' => 'maranhao'],
            ['id' => 11, 'abbr' => 'MG', 'title' => 'Minas Gerais', 'slug' => 'minas-gerais'],
            ['id' => 12, 'abbr' => 'MS', 'title' => 'Mato Grosso do Sul', 'slug' => 'mato-grosso-do-sul'],
            ['id' => 13, 'abbr' => 'MT', 'title' => 'Mato Grosso', 'slug' => 'mato-grosso'],
            ['id' => 14, 'abbr' => 'PA', 'title' => 'Pará', 'slug' => 'para'],
            ['id' => 15, 'abbr' => 'PB', 'title' => 'Paraíba', 'slug' => 'paraiba'],
            ['id' => 16, 'abbr' => 'PE', 'title' => 'Pernambuco', 'slug' => 'pernambuco'],
            ['id' => 17, 'abbr' => 'PI', 'title' => 'Piauí', 'slug' => 'piaui'],
            ['id' => 18, 'abbr' => 'PR', 'title' => 'Paraná', 'slug' => 'parana'],
            ['id' => 19, 'abbr' => 'RJ', 'title' => 'Rio de Janeiro', 'slug' => 'rio-de-janeiro'],
            ['id' => 20, 'abbr' => 'RN', 'title' => 'Rio Grande do Norte', 'slug' => 'rio-grande-do-norte'],
            ['id' => 21, 'abbr' => 'RO', 'title' => 'Rondônia', 'slug' => 'rondonia'],
            ['id' => 22, 'abbr' => 'RR', 'title' => 'Roraima', 'slug' => 'roraima'],
            ['id' => 23, 'abbr' => 'RS', 'title' => 'Rio Grande do Sul', 'slug' => 'rio-grande-do-sul'],
            ['id' => 24, 'abbr' => 'SC', 'title' => 'Santa Catarina', 'slug' => 'santa-catarina'],
            ['id' => 25, 'abbr' => 'SE', 'title' => 'Sergipe', 'slug' => 'sergipe'],
            ['id' => 26, 'abbr' => 'SP', 'title' => 'São Paulo', 'slug' => 'sao-paulo'],
            ['id' => 27, 'abbr' => 'TO', 'title' => 'Tocantins', 'slug' => 'tocantins']
        ];

        foreach ($states as $state) {
            $this->command->info('Inserindo estado de ' . $state['title'] . '.');
            App\State::create($state);
        }
    }
}
