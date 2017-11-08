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
		$title = '案件一覧';

		if(session()->has('apartment_id'))
		{
			$Apartment = \App\Apartment::find(session('apartment_id'));
		}
		else
		{
			$Apartments = \App\User::find(Auth::id())->apartments;
			$Apartment = $Apartments[0];
		}
		// マンション名表示
		$title = $Apartment->name;

		$Events = $Apartment->events;
		$calendar = [];
		foreach($Events as &$event)
		{
			$event->title = mb_strimwidth($event->title, 0, 10, '...');
			$event->parties = mb_strimwidth($event->parties, 0, 10, '...');
			/** 業者 / 関係者 表示 */
//			$suppliers_ids = $event->suppliers;
//			if(preg_match('/([1-9]+,?)+/', $suppliers_ids)){
//				$suppliers_ids = explode(',', $suppliers_ids);
//				$suppliers = [];
//				foreach($suppliers_ids as $trader_id){
//					$suppliers[] = \App\Trader::where('id', $trader_id)->value('name');
//				}
//				$event->suppliers = implode('/', $suppliers);
//			}
			$event = $event->suppliersName($event);
//			$parties_ids = $event->parties;
//			if(preg_match('/([1-9]+,?)+/', $parties_ids)) {
//				$parties_ids = explode(',', $parties_ids);
//				$parties = [];
//				foreach($parties_ids as $user_id){
//					$parties[] = \App\User::where('id', $user_id)->value('nickname');
//				}
//				$event->parties = implode('/', $parties);
//			}
			$event = $event->partiesName($event);
			/** イベントステータス付け **/
			// 完了
			if($event->approval==1 && strtotime($event->schedule)<time())$event->status = 'done';
			elseif ($event->approval==0 && strtotime($event->schedule)<time())$event->status = 'required';
			else $event->status = '';
			/** カレンダー用付け **/
			$calendar[] = $event->schedule;
			$calendar = array_unique($calendar);
		}
		// 日付指定アリの場合
		if(isset($_GET['schedule']))$Events = $Apartment->events()->where('schedule', 'LIKE', $_GET['schedule'])->get();

		$Event = new \App\Event;
		return view('events.list', ['events' =>$Events, 'calendar' => $calendar, 'title' => $title, 'event' => $Event]);
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
		$route = ['title' => '案件一覧', 'url' => route('events-list')];
		$title = "案件登録";

		$Event = new \App\Event;
		// 業者選択用
		$Traders = \App\Trader::all();
		$Users = \App\User::all();

		return view('events.add', ['event' => $Event, 'route' => $route, 'title' => $title, 'traders' => $Traders, 'users' => $Users]);
	}
	public function postAdd(Request $request)
	{
		$error_rules = [
			'formats' => [
				'title' => 'required',
				'schedule.Ymd' => 'required|date_format:Y/m/d',
				'schedule.Hi' => 'required|date_format:H:i',
				'schedule_end.Ymd' => 'required|date_format:Y/m/d',
				'schedule_end.Hi' => 'required|date_format:H:i',
				'category' => 'in:'.implode(',', array_keys(\App\Event::$category)),
				'subcategory' => 'in:'.implode(',', array_collapse(\App\Event::$category)),
				'event_thumb' => 'image'
			],
			'messages' => [
				'title.required' => 'タイトルを入力して下さい',
				'schedule.Ymd.required'  => '開始施工日時：日付を入力して下さい',
				'schedule.Ymd.date_format'  => '開始施工日時：日付の形式が正しくありません',
				'schedule.Hi.required'  => '開始施工日時：時間を入力して下さい',
				'schedule.Hi.date_format'  => '開始施工日時：時間の形式が正しくありません',
				'schedule_end.Ymd.required'  => '終了施工日時：日付を入力して下さい',
				'schedule_end.Ymd.date_format'  => '終了施工日時：日付の形式が正しくありません',
				'schedule_end.Hi.required'  => '終了施工日時：時間を入力して下さい',
				'schedule_end.Hi.date_format'  => '終了施工日時：時間の形式が正しくありません',
				'category.in'  => '種類１はいずれかをお選び下さい',
				'subcategory.in'  => '種類２はいずれかをお選び下さい',
				'event_thumb.image' => '画像登録は画像のみとなります'
			]
		];

		$Event = new \App\Event;
		$schedule = $request->input('schedule.Ymd').' '.$request->input('schedule.Hi');
		$schedule_end = $request->input('schedule_end.Ymd').' '.$request->input('schedule_end.Hi');
		// Validate
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$Event->title = $request->input('title');
		$Event->category = $request->input('category');
		$Event->subcategory = $request->input('subcategory');
		$Event->schedule = $schedule;
		$Event->schedule_end = $schedule_end;
		$Event->notification = 0;
		$Event->content = $request->input('content');
		$Event->suppliers = $request->input('suppliers');
		$Event->parties = $request->input('parties');
		$Event->approval = 0;
		$Event->apartment_id = session('apartment_id');

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
		$route = ['title' => '案件一覧', 'url' => route('events-list')];
		$title = "案件詳細";

		$Event = \App\Event::find($id);
		// 業者・関係者取得
		$Event = $Event->suppliersName($Event);
		$Event = $Event->partiesName($Event);
		return view('events.detail', ['event' => $Event, 'route' => $route, 'title' => $title]);
	}
	public function review($id)
	{
		$route = ['title' => '案件詳細', 'url' => route('events-detail', $id)];
		$title = "案件評価";

		$Event = \App\Event::find($id);
		// 業者・関係者取得
		$Event = $Event->suppliersName($Event);
		$Event = $Event->partiesName($Event);
		// Rankレートを取得してラジオを選択
		$rate=[];
		foreach($Event->ranks as $rank)
		{
			$rate = $rank->rate;
		}

		return view('events.review', ['event' => $Event, 'rate' => $rate, 'route' => $route, 'title' => $title]);
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
		// 戻る分岐
		if(request()->headers->get('referer')==route('events-detail', $id))
		{
			$route = ['title' => '案件一覧', 'url' => route('events-detail', $id)];
			$title = "案件詳細";
		}
		else
		{
			$route = ['title' => '案件一覧', 'url' => route('events-review', $id)];
			$title = "案件評価";
		}

		$Event = \App\Event::find($id);
		$comments = $Event->comments;
		return view('events.message', ['event' => $Event, 'route' => $route, 'title' => $title]);
	}

	public function messages()
	{
		return [
			'title.required' => 'タイトルは必須です',
			'body.required'  => 'A message is required',
		];
	}
}
