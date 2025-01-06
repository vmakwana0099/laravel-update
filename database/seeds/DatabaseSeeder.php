<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
		{
				
				$this->call(UsersTableSeeder::class);
				$this->call(RolesTableSeeder::class);				
				$this->call(RoleUserTableSeeder::class);				
				$this->call(ModuleTableSeeder::class);				
				$this->call(ImageTableSeeder::class);
				$this->call(CmsPageTableSeeder::class);	
				$this->call(MenuTypeSeeder::class);
				$this->call(MenuTableSeeder::class);
				$this->call(AliasTableSeeder::class);
				$this->call(BannerTableSeeder::class);
				$this->call(EmailTypeTableSeeder::class);
				$this->call(GeneralSettingsTableSeeder::class);
				$this->call(ContactinfoTableSeeder::class);
				$this->call(PermissionTableSeeder::class);
				$this->call(PermissionRoleTableSeeder::class);
				$this->call(ZoneTableSeeder::class);
				//$this->call(ModuleEntryTableSeeder::class);
				$this->call(PopupcontentTableSeeder::class);			
				//$this->call(TestimonialTableSeeder::class);
				if(class_exists('\\App\\ProjectStatus')){
					$this->call(ProjectStatusTableSeeder::class);
				}
							
		}
}
