<?php

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function userCreatedat()
    {
        return new HtmlString("{$this->model->created_at->diffForHumans()}");
    }

    public function userPostCount()
    {
        return new HtmlString("{$this->model->posts()->count()}");
    }

    public function getLastFivePosts()
    {
        $categories = $this->model->lastFivePublished()
            ->pluck('title', 'slug')
            ->map(function ($value) {
                return $value;
            });

        return new HtmlString("{$categories}");
    }

    public function allRoles()
    {
        $roles = $this->model->roles->pluck(', ');

        return new HtmlString("{$roles}");
    }
}
