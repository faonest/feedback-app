<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class FeedbackController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function feedback()
    {
        $feedbacks = FeedBack::where('user_id', Auth::id())->get();
        return view('user.feedback')->with([
            'feedbacks' => $feedbacks,
        ]);
    }

    public function storeFeedback(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'title' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);
            if ($validation->fails()) {
                $error = $validation->errors()->first();
                return redirect()->back()
                    ->with([
                        'error' =>  $error
                    ]);
            }

            $data = new FeedBack(request()->all());
            $data->user_id = Auth::id();
            $data->save();

            return redirect()->route('user.dashboard')
                ->with([
                    'success' => 'Feedback successfully submitted!'
                ]);
        } catch (Throwable $e) {
            return redirect()->back()
                ->with([
                    'error' => $e->getMessage()
                ]);
        }
    }
}
