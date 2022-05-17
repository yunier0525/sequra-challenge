<?php

namespace App\Http\Controllers;

use App\Http\Resources\DisburseCollection;
use App\Http\Resources\DisburseResource;
use App\Repositories\DisburseRepository;
use Illuminate\Http\Request;

class DisbursementsController extends Controller
{
    public function __construct(private DisburseRepository $disburseRepository)
    {
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $merchantId = $request->input('merchant');
        $week = $request->input('week');

        if (empty($week)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must pass at least a week to be able to get results.'
            ], 400);
        }

        if (!empty($merchantId)) {
            $disburse = $this->disburseRepository->find($merchantId, $week);

            return new DisburseResource($disburse);
        } else {
            $disburses = $this->disburseRepository->getAll($week);

            return new DisburseCollection($disburses);
        }
    }
}
