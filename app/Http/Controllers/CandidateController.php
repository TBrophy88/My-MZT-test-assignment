<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Mail\ContactCandidate;
use App\Mail\HireCandidate;
use App\Jobs\SendEmail;

class CandidateController extends Controller
{
    /**
     * Returns the candidates page view
     *
     * @return view
     */
    public function index()
    {
        return view('candidates.index');
    }


    /**
     * Returns a list of all candidates and the wallet data
     *
     * @return JsonResponse
     */
    public function list()
    {
        $candidates = Candidate::all();
        $wallet = Company::find(1)->wallet;
        if (!$candidates || !$wallet) {
            return response('Data not found', 500);
        }

        return response([$candidates, $wallet], 200);
    }


    /**
     * Deducts 5 coins from wallet (if there are enough),
     * Sends contact email
     * Updates candidate's contacted status
     *
     * @return JsonResponse
     */
    public function contact(Request $request)
    {
        $candidates = Candidate::all();
        $wallet = Company::find(1)->wallet;
        if (!$candidates || !$wallet) {
            return response('Data not found', 500);
        }

        $candidate = $candidates->find($request->input('candidateID'));

        if ($wallet->coins >= 5 && $candidate->contacted == false) {
            $wallet->coins -= 5;
            $wallet->save();

            SendEmail::dispatch($candidate->email, new ContactCandidate);
            $candidate->contacted = true;
            $candidate->save();
        }

        return response([$candidates, $wallet], 200);
    }


    /**
     * Sends hired email,
     * Updates candidate's hired status,
     * Adds 5 coins to wallet
     *
     * @return JsonResponse
     */
    public function hire(Request $request)
    {
        $candidates = Candidate::all();
        $wallet = Company::find(1)->wallet;
        if (!$candidates || !$wallet) {
            return response('Data not found', 500);
        }

        $candidate = $candidates->find($request->input('candidateID'));

        if ($candidate->contacted == true && $candidate->hired == false) {
            SendEmail::dispatch($candidate->email, new HireCandidate);
            $candidate->hired = true;
            $candidate->save();

            $wallet->coins += 5;
            $wallet->save();
        }

        return response([$candidates, $wallet], 200);
    }
}
