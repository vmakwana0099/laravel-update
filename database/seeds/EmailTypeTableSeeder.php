<?php
use Illuminate\Database\Seeder;

class EmailTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emailTypeData = [
            // ['varEmailType' => 'Change Password',
            // 'chrPublish' => 'Y',
            // 'chrDelete' => 'N'],
            // ['varEmailType' => 'Reset Password',
            // 'chrPublish' => 'Y',
            // 'chrDelete' => 'N'],
            ['varEmailType' => 'Forgot Password',
                'chrPublish'    => 'Y',
                'chrDelete'     => 'N'],
            ['varEmailType' => 'Contact Us Lead',
                'chrPublish'    => 'Y',
                'chrDelete'     => 'N'],
            ['varEmailType' => 'General',
                'chrPublish'    => 'Y',
                'chrDelete'     => 'N'],
             ['varEmailType' => 'Appointment Lead',
                'chrPublish'    => 'Y',
                'chrDelete'     => 'N'],    
        ];
        DB::table('email_type')->insert($emailTypeData);
    }
}
