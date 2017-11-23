<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Img;

class CommentsController extends Controller
{
	public function postMessage(Request $request)
	{
		$_id = $request->input('_id');
		$comment_body = $request->input('body');
		$commentable_type = $request->input('comment_commentable_type');

		$Comment = new \App\Comment;
		$Comment->body = $comment_body;
		$Comment->user_id = Auth::id();
		// for Test
//		$Comment->user_id = 3;
		$Comment->commentable_type = $commentable_type;
		$Comment->commentable_id = $_id;
		$Comment->is_image = ($request->hasFile('comment_image')) ? 1 : 0;
		if($Comment->save())
		{
			if ($request->hasFile('comment_image'))
			{
				$thumb = $request->file('comment_image');
				$thumb = Img::make($thumb);
				$thumb->fit(240,240);
				$dir = public_path('img/resources/comment/'.$Comment->id);
				if(!is_dir($dir))
				{
					exec('mkdir -p '.$dir);
					exec('chmod -R 777 img/resources');
				}
				$thumb->save($dir.'/image');
			}

			switch ($commentable_type){
				case 'App\Event':
				return redirect()->route('events-message', $Comment->commentable_id);
					break;
				default:
					break;
			}
		}
	}
}
