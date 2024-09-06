<?php

namespace App\Contracts;

interface TournamentContract
{
    public function index();
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function delete($id);
    public function edit($id);
}
