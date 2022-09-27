<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

class AuthController extends Controller
{
    use ApiResponser;
    /**
     * Fazer o login e pegar o token de autorização.
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth",
     * )
     * Authenticar seu usuário.
     * @OA\Thing(x={"order":2}
     * @OA\Post(
     *     path="/api/auth",
     *     tags={"Auth"},
     *     operationId="login",
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="text/json",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="E-mail cadastrado",
     *                     property="email",
     *                      example="email@email.com",
     *                     type="text",
     *                ),
     *
     *  @OA\Property(
     *                     description="Senha cadastrada",
     *                     property="password",
     *                 example="password",
     *                     type="text",
     *                ),

     *             )
     *         )
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="Login feito com sucesso",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Login não autorizado",
     *     ),
     *
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Recuperar informações do usuário logado.
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Get(
     *     path="/api/me",
     *     tags={"Auth"},
     *     operationId="Me",
     *      @OA\Response(
     *         response=200,
     *         description="Dados do usuário logado",
     *     ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function me()

    {
        $countryController = new CountryController();
        $stickerUser = new StickerUserController();
        $info = $stickerUser->getStickerInformations();


        $total_duplicates = array_sum(array_column($info, 'total_stickers'));


        $total_stickers = $countryController->calculateTotalStickers();
        $dados = auth()->user()->toArray();
        $dados['total_album'] = (int) $total_stickers->total_stickers;
        $dados['total_stickers'] = count($info);
        $dados['total_duplicates'] = ($total_duplicates);
        $dados['total_complete'] = ($dados['total_album'] - $dados['total_stickers']);

        return $this->successResponse($dados);
    }

    /**
     * Deslogar e invalidar o token
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     operationId="logout",
     *      @OA\Response(
     *         response=200,
     *         description="Usuário deslogado e o token invalidado",
     *     ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @OA\POST(
     *     path="/api/auth/refresh",
     *     tags={"Auth"},
     *     operationId="Refresh token",
     *      @OA\Response(
     *         response=200,
     *         description="Token refreshed",
     *     ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
}
