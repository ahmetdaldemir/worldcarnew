<?php namespace App\Http\Controllers\Admin;


use App\Models\Transfer;
use App\Repositories\Transfer\TransferRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TransferController extends Controller
{
    private $transfer;

    public function __construct(TransferRepositoryInterface $transfer)
    {
        $this->transfer = $transfer;
    }

    public function index()
    {
        $data['transfer'] = $this->transfer->all();
        return view('admin.transfer.index',$data);
    }

    public function edit(Request $request)
    {
        $data['transfer'] = $this->transfer->find($request->id);
        return view('admin.transfer.edit',$data);
    }


    public function create()
    {
        return view('admin.transfer.create');
    }

    public function save(Request $request)
    {
        $this->transfer->create($request);
        return redirect('admin/admin/transfer');
    }

    public function update(Request $request)
    {
        $this->transfer->update($request->id,$request);
        return redirect('admin/admin/transfer');
    }

    public function statuschange(Request $request)
    {
        $this->transfer->statuschange($request->id,$request);
        return redirect('admin/admin/transfer');
    }

    public function delete(Request $request)
    {
        $this->transfer->delete($request->id);
        return redirect('admin/admin/transfer');
    }

}
