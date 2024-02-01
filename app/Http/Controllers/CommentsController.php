<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Vote;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function createComment(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'content' => 'required',
            ], [
                'content.required' => 'Please write a comment',
            ]);
            if ($validation->fails()) {
                $error = $validation->errors()->first();
                return response()->json(['error' => $error]);
            }

            $data = new Comments(request()->all());
            $data->user_id = Auth::id();
            $data->save();

            return response()->json([
                'user' => $data->user->name,
                'content' => $data->content,
                'created_at' => $data->created_at,
                'success' => 'You commented on Feedback'
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createVote($id)
    {
        try {
            $vote = Vote::firstOrNew(['user_id' => Auth::id(), 'feedback_id' => $id]);
            if (!$vote->exists) {
                $data = new Vote();
                $data->user_id = Auth::id();
                $data->feedback_id = $id;
                $data->save();

                $voteCount = Vote::where('feedback_id', $id)->count();
                return response()->json(['success' => 'Your vote counted', 'vote_count' => $voteCount]);
            } else {
                return response()->json(['error' => 'You already voted for this feedback'], 409);
            }
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
