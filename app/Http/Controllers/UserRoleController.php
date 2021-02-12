<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRoleController extends Controller
{
    /**
    * @OA\Post(path="/api/user-role/create", tags={"User Role"},
    * @OA\RequestBody(
    *   required = true,
    *   description = "Request body for User Role",
    *   @OA\MediaType(
    *       mediaType="application/json",
    *       @OA\Schema(
    *           @OA\Property(
    *               property="user_id",
    *               type="string",
    *           ),
    *           @OA\Property(
    *               property="position",
    *               type="string",
    *           ),
    *           example={"user_id": "1", "position": "CEO"},
    *       )
    *   )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function create(Request $request)
    {
        $check_user_role_exist = UserRole::where('user_id', $request->user_id)->get();
        if (isset($check_user_role_exist[0]->id) && !empty($check_user_role_exist[0]->id)){
            return Utils::responseReturn(200, false, 'User Role already exist');
        }

        $check_user_exist = User::find($request->user_id);
        if (!isset($check_user_exist->id) || empty($check_user_exist->id)) {
            return Utils::responseReturn(200, false, 'User not found');
        }
        
        try {
            DB::beginTransaction();
            $user_role = new UserRole();
            $user_role->user_id = $request->user_id;
            $user_role->position = $request->position;
            $user_role->save();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success create User Role');

        } catch (Exception $error) {
            Log::error('Error creating User Role');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }

    /**
    * @OA\Get(path="/api/user-role/{id}", tags={"User Role"},
    * @OA\Parameter(
    *    description="ID of user role",
    *    in="path",
    *    name="id",
    *    required=false,
    *    example="1",
    *    @OA\Schema(
    *       type="integer",
    *       format="int64"
    *    )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function readByID($id)
    {
        $get_user_role = UserRole::find($id);
        return Utils::responseReturn(200, true, '', $get_user_role);
    }

    /**
    * @OA\Get(path="/api/user-roles", tags={"User Role"},
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function read()
    {
        $get_user_role = UserRole::all();
        return Utils::responseReturn(200, true, '', $get_user_role);
    }

    /**
    * @OA\Put(path="/api/user-role/{id}/update", tags={"User Role"},
    * @OA\Parameter(
    *    description="ID of user role",
    *    in="path",
    *    name="id",
    *    required=true,
    *    example="1",
    *    @OA\Schema(
    *       type="integer",
    *       format="int64"
    *    )
    * ),
    * @OA\RequestBody(
    *   required = true,
    *   description = "Request body for User Role",
    *   @OA\MediaType(
    *       mediaType="application/json",
    *       @OA\Schema(
    *           @OA\Property(
    *               property="position",
    *               type="string",
    *           ),
    *           @OA\Property(
    *               property="status",
    *               type="string",
    *           ),
    *           example={"position": "CEO", "status": "Active"},
    *       )
    *   )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function update(Request $request, $id)
    {   
        $check_user_role_exist = UserRole::find($id);
        if (!isset($check_user_role_exist)){
            return Utils::responseReturn(200, false, 'User Role not exist');
        }
        try {
            DB::beginTransaction();
            $user_role = UserRole::find($id);
            $user_role->position = $request->position;
            $user_role->status = $request->status;
            $user_role->save();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success update User Role');

        } catch (Exception $error) {
            Log::error('Error updating User Role');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }

    /**
    * @OA\Delete(path="/api/user-role/{id}/delete", tags={"User Role"},
    * @OA\Parameter(
    *    description="ID of user role",
    *    in="path",
    *    name="id",
    *    required=true,
    *    example="1",
    *    @OA\Schema(
    *       type="integer",
    *       format="int64"
    *    )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $user_role = UserRole::find($id);
            $user_role->delete();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success delete User Role');

        } catch (Exception $error) {
            Log::error('Error deleting User Role');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }
}
