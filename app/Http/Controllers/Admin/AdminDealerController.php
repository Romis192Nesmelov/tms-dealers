<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Http\Requests\Admin\AdminDeleteDealerRequest;
use App\Http\Requests\Admin\AdminEditDealerRequest;
use App\Models\City;
use App\Models\Dealer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminDealerController extends AdminBaseController
{
    use HelperTrait;

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function dealers(Dealer $dealers, $slug = null): View
    {
        $this->data['cities'] = City::all();
        return $this->getSomething($dealers, $slug, ['city']);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editDealer(AdminEditDealerRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        if ($request->has('id')) {
            $dealer = Dealer::query()->where('id', $request->input('id'))->first();
            $dealer->update($fields);
        } else {
            Dealer::query()->create($fields);
        }
        $this->saveCompleteMessage();
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteDealer(AdminDeleteDealerRequest $request): JsonResponse
    {
        return $this->deleteSomething(new Dealer());
    }
}