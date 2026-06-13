<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Http\Requests\Admin\AdminDeleteCityRequest;
use App\Http\Requests\Admin\AdminEditCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCityController extends AdminBaseController
{
    use HelperTrait;

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function cities(City $cities, $slug = null): View
    {
        return $this->getSomething($cities, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editCity(AdminEditCityRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if ($request->has('id')) {
            $user = City::query()->where('id', $request->input('id'))->first();
            $user->update($fields);
        } else {
            City::query()->create($fields);
        }
        $this->saveCompleteMessage();
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteCity(AdminDeleteCityRequest $request): JsonResponse
    {
        return $this->deleteSomething(new City());
    }
}