<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\User;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $feedbacks = FeedBack::all();
        return view('admin.dashboard')->with([
            'feedbacks' => $feedbacks,
        ]);
    }

    public function users()
    {
        $users = User::where('role', 1)->get();
        return view('admin.users')->with([
            'users' => $users,
        ]);
    }

    public function deleteUser($id)
    {
        try {
            $data = User::find($id);
            $data->delete();

            return redirect()->route('users')
                ->with([
                    'success' => 'User successfully deleted!'
                ]);
        } catch (Throwable $e) {
            return redirect()->back()
                ->with([
                    'error' => $e->getMessage()
                ]);
        }
    }

    public function updateCommentStatus(Request $request)
    {
        try {
            $data = FeedBack::find($request->feedbackId);
            $data->comment = $request->status;
            $data->save();

            return response()->json(['success' => 'Feedback comment status updated successfully']);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteFeedback($id)
    {
        try {
            $data = FeedBack::find($id);
            $data->delete();

            return redirect()->route('admin.dashboard')
                ->with([
                    'success' => 'Feedback successfully deleted!'
                ]);
        } catch (Throwable $e) {
            return redirect()->back()
                ->with([
                    'error' => $e->getMessage()
                ]);
        }
    }
}
