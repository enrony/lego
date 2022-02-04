<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Model::unguard();
		$categories = 
            [
                ['name' => 'Cliente'],
                ['name' => 'Proveedor'],
                ['name' => 'Funcionario interno']                
            ];
		$db = DB::table('categories')->insert($categories);

    }
}
