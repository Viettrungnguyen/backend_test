<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    public function create(array $data)
    {
        return Account::create($data);
    }

    public function update(Account $account, array $data)
    {
        $account->update($data);
        return $account;
    }

    public function delete(Account $account)
    {
        $account->delete();
    }

    public function getById($id)
    {
        return Account::find($id);
    }

    public function getAllPaginated()
    {
        return Account::paginate();
    }
}
