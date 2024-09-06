<?php

namespace App\Services;

use App\Contracts\TournamentContract;
use App\Exceptions\CustomException;
use App\Models\Tournament;

class TournamentService implements TournamentContract
{
    public $model;
    // public $countryModel;
    // public $stateModel;
    // public $cityModel;

    public function __construct()
    {
        $this->model = new Tournament();
    }

    public function index()
    {
        // $user_id = auth()->user()->id;
        $address = $this->model->where("user_id", $user_id)->get();
        if (empty($address)) {
            throw new CustomException("Not Found!");
        }
        return $address;
    }
    public function show($id)
    {
        $address = $this->model->find($id)->get();
        if (empty($address)) {
            throw new CustomException("Not Found!");
        }
        return $address;
    }
    public function edit($id)
    {
        $address = $this->model->find($id)->get();
        if (empty($address)) {
            throw new CustomException("Not Found!");
        }
        return $address;
    }
    public function store($data)
    {
        // $user_id = auth()->user()->id;
        $address = $this->model->where('title_en', $data['title_en'])->where('user_id', $user_id)->count();
        //dd($category);
        if ($address > 0) {
            throw new CustomException("Address is already exist!");
        }
        $model = new $this->model;
        $address = $this->prepareData($model, $data, true);
        return $address;
    }
    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Address Not Found!");
        }
        $address = $this->prepareData($model, $data, false);
        return $address;
    }

    public function delete($id)
    {
        $address = $this->model->find($id);
        if (empty($address)) {
            throw new CustomException("Address Not Found!");
        }
        $address->delete();
        return true;
    }

    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['user_id']) && $data['user_id']) {
            $model->user_id = $data['user_id'];
        }
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['start_date']) && $data['start_date']) {
            $model->start_date = $data['start_date'];
        }
        if (isset($data['end_date']) && $data['end_date']) {
            $model->end_date = $data['end_date'];
        }
        if (isset($data['description']) && $data['description']) {
            $model->description = $data['description'];
        }
        $model->save();
        return $model;
    }
}
