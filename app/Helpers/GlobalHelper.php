<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GlobalHelper
{
	public static function strg($file)
	{
		$apiKey = env('STRG_TOKEN', '01HPZFBAYNDNHPMB4FA26BS11X');
		$apiSecret = env('STRG_SECRET', '5WFR-X-x0h3XgE)Y-4jJ.dOp&MJd%W~');
		//  $mctcdr = DB::table('master.merchant_cloudinary')->where('merchant_id', Auth::user()->merchant_id)->orderBy('created_at', 'desc')->first();
		//  if ($mctcdr) {
		// 	  $apiKey = $mctcdr->api_key;
		// 	  $apiSecret = $mctcdr->api_secret;
		//  }
		$f = fopen($file, 'r');
		$req = Http::withHeaders([
			'token' => $apiKey,
			'secret' => $apiSecret,
		])->attach(
			'file',
			$f,
			$file->getClientOriginalName(),
			['Content-Type' => $file->getMimeType()]
		)->post('https://strg.domainnamegoeshere.xyz/upload');

		return $req;
	}

	public static function delstrg($s, $p = 0)
	{
		$apiKey = env('STRG_TOKEN', '01HPZFBAYNDNHPMB4FA26BS11X');
		$apiSecret = env('STRG_SECRET', '5WFR-X-x0h3XgE)Y-4jJ.dOp&MJd%W~');
		//  $mctcdr = DB::table('master.merchant_cloudinary')->where('merchant_id', Auth::user()->merchant_id)->orderBy('created_at', 'desc')->first();
		//  if ($mctcdr) {
		// 	  $apiKey = $mctcdr->api_key;
		// 	  $apiSecret = $mctcdr->api_secret;
		//  }
		$req = Http::withHeaders([
			'token' => $apiKey,
			'secret' => $apiSecret,
		])->delete('https://strg.domainnamegoeshere.xyz/delete/s/' . $s . '?perma=' . $p);

		return $req;
	}
}
