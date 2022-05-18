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

        // Week param is required
        if (empty($week)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must pass at least a week to be able to get results.'
            ], 400);
        }

        if (!empty($merchantId)) {
            // If merchant is defined get disbursement info only for that merchant
            $disburse = $this->disburseRepository->find($merchantId, $week);

            return new DisburseResource($disburse);
        } else {
            // If merchant is not defined get disbursements info for all of them
            $disburses = $this->disburseRepository->getAll($week);

            return new DisburseCollection($disburses);
        }
    }
}
