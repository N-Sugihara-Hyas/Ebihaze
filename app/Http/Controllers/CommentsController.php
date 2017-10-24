<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
	public function postMessage(Request $request)
	{
		$_id = $request->input('_id');
		$comment_body = $request->input('body');
		$commentable_type = $request->input('comment_commentable_type');

		$Comment = new \App\Comment;
		$Comment->body = $comment_body;
		$Comment->user_id = 1;//TODO::Test
		$Comment->commentable_type = $commentable_type;
		$Comment->commentable_id = $_id;
		if($Comment->save())
		{
			switch ($commentable_type){
				case 'Event':
				return redirect()->route('events-message', $Comment->commentable_id);
					break;
				default:
					break;
			}
		}
	}
}
