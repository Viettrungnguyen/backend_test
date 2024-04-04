<?php

// app/Http/Controllers/AccountController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\DeleteAccountRequest;
use App\Services\AccountService;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function show($id)
    {
        try {
            $account = $this->accountService->getAccount($id);
            return response()->json($account, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function index()
    {
        try {
            $accounts = $this->accountService->getAllAccountsPaginated();
            return response()->json($accounts, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(CreateAccountRequest $request)
    {
        try {
            $account = $this->accountService->createAccount($request->validated());
            return response()->json($account, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        try {
            $account = $this->accountService->updateAccount($id, $request->validated());
            return response()->json($account, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(DeleteAccountRequest $request)
    {
        try {
            $this->accountService->deleteAccount($request->validated()['id']);
            return response()->json(['message' => 'Account deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
