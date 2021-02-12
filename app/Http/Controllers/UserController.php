<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
    * @OA\Post(path="/api/user/create", tags={"User"},
    * @OA\RequestBody(
    *   required = true,
    *   description = "Request body for User",
    *   @OA\MediaType(
    *       mediaType="application/json",
    *       @OA\Schema(
    *           @OA\Property(
    *               property="name",
    *               type="string",
    *           ),
    *           @OA\Property(
    *               property="email",
    *               type="string",
    *           ),
    *           @OA\Property(
    *               property="password",
    *               type="string",
    *           ),
    *           example={"name": "Kevin", "email": "kevin@kevin.com", "password": "123456"},
    *       )
    *   )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function create(Request $request)
    {
        $check_email_exist = User::where('email', $request->email)->get();
        if (isset($check_email_exist[0]->id) && !empty($check_email_exist[0]->id)) {
            return Utils::responseReturn(200, false, 'Email already exist');
        }
        
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success create User');

        } catch (Exception $error) {
            Log::error('Error creating User');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }

    /**
    * @OA\Get(path="/api/user/{id}", tags={"User"},
    * @OA\Parameter(
    *    description="ID of user",
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
        $get_user = User::find($id);
        return Utils::responseReturn(200, true, '', $get_user);
    }

    /**
    * @OA\Get(path="/api/users", tags={"User"},
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function read()
    {
        $get_user = User::all();
        return Utils::responseReturn(200, true, '', $get_user);
    }

    /**
    * @OA\Put(path="/api/user/{id}/update", tags={"User"},
    * @OA\Parameter(
    *    description="ID of user",
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
    *   description = "Request body for User",
    *   @OA\MediaType(
    *       mediaType="application/json",
    *       @OA\Schema(
    *           @OA\Property(
    *               property="name",
    *               type="string",
    *           ),
    *           example={"name": "Kevin"},
    *       )
    *   )
    * ),
    * @OA\Response(response="200", description="Success"),
    * @OA\Response(response="404", description="Not Found")
    * )
    */
    public function update(Request $request, $id)
    {   
        $check_user_exist = User::find($id);
        if (!isset($check_user_exist)){
            return Utils::responseReturn(200, false, 'User not exist');
        }
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->save();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success update User');

        } catch (Exception $error) {
            Log::error('Error updating User');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }

    /**
    * @OA\Delete(path="/api/user/{id}/delete", tags={"User"},
    * @OA\Parameter(
    *    description="ID of user",
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
            $user = User::find($id);
            $user->delete();
            DB::commit();
            return Utils::responseReturn(200, true, 'Success delete User');

        } catch (Exception $error) {
            Log::error('Error deleting User');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }
}
