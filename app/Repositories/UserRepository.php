<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Section;
use App\Models\Promotion;
use App\Models\SchoolClass;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\UserContract;
use App\Contracts\Repositories\PromotionContract;

class UserRepository implements UserContract
{
    public function __construct(private PromotionContract $promotionService)
    {}

    /**
     *
     * @var int
     */
    private $role;

    /**
     *
     * @var mixed|array
     */
    private $permissions;

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        $data = $this->validate($request);

        $user = User::create($data);

        $this->assignRoleAndPermissions($user);

        toastr()->success("L'utilisateur a bien été créé", "Utilisateurs - Paramètres");
    }

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createTeacher(FormRequest $request)
    {
        $teacher = User::create($this->validateTeacherAndStudent($request));
        $teacher->assignRole($this->role);
        $teacher->givePermissionTo(
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

        toastr()->success("L'enseignant a bien été créé", "Enseignants - Ecole");
    }

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createStudent(FormRequest $request)
    {
        $student = User::create($this->validateTeacherAndStudent($request));
        $student->assignRole($this->role);
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

        toastr()->success("L'élève a bien été créé", "Elèves - Ecole");
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * Get all the models from database whith the admin role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAdmins()
    {
        return $this->getUsersWithRole('admin');
    }

    /**
     * Get all the models from database whith the teacher role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getTeachers()
    {
        return $this->getUsersWithRole('teacher');
    }

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents(int $sessionId)
    {
        $students = Promotion::where('session_id', $sessionId)
            ->pluck('student_id')
            ->toArray();

        return $this->getUserWithRoleQuery('student')
            ->whereIn('id', $students)
            ->get();
    }

    /**
     * Get all the students by session
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    // public function getStudentsBySession(int $sessionId)
    // {
    //     return $this->promotionService->getStudents($ids);
    // }

    /**
     * Get all the models with gender equals to M from database.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getMaleStudents(array $ids)
    {
        return $this->getUserWithRoleQuery('student')
            ->where('gender', 'M')
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudentsByClassAndSection(int $sessionId, int $classId, int $sectionId)
    {
        if($classId == 0 || $sectionId == 0) {
            $schoolClass = SchoolClass::where('session_id', $sessionId)->first();
            $section = Section::where('session_id', $sessionId)->first();

            if($schoolClass == null || $section == null){
                toastr()->warning("Il n'y a aucune classe ou section");
            } else {
                $classId = $schoolClass->id;
                $sectionId = $section->id;
            }

        }
        try {
            return $this->promotionService->getAll($sessionId, $classId, $sectionId);
        } catch (\Exception $e) {
            toastr()->error('Echec dans le processus de récupérations des élèves.');
        }
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user)
    {
        $data = $this->validate($request, $user);

        $status = $user->update($data);

        toastr()->success("L'utilisateur a bien été mise à jour", "Utilisateurs - Paramètres");

        $this->assignRoleAndPermissions($user);

        return $status;
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $teacher
     * @return bool
     */
    public function updateTeacher(FormRequest $request, User $teacher)
    {
        $data = $this->validateTeacherAndStudent($request, $teacher);

        $status = $teacher->update($data);

        toastr()->success("L'enseignant a bien été mise à jour", "Enseignants - Ecole");

        return $status;
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $student
     * @return bool
     */
    public function updateStudent(FormRequest $request, User $student)
    {
        $data = $this->validateTeacherAndStudent($request, $student);

        $status = $student->update($data);

        toastr()->success("L'élève a bien été mise à jour", "Elèves - Ecole");

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        Storage::disk('public')->delete($user->picture);

        $status = $user->delete();

        toastr()->success("L'utilisateur a bien été supprimé", "Utilisateurs - Paramètres");

        return $status;
    }

    /**
     * Validate form request
     *
     * @param FormRequest $request
     * @param User|null $user
     * @return mixed|array
     */
    private function validate(FormRequest $request, User $user = null)
    {
        $validated = $request->validated();

        $this->role = $validated['role'];
        $this->permissions = $validated['permissions'];

        $picture = $validated['picture'] ?? null;
        $path = $picture == null ? null : $picture->store('users', 'public');
        $password = $validated['password'] ?? null;

        if (!is_null($user)) {
            if (!is_null($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
        }

        return [
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => $password != null ? bcrypt($password) : $user->password,
            'gender' => $validated['gender'],
            'blood_type' => $validated['blood_type'],
            'nationality' => $validated['nationality'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'address2' => $validated['address2'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'birthday' => $validated['birthday'],
            'religion' => $validated['religion'],
            'picture' => $path,
        ];
    }

    /**
     * Validate form request
     *
     * @param FormRequest $request
     * @param User|null $user
     * @return mixed|array
     */
    private function validateTeacherAndStudent(FormRequest $request, User $user = null)
    {
        $validated = $request->validated();

        $this->role = $validated['role'];

        $picture = $validated['picture'] ?? null;
        $path = $picture == null ? null : $picture->store('users', 'public');
        $password = $validated['password'] ?? null;

        if (!is_null($user)) {
            if (!is_null($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
        }

        return [
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => $password != null ? bcrypt($password) : $user->password,
            'gender' => $validated['gender'],
            'blood_type' => $validated['blood_type'],
            'nationality' => $validated['nationality'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'address2' => $validated['address2'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'birthday' => $validated['birthday'],
            'religion' => $validated['religion'],
            'picture' => $path,
        ];
    }

    /**
     * Assign role and permissions to user.
     *
     * @param User $user
     * @return void
     */
    private function assignRoleAndPermissions(User $user)
    {
        $role = Role::findById($this->role);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user->assignRole($role);
        toastr()->success("Le rôle {$role->name} a bien été attribué à l'utilisateur", "Utilisateurs - Paramètres");
        $user->givePermissionTo($this->permissions);
        $total = count($this->permissions);
        toastr()->success("{$total} ont bien été attribuées à l'utilisateur", "Utilisateurs - Paramètres");
    }

    /**
     * Get all the models from database whith the specified role.
     *
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    private function getUsersWithRole(string $role)
    {
        return $this->getUserWithRoleQuery($role)->get();
    }

    /**
     * Return a query builder
     *
     * @param string $role
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function getUserWithRoleQuery(string $role)
    {
        return User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }
}
