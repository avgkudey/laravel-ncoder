<?php


namespace Tetracode\Ncoder\Http\Middleware;


use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncryptHttp {

    protected $ncoder;

    /**
     * Encrypt Request Response Constructor.
     */
    public function __construct() {
        $this->ncoder = \Tetracode\Ncoder\Ncoder::makeEncrypter();
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if ($request->header('X-REQUEST-ENCRYPTED')) {
            $this->modifyRequest($request);
        }

        $response = $next($request);


        if ($response instanceof JsonResponse && $response->isSuccessful()) {
            $this->modifyResponse($request, $response);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function modifyRequest(Request $request) {
        $decrypted = $request->payload ? $this->ncoder->decrypt($request->payload) : null;
        if ($decrypted) {
            $request->merge($decrypted);
            $request->replace($request->except('payload'));
        }
    }

    /**
     * @param Request $request
     * @param JsonResponse $response
     * @return void
     */
    protected function modifyResponse(Request $request, JsonResponse $response) {
        if ($request->header('X-RESPONSE-ENCRYPTED')) {
            $payload = ['payload' => $this->ncoder->encrypt(json_decode($response->content(), true))];

            $response->setContent(json_encode($payload));
            $response->header('X-RESPONSE-ENCRYPTED', 1);
        }
    }
}