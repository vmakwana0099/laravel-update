<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectStatusTableSeeder extends Seeder
{
		public function run()
		{			
					DB::table('project_status')->insert([
						'varTitle' => 'Current',
						'intDisplayOrder' => 1,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('project_status')->insert([
						'varTitle' => 'Completed',
						'intDisplayOrder' => 2,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('project_status')->insert([
						'varTitle' => 'Future',
						'intDisplayOrder' => 3,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
		}
}
