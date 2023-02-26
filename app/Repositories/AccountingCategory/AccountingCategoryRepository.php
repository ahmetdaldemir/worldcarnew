<?php


namespace App\Repositories\AccountingCategory;

use App\Models\AccountingCategory;


class AccountingCategoryRepository implements AccountingCategoryRepositoryInterface
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return AccountingCategory::find($id);
    }

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all()
    {
        return AccountingCategory::all();
    }

    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id)
    {
        AccountingCategory::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, object $data)
    {
        $accountingCategory = AccountingCategory::find($id);
        $accountingCategory->title = $data->title;
        $accountingCategory->save();
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function create(object $data)
    {
        $accountingCategory = new AccountingCategory();
        $accountingCategory->title = $data->title;
        $accountingCategory->save();
    }
}
