<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AccountingCategory\AccountingCategoryRepositoryInterface;
use Illuminate\Http\Request;

class AccountingCategoryController extends Controller
{
    private $accountingCategory;

    public function __construct(AccountingCategoryRepositoryInterface $accountingCategory)
    {
        $this->accountingCategory = $accountingCategory;
    }

    public function index()
    {
        $data['accountingCategory'] = $this->accountingCategory->all();
        return view('admin.accounting.category.index',$data);
    }

    public function edit(Request $request)
    {
        $data['accountingCategory'] = $this->accountingCategory->get($request->id);
        return view('admin.accounting.category.edit',$data);
    }


    public function create()
    {
        return view('admin.accounting.category.create');
    }

    public function save(Request $request)
    {
        $this->accountingCategory->create($request);
        return redirect()->to('admin/admin/accountingcategory');
    }

    public function update(Request $request)
    {
        $this->accountingCategory->update($request->id,$request);
        return redirect()->to('admin/admin/accountingcategory');
    }

    public function statuschange(Request $request)
    {
        $this->accountingCategory->update($request->id,$request);
        return redirect()->to('admin/admin/accountingcategory');
    }

    public function delete(Request $request)
    {
        $this->accountingCategory->delete($request->id);
        return redirect()->to('admin/admin/accountingcategory');
    }
}
