<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Method to get all menu
     *
     * @return void
     */
    public function allMenu()
    {
        $menu = Menu::all();

        return ApiResponse::success($menu);
    }

    /**
     * Method to store menu
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'category' => 'required|in:food,drink'
        ]);

        $menu = Menu::create($request->all());

        if (!$menu) {
            return ApiResponse::error();
        }

        return ApiResponse::success($menu, 'Menu created successfully!', 201);
    }

    /**
     * Method to get detail of menu based on id
     *
     * @param string $id
     * @return JsonResponse
     */
    public function getDetailMenu($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return ApiResponse::error('Menu Not Found!', 404);
        }

        return ApiResponse::success($menu);
    }

    /**
     * Method to update record of menu
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        $menu = Menu::find($id);

        if (!$menu)
        {
            return ApiResponse::error('Menu Not Found!', 404);
        }

        $menu->update($request->all());

        return ApiResponse::success($menu, 'Menu updated successfully!');
    }

    public function delete($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return ApiResponse::error('Menu Not Found!', 404);
        }

        $menu->delete();

        return ApiResponse::success([], 'Menu Deleted Successfully!');
    }
}
