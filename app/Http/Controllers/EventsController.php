<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventsController extends Controller
{
	public function list()
	{
		$Events = \App\Event::all();
		foreach($Events as &$event)
		{
			// TODO::Test
			$event->title = mb_strimwidth($event->title, 0, 10, '...');
			$event->parties = mb_strimwidth($event->parties, 0, 10, '...');
		}
		return view('events.list', ['events' =>$Events]);
	}
	public function add()
	{
		return view('events.add');
	}
	public function postAdd(Request $request)
	{
		// TODO::Validate, Image
		$all = $request->all();
		$Event = new \App\Event;
		$Event->title = $request->input('title');
		$Event->category = $request->input('category');
		$Event->schedule = $request->input('schedule');
		$Event->notification = 0;
		$Event->content = $request->input('content');
		$Event->suppliers = $request->input('suppliers');
		$Event->parties = $request->input('parties');
		$Event->approval = 0;
		if($Event->save())
		{
			return redirect()->route('events-list');
		}
	}
	public function detail($id)
	{
		$Event = \App\Event::find($id)->first();
		return view('events.detail', ['event' => $Event]);
	}
	public function review($id)
	{
		$Event = \App\Event::find($id);

		foreach($Event->ranks as $rank)
		{
			$rate = $rank->rate;
		}

		return view('events.review', ['event' => $Event, 'rate' => $rate]);
	}
	public function postReview($id, Request $request)
	{
		$rate = $request->input('rank_rate');
		$message = $request->input('event_message');
		$Event = \App\Event::updateOrCreate(
			['id' => $id],
			['message' => $message, 'approval' => 1]
		);
		$Rank = \App\Rank::updateOrCreate(
			['rankable_id' => $id, 'rankable_type' => 'event'],
			['rankable_id' => $id, 'rankable_type' => 'event', 'rate' => $rate]
		);
		return view('events.review', ['id' => $id]);
	}
	public function message($id)
	{
		$comments = \App\Event::find(1)->comments;
		return view('events.message');
	}
}
