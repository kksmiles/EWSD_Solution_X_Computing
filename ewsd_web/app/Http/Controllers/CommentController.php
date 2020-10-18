<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contributions  $contribution
     * @return \Illuminate\Http\Response
     */
    public function store($contribution_id, Request $request)
    {
        $attributes = request()->validate([
            'comment' => ['required', 'max:255'],
        ]);
        $attributes['user_id']=auth()->id();
        $attributes['contribution_id']=$contribution_id;
        Comment::create($attributes);
        if(Gate::allows('isStudent')) {
            return redirect()->route('contribution.student.show', $contribution_id)->with('success', 'Comment has been added.');
        } else if(Gate::allows('isMarketingCoordinator')) {
            return redirect()->route('contribution.show', $contribution_id)->with('success', 'Comment has been added.');    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $attributes = request()->validate([
            'comment' => ['required', 'max:255'],
        ]);
        $comment->comment= $attributes['comment'];
        $comment->save();
        if(Gate::allows('isStudent')) {
            return redirect()->route('contribution.student.show', $comment->contribution_id)->with('success', 'Comment has been updated.');
        } else if(Gate::allows('isMarketingCoordinator')) {
            return redirect()->route('contribution.show', $comment->contribution_id)->with('success', 'Comment has been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        if(Gate::allows('isStudent')) {
            return redirect()->route('contribution.student.show', $comment->contribution_id)->with('success', 'Comment has been deleted.');
        } else if(Gate::allows('isMarketingCoordinator')) {
            return redirect()->route('contribution.show', $comment->contribution_id)->with('success', 'Comment has been deleted.');
        }
    }
}
