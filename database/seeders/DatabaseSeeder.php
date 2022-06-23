<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\SchoolClass;
use App\Models\SchoolSession;
use App\Models\Section;
use App\Models\Semester;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $session = SchoolSession::create(['name' => '2021-2022']);
        $sessionId = $session->id;

        $semester1 = Semester::create([
            'session_id' => $sessionId,
            'name' => 'Semestre 1',
            'start_at' => now()->subMonths(8),
            'end_at' => now()->subMonths(6),
        ]);
        $semester2 = Semester::create([
            'session_id' => $sessionId,
            'name' => 'Semestre 2',
            'start_at' => now()->subMonths(2),
            'end_at' => now()->addMonths(4),
        ]);

        $class1 = SchoolClass::create([
            'session_id' => $sessionId,
            'name' => '6ième'
        ]);
        $section1 = Section::create([
            'session_id' => $sessionId,
            'class_id' => $class1->id,
            'name' => 'A',
            'room_no' => '1'
        ]);

        $class2 = SchoolClass::create([
            'session_id' => $sessionId,
            'name' => '5ième'
        ]);
        $section2 = Section::create([
            'session_id' => $sessionId,
            'class_id' => $class2->id,
            'name' => 'A',
            'room_no' => '2'
        ]);
        $section3 = Section::create([
            'session_id' => $sessionId,
            'class_id' => $class2->id,
            'name' => 'B',
            'room_no' => '3'
        ]);

        $class3 = SchoolClass::create([
            'session_id' => $sessionId,
            'name' => '4ième'
        ]);
        $section4 = Section::create([
            'session_id' => $sessionId,
            'class_id' => $class3->id,
            'name' => 'A',
            'room_no' => '4'
        ]);

        $class4 = SchoolClass::create([
            'session_id' => $sessionId,
            'name' => '3ième'
        ]);
        $section5 = Section::create([
            'session_id' => $sessionId,
            'class_id' => $class4->id,
            'name' => 'A',
            'room_no' => '5'
        ]);
        
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'promote students']);

        Permission::create(['name' => 'create notices']);
        Permission::create(['name' => 'view notices']);
        Permission::create(['name' => 'edit notices']);
        Permission::create(['name' => 'delete notices']);

        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'edit events']);
        Permission::create(['name' => 'delete events']);

        Permission::create(['name' => 'create syllabi']);
        Permission::create(['name' => 'view syllabi']);
        Permission::create(['name' => 'edit syllabi']);
        Permission::create(['name' => 'delete syllabi']);

        Permission::create(['name' => 'create routines']);
        Permission::create(['name' => 'view routines']);
        Permission::create(['name' => 'edit routines']);
        Permission::create(['name' => 'delete routines']);

        Permission::create(['name' => 'create exams']);
        Permission::create(['name' => 'view exams']);
        Permission::create(['name' => 'delete exams']);
        Permission::create(['name' => 'create exams rule']);
        Permission::create(['name' => 'view exams rule']);
        Permission::create(['name' => 'edit exams rule']);
        Permission::create(['name' => 'delete exams rule']);
        Permission::create(['name' => 'view exams history']);

        Permission::create(['name' => 'create grading systems']);
        Permission::create(['name' => 'view grading systems']);
        Permission::create(['name' => 'edit grading systems']);
        Permission::create(['name' => 'delete grading systems']);
        Permission::create(['name' => 'create grading systems rule']);
        Permission::create(['name' => 'view grading systems rule']);
        Permission::create(['name' => 'edit grading systems rule']);
        Permission::create(['name' => 'delete grading systems rule']);

        Permission::create(['name' => 'take attendances']);
        Permission::create(['name' => 'view attendances']);
        Permission::create(['name' => 'update attendances type']);

        Permission::create(['name' => 'submit assignments']);
        Permission::create(['name' => 'create assignments']);
        Permission::create(['name' => 'view assignments']);

        Permission::create(['name' => 'save marks']);
        Permission::create(['name' => 'view marks']);

        Permission::create(['name' => 'create school sessions']);

        Permission::create(['name' => 'create semesters']);
        Permission::create(['name' => 'view semesters']);
        Permission::create(['name' => 'edit semesters']);
        Permission::create(['name' => 'assign teachers']);
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'view courses']);
        Permission::create(['name' => 'edit courses']);

        Permission::create(['name' => 'view academic settings']);
        Permission::create(['name' => 'update marks submission window']);
        Permission::create(['name' => 'update browse by session']);

        Permission::create(['name' => 'create classes']);
        Permission::create(['name' => 'view classes']);
        Permission::create(['name' => 'edit classes']);
        // Permission::create(['name' => 'delete classes']);
        
        Permission::create(['name' => 'create sections']);
        Permission::create(['name' => 'view sections']);
        Permission::create(['name' => 'edit sections']);
        Permission::create(['name' => 'delete sections']);
        
        $admin = User::create([
            'first_name' => 'Monkey D.',
            'last_name' => 'Luffy',
            'email' => 'monkey.d.luffy@sms.test',
            'gender' => 'M',
            'password' => bcrypt('password'),
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $admin->assignRole($adminRole);
        $admin->givePermissionTo(
            'create school sessions',
            'update browse by session',
            'create semesters',
            'edit semesters',
            'assign teachers',
            'create courses',
            'view courses',
            'edit courses',
            'create classes',
            'view classes',
            'edit classes',
            'create sections',
            'view sections',
            'edit sections',
            'create exams',
            'view exams',
            'create exams rule',
            'edit exams rule',
            'delete exams rule',
            'view exams rule',
            'create routines',
            'view routines',
            'edit routines',
            'delete routines',
            'view marks',
            'view academic settings',
            'update marks submission window',
            'create users',
            'edit users',
            'view users',
            'promote students',
            'update attendances type',
            'view attendances',
            'take attendances', // Teacher only
            'create grading systems',
            'view grading systems',
            'edit grading systems',
            'delete grading systems',
            'create grading systems rule',
            'view grading systems rule',
            'edit grading systems rule',
            'delete grading systems rule',
            'create notices',
            'view notices',
            'edit notices',
            'delete notices',
            'create events',
            'view events',
            'edit events',
            'delete events',
            'create syllabi',
            'view syllabi',
            'edit syllabi',
            'delete syllabi',
            'view assignments'
        );

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
        $teacher1->givePermissionTo(
            'create exams',
            'view exams',
            'create exams rule',
            'view exams rule',
            'edit exams rule',
            'delete exams rule',
            'take attendances',
            'view attendances',
            'create assignments',
            'view assignments',
            'save marks',
            'view users',
            'view routines',
            'view syllabi',
            'view events',
            'view notices',
        );
        $teacher2->givePermissionTo(
            'create exams',
            'view exams',
            'create exams rule',
            'view exams rule',
            'edit exams rule',
            'delete exams rule',
            'take attendances',
            'view attendances',
            'create assignments',
            'view assignments',
            'save marks',
            'view users',
            'view routines',
            'view syllabi',
            'view events',
            'view notices',
        );

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

        $students = [];

        for ($i=0; $i < 4; $i++) { 
            switch ($i) {
                case 0:
                    $students[] = $student1;
                    break;

                case 1:
                    $students[] = $student2;
                    break;

                case 2:
                    $students[] = $student3;
                    break;

                case 3:
                    $students[] = $student4;
                    break;
            }
        }

        foreach ($students as $student) {
            $student->assignRole($studentRole);
            $student->givePermissionTo(
                'view attendances',
                'view assignments',
                'submit assignments',
                'view exams',
                'view marks',
                'view users',
                'view routines',
                'view syllabi',
                'view events',
                'view notices',
            );
        }
        
        $year = now()->year;

        foreach ($students as $key => $student) {
            switch ($key) {
                case 0:
                    Promotion::create([
                        'session_id' => $sessionId,
                        'class_id' => $class1->id,
                        'section_id' => $section1->id,
                        'student_id' => $student1->id,
                        'id_card_number' => uniqid("$year")
                    ]);
                    break;

                case 1:
                    Promotion::create([
                        'session_id' => $sessionId,
                        'class_id' => $class2->id,
                        'section_id' => $section2->id,
                        'student_id' => $student2->id,
                        'id_card_number' => uniqid("$year")
                    ]);
                    break;

                case 2:
                    Promotion::create([
                        'session_id' => $sessionId,
                        'class_id' => $class3->id,
                        'section_id' => $section3->id,
                        'student_id' => $student3->id,
                        'id_card_number' => uniqid("$year")
                    ]);
                    break;

                case 3:
                    Promotion::create([
                        'session_id' => $sessionId,
                        'class_id' => $class4->id,
                        'section_id' => $section4->id,
                        'student_id' => $student4->id,
                        'id_card_number' => uniqid("$year")
                    ]);
                    break;
            }
        }
    }
}
