<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Registrar usuário no sistema
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     * Authenticar seu usuário.
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     operationId="Cadatrar usuário",
* @OA\RequestBody(
*         @OA\MediaType(
     *             mediaType="text/json",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="Nome",
     *                     property="name",
     *                      example="Meu nome",
     *                     type="text",
     *                ),
      *  @OA\Property(
     *                     description="E-mail",
     *                     property="email",
     *                 example="email@email.com.br",
     *                     type="email",
     *                ),
      *  @OA\Property(
     *                     description="Minha senha",
     *                     property="password",
     *                 example="password",
     *                     type="password",
     *                ),
     *  @OA\Property(
     *                     description="Confirmação de senha",
     *                     property="password_confirmation",
     *                 example="password",
     *                     type="password",
     *                ),

     *             ),
     * ),
     * ),
     *

     *     @OA\Response(
     *         response=200,
     *         description="Login feito com sucesso",
     *     ),

     *     @OA\Response(
     *         response=422,
     *         description="Falha na validação dos campos",
     * )
     *
     * )
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        return $this->successResponse($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
