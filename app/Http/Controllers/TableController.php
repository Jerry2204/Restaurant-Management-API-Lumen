<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Method to get all table
     *
     * @return void
     */
    public function allTable()
    {
        $table = Table::all();

        return ApiResponse::success($table);
    }

    /**
     * Method to store table
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'table_number' => 'required'
        ]);

        $table = Table::create($request->all());

        if (!$table) {
            return ApiResponse::error();
        }

        return ApiResponse::success($table, 'Table created successfully!', 201);
    }

    /**
     * Method to get detail of table based on id
     *
     * @param string $id
     * @return JsonResponse
     */
    public function getDetailTable($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return ApiResponse::error('Table Not Found!', 404);
        }

        return ApiResponse::success($table);
    }

    /**
     * Method to update record of table
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'table_number' => 'required'
        ]);

        $table = Table::find($id);

        if (!$table)
        {
            return ApiResponse::error('Table Not Found!', 404);
        }

        $table->update($request->all());

        return ApiResponse::success($table, 'Table updated successfully!');
    }

    public function delete($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return ApiResponse::error('Table Not Found!', 404);
        }

        $table->delete();

        return ApiResponse::success([], 'Table Deleted Successfully!');
    }
}
