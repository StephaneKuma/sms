<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'Monkey D.',
            'last_name' => 'Luffy',
            'email' => 'monkey.d.luffy@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $admin->assignRole($adminRole);

        $teacher1 = User::create([
            'first_name' => 'Charlotte.',
            'last_name' => 'Linlin',
            'email' => 'charlotte.linlin@sms.test',
            'gender' => 'F',
            'password' => bcrypt('password'),
        ]);
        $teacher2 = User::create([
            'first_name' => 'Gingg.',
            'last_name' => 'Freeks',
            'email' => 'gingg.freeks@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $teacherRole = Role::create(['name' => 'teacher']);
        $teacher1->assignRole($teacherRole);
        $teacher2->assignRole($teacherRole);

        $student1 = User::create([
            'first_name' => 'Trafalgar D.',
            'last_name' => 'Law',
            'email' => 'trafalgar.d.law@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $student2 = User::create([
            'first_name' => 'Boa',
            'last_name' => 'Hankok',
            'email' => 'boa.hankok@sms.test',
            'gender' => 'F',
            'password' => bcrypt('password'),
        ]);
        $student3 = User::create([
            'first_name' => 'Gon',
            'last_name' => 'Freeks',
            'email' => 'gon.freeks@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $student4 = User::create([
            'first_name' => 'Kirua',
            'last_name' => 'Zoldik',
            'email' => 'kirua.zoldik@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $studentRole = Role::create(['name' => 'student']);
        $student1->assignRole($studentRole);
        $student2->assignRole($studentRole);
        $student3->assignRole($studentRole);
        $student4->assignRole($studentRole);
    }
}
