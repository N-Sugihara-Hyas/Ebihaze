<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static $category = ['管理業務', 'イベント', '会議', '共有', 'その他'];
	static $subcategory = [
		'管理業務' => ['修繕', '清掃', '保険', '町内会等', 'その他'],
		'イベント' => ['イベント'],
		'会議' => ['理事会', '総会', 'その他'],
		'共有' => ['連絡事項', 'その他'],
		'その他' => ['その他']
	];
    public function run()
    {
	    $cate = self::$category[rand(0, count(self::$category)-1)];
	    $subcate = self::$subcategory[$cate][rand(0, count(self::$subcategory[$cate])-1)];
	    DB::table('events')->insert([
			'title' => str_random(10),
			'category' => $cate,
		    'subcategory' => $subcate,
			'schedule' => date('Y-m-d', rand(strtotime('-3month'), strtotime('+6month'))),
			'period' => null,
			'notification' => rand(0,1),
			'content' => 'This is the Content for '.str_random(50),
			'parties' => str_random(20),
			'suppliers' => str_random(20),
			'document' => str_random(40),
			'location' => rand(100,200).'.'.rand(111111, 999999).' '.rand(200,300).'.'.rand(111111,999999),
			'conditions' => str_random(20),
			'message' => 'Message is '.str_random(30),
			'approval' => rand(0,1),
			'etc' => null,
	    ]);
    }
}
