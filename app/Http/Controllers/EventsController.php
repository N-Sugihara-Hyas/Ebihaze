<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Img;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
	public function list()
	{
		$Apartments = \App\User::find(Auth::id())->apartments;
		$Events = $Apartments[0]->events;
		foreach($Events as &$event)
		{
			// TODO::Test
			$event->title = mb_strimwidth($event->title, 0, 10, '...');
			$event->parties = mb_strimwidth($event->parties, 0, 10, '...');
		}
		return view('events.list', ['events' =>$Events]);
	}
	public function join()
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
	public function watch()
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
		$Event = new \App\Event;
		return view('events.add', ['event' => $Event]);
	}
	public function postAdd(Request $request)
	{
		// TODO::Validate, Image
		$all = $request->all();
		$Event = new \App\Event;
		$Event->title = $request->input('title');
		$Event->category = $request->input('category');
		$Event->subcategory = $request->input('subcategory');
		$Event->schedule = $request->input('schedule');
		$Event->notification = 0;
		$Event->content = $request->input('content');
		$Event->suppliers = $request->input('suppliers');
		$Event->parties = $request->input('parties');
		$Event->approval = 0;

		if($Event->save())
		{
			if ($request->hasFile('event_thumb'))
			{
				$thumb = $request->file('event_thumb');
				$thumb = Img::make($thumb);
				$thumb->fit(240,240);
//				$dir = asset('img/resources/event/'.$Event->id);
				$dir = '/home/vagrant/ebihaze/public/img/resources/event/'.$Event->id;
				$dir = public_path('img/resources/event/'.$Event->id);
				if(!is_dir($dir))
				{
//					mkdir($dir, 0777);
					exec('mkdir -p '.$dir);
					exec('chmod -R 777 img/resources');
//					exec('install -d -m=777 '.$dir);
				}
				$thumb->save($dir.'/thumb');
//				$thumb->save(asset('img/resources/event/'.$Event->id.'/thumb.'.$thumb->getClientOriginalExtension()));
			}
			return redirect()->route('events-list');
		}
		else
		{
			//TODO::throw404
		}
	}
	public function search()
	{
		return view('events.add');
	}

	public function detail($id)
	{
		$Event = \App\Event::find($id)->first();
		return view('events.detail', ['event' => $Event]);
	}
	public function review($id)
	{
		$Event = \App\Event::find($id);
		// Rankレートを取得してラジオを選択
		$rate=[];
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
			['rankable_id' => $id, 'rankable_type' => 'App\Event'],
			['rankable_id' => $id, 'rankable_type' => 'App\Event', 'rate' => $rate]
		);
		return redirect()->route('events-review', $id);
	}
	public function message($id)
	{
		$Event = \App\Event::find($id);
		$comments = $Event->comments;
		return view('events.message', ['event' => $Event]);
	}
}
