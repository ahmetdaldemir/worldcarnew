<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Repositories\Accounting\AccountingRepositoryInterface;
use App\Repositories\AccountingCategory\AccountingCategoryRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    private $accounting;
    private $accountingcategory;

    public function __construct(AccountingRepositoryInterface $accounting, AccountingCategoryRepositoryInterface $accountingcategory)
    {
        $this->accounting = $accounting;
        $this->accountingcategory = $accountingcategory;
    }

    public function index()
    {
        $data['accounting'] = $this->accounting->all();
        $data['accountingCategory'] = $this->accountingcategory->all();
        return view('admin.accounting.index', $data);
    }

    public function edit(Request $request)
    {
        $data['accounting'] = $this->accounting->find($request->id);
        $data['categorys'] = $this->accountingcategory->all();
        return view('admin.accounting.edit', $data);
    }

    public function create()
    {
        $data['categorys'] = $this->accountingcategory->all();
        $data['currencies'] = Currency::all();
        $data['personals'] = User::all();
        return view('admin.accounting.create', $data);
    }

    public function save(Request $request)
    {
        $this->accounting->create($request);
        return redirect()->to('admin/admin/accounting');
    }

    public function update(Request $request)
    {
        $this->accounting->update($request->id, $request);
        return redirect()->to('admin/admin/accounting');
    }

    public function delete(Request $request)
    {
        $this->accounting->delete($request->id);
        return redirect()->to('admin/admin/accounting');
    }
}
