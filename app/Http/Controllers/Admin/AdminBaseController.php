<?php

namespace App\Http\Controllers\Admin;
use App\Events\Admin\AdminOrderEvent;
use App\Http\Controllers\HelperTrait;
use App\Http\Controllers\Controller;
//use App\Models\Seo;
use App\Models\AdminNotice;
use App\Models\Answer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $breadcrumbs = [];
    protected array $menu;

    public function __construct()
    {
        $this->menu = [
            'home' => [
                'key' => 'home',
                'icon' => 'icon-home2',
                'hidden' => false,
            ],
            'users' => [
                'key' => 'users',
                'icon' => 'icon-users',
                'hidden' => false,
            ],
            'cities' => [
                'key' => 'cities',
                'icon' => 'icon-city',
                'hidden' => false,
            ],
            'dealers' => [
                'key' => 'dealers',
                'icon' => 'icon-star-full2',
                'hidden' => false,
            ],
        ];
        $this->breadcrumbs[] = $this->menu['home'];
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function home(): View
    {
        $this->data['menu_key'] = 'home';
        return $this->showView('home');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getSomething(
        Model $model,
        string|null $slug=null,
        array $width=[],
        Model|null $parentModel=null
    ): View
    {
        $key = $model->getTable();
        $this->data['menu_key'] = $key;
        $this->data['singular_key'] = $key == 'cities' ? 'city' : substr($key, 0, -1);
        $breadcrumbsParams = [];

        if (request('parent_id')) {
            $parentKey = $parentModel->getTable();

            $this->breadcrumbs[] = [
                'key' => $this->menu[$parentKey]['key'],
                'name' => trans('admin_menu.'.$parentKey),
            ];
            $this->data['menu_key'] = $parentKey;

            $parentKeyFields = $this->getSelectedFields($parentModel);
            $parent = $parentModel->query()->where('id',request('parent_id'))->select($parentKeyFields)->first();
            $breadcrumbsParams['parent_id'] = request('parent_id');
            $this->breadcrumbs[] = [
                'key' => $this->menu[$parentKey]['key'],
                'params' => ['id' => request('parent_id')],
                'name' => is_array($parentKeyFields) ? $this->getItemName($parent) : $parent[$parentKeyFields],
            ];

        } else if (!$this->menu[$key]['hidden']) {
            $this->data['menu_key'] = $key;
            $this->breadcrumbs[] = $this->menu[$key];
        }

        if (request('id')) {
            $this->data[$this->data['singular_key']] = $model->query()->where('id',request('id'))->with($width)->first();
            $breadcrumbsParams['id'] = $this->data[$this->data['singular_key']]->id;
            $this->breadcrumbs[] = [
                'key' => $this->menu[$key]['key'],
                'params' => $breadcrumbsParams,
                'name' => trans('admin.edit_'.$this->data['singular_key']).' id#'.$this->data[$this->data['singular_key']]->id,
            ];
            return $this->showView($this->data['singular_key']);
        } else if ($slug == 'add') {
            $breadcrumbsParams['slug'] = 'add';
            $this->breadcrumbs[] = [
                'key' => $this->menu[$key]['key'],
                'params' => $breadcrumbsParams,
                'name' => trans('admin.adding_'.$this->data['singular_key']),
            ];
            return $this->showView($this->data['singular_key']);
        } else {
            $this->data[$key] = $model->with($width)->orderBy('id')->get();
            return $this->showView($key);
        }
    }

    protected function showView($view): View
    {
        return view('admin.'.$view, array_merge(
            $this->data,
            [
                'breadcrumbs' => $this->breadcrumbs,
                'menu' => $this->menu,
            ]
        ));
    }

    private function getSelectedFields(Model $parentModel): string|array
    {
        if ($parentModel instanceof User) {
            $selectFields = 'email';
        } else {
            $selectFields = 'name';
        }
        return $selectFields;
    }

    protected function deleteSomething(Model $model, $checkRightsField=null): JsonResponse
    {
        $item = $model->query()->where('id',request()->id)->first();
        $item->delete();

        return response()->json(['success' => true]);
    }

    protected function getItemName(Model $model): string
    {
        $name = '';
        foreach (['name','email'] as $k => $field) {
            if (isset($model[$field])) {
                $name .= $name ? ' '.$model[$field] : $model[$field];
                if ($k) break;
            }
        }
        return $name;
    }
}
