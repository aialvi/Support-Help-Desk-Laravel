<?php

namespace App\Http\Controllers;

use App\mailers\AppMailer;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{

    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment'   => 'required'
        ]);

        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id'    => auth()->user()->id,
            'comment'    => $request->input('comment'),
        ]);

        // send mail if the user commenting is not the ticket owner
        if ($comment->ticket->user->id !== auth()->user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, auth()->user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with("status", "Your comment has been submitted.");
    }
}
