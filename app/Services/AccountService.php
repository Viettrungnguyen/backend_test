<?php

namespace App\Services;

use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AccountService
{
    protected $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function createAccount(array $data)
    {
        $validatedData = $this->validateAccountData($data);

        try {
            $account = $this->accountRepository->create($validatedData);
            Log::info('New account created: ' . $account->registerID);
            return $account;
        } catch (\Exception $e) {
            Log::error('Error creating account: ' . $e->getMessage());
            throw new \Exception('Could not create account');
        }
    }

    public function updateAccount(int $accountId, array $data)
    {
        $account = $this->accountRepository->getById($accountId);
        if (!$account) {
            throw new \Exception('Account not found');
        }

        $validatedData = $this->validateAccountData($data);

        try {
            $account = $this->accountRepository->update($account, $validatedData);
            Log::info('Account updated: ' . $accountId);
            return $account;
        } catch (\Exception $e) {
            Log::error('Error updating account: ' . $e->getMessage());
            throw new \Exception('Could not update account');
        }
    }

    public function deleteAccount(int $accountId)
    {
        $account = $this->accountRepository->getById($accountId);
        if (!$account) {
            throw new \Exception('Account not found');
        }

        try {
            $this->accountRepository->delete($account);
            Log::info('Account deleted: ' . $accountId);
        } catch (\Exception $e) {
            Log::error('Error deleting account: ' . $e->getMessage());
            throw new \Exception('Could not delete account');
        }
    }

    public function getAccount(int $accountId)
    {
        $account = $this->accountRepository->getById($accountId);
        if (!$account) {
            throw new \Exception('Account not found');
        }
        return $account;
    }

    public function getAllAccountsPaginated()
    {
        return $this->accountRepository->getAllPaginated();
    }

    protected function validateAccountData(array $data)
    {
        $validator = validator($data, [
            'login' => 'required|string|max:20',
            'password' => 'required|string|max:40',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $data;
    }
}
