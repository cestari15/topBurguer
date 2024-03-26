<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lanches = [
            [
                'nome' => 'burger 1',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 2',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 3',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 4',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 5',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 6',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 7',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 8',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 9',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 10',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 11',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
            [
                'nome' => 'burger 12',
                'preco' => 17.99,
                'ingredientes' => 'Hambúrguer de carne, bacon, queijo, sara, bacon de renan',
                'imagen'=> 'images/hamburgao.jpeg'
            ],
        ];

        foreach($lanches as $lanche){
            DB::table('produtos')->insert([
                'nome' => $lanche['nome'],
                'preco' => $lanche['preco'],
                'ingredientes'=> $lanche['ingredientes'],
                'imagen' => $lanche ['imagen'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
