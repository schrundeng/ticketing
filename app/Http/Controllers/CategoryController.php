<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $category = CategoryModel::get();
        $response = [
            'status' => true,
            'data' => $category,
            'message' => 'Success'
        ];

        return Response::json($response);
    }

    public function getCategoryId($id_category)
    {
        $category = CategoryModel::where('id_category', $id_category)->get();
        $response = [
            'status' => true,
            'data' => $category,
            'message' => 'Success'
        ];

        return Response::json($response);
    }

    public function addCategory(request $req)
    {
        $validator = validator::make($req->all(), [
            'name' => 'required',
            'color' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = CategoryModel::create([
            'name' => $req->get('name'),
            'color' => $req->get('color'),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'Succesfully made new category']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to make category']);
        }
    }

    public function updateCategory(Request $req, $id_category)
    {
        $validator = validator::make($req->all(), [
            'name' => 'required',
            'color' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $update = CategoryModel::where('id_category', $id_category)->update([
            'name' => $req->get('name'),
            'color' => $req->get('color'),
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Succesfully updated category']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to edit category']);
        }
    }

    public function deleteTicket($id_category)
    {
        $delete = CategoryModel::where('$id_category', $id_category)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'massage' => 'Category deleted']);
        } else {
            return response()->json(['status' => false, 'massage' => 'Failed to delete category']);
        }
    }
}
