<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Http\Requests\Admin\AdminDeleteUserRequest;
use App\Http\Requests\Admin\AdminEditUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

//use Illuminate\Validation\Rules\Password;

class AdminUsersController extends AdminBaseController
{
    use HelperTrait;

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function users(User $users, $slug = null): View
    {
        return $this->getSomething($users, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editUser(AdminEditUserRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if ($request->has('id')) {
            $user = User::query()->where('id', $request->input('id'))->first();
            if ($request->input('password')) $fields['password'] = bcrypt($fields['password']);
            $user->update($fields);
        } else {
            $fields['password'] = bcrypt($fields['password']);
            User::query()->create($fields);
        }
        $this->saveCompleteMessage();
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteUser(AdminDeleteUserRequest $request): JsonResponse
    {
        return $this->deleteSomething(new User());
    }
}