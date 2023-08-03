<?php

namespace App\Http\Controllers;

use App\Models\EsnBanner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BannerController extends Controller
{
    public function banners(Request $request): JsonResponse
    {
        $redis = Redis::connection('sentinel');
        $redisBanners = $redis->get('banners');


        if ($redisBanners) {
            $redisBanners = json_decode($redisBanners, true, 512, JSON_THROW_ON_ERROR);
            $country = strtoupper((!empty($_SERVER['GEOIP_COUNTRY_CODE']) ? $_SERVER['GEOIP_COUNTRY_CODE'] : ''));
            $lang = strtoupper($request->has('lang') ? $request->get('lang') : 'ru');
            if ($lang == 'RU') {
                $lang = 'CS';
            }
            $cssFilteredBanners = Arr::where($redisBanners, static function($value, $bannerCode) {
                return Str::startsWith($bannerCode, 'cs');
            });
            $banner = Arr::map($cssFilteredBanners, static function($value) use ($country, $lang) {
                foreach ($value as $data) {
                    if (!empty($data['r'])) {
                        if ((isset($data['r'][$country]) && $data['r'][$country])
                            || (isset($data['r'][$lang]) && $data['r'][$lang])) {
                            return $data;
                        }
                    }
                }
                return null;
            });
            //$banner = Arr::whereNotNull($banner);
            return response()->json(count($banner) ? $banner : $country);
            return response()->json(Arr::whereNotNull($cssFilteredBanners));
            return response()->json(Arr::whereNotNull($banner));
        }

        return response()->json();
    }

    public function go(Request $request)
    {
        if ($request->exists('n')) {
            $banner = DB::table('esn_banners')
                ->select('url', 'txt')
                ->find($request->get('n'));

            if (!$banner->url) {
                abort(404);
            }

            return view('go', [
                'url' => $banner->url,
            ]);
        }

        if ($request->exists('to')) {
            $site = preg_replace(
                '/[^a-z\d\-_\.]+/iu',
                '',
                substr(
                    strip_tags($request->get('to')),
                    0,
                    12
                )
            );
            $url = DB::table('esn_ads_away')->select('url')->find($site)?->url;

            if (!$url) {
                abort(404);
            }

            if ($request->exists('m')) {
                if ($site === 'gg') {
                    $x = DB::table('gt_dota2lounge')
                        ->where('type',  'gg')
                        ->where('mid', $request->get('m'))
                        ->orderBy('num', 'desc')
                        ->first('id');

                    if ($x) {
                        $url = 'https://mercurybest.com/gg/gb/?lp=00&param=cybersportscore_aftermjrpgl21_06&goto=sitereg&lang=ru&lp=00&deeplink=/ru/esports/match/'.$x.'/';
                    }
                } elseif ($site === 'bb') {
                    $countryCode = mb_strtolower(!empty($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : (!empty($_SERVER['GEOIP_COUNTRY_CODE']) ? $_SERVER['GEOIP_COUNTRY_CODE'] : ''));
                    $url = EsnBanner::with(['position', 'traffic.trafficRule', 'traffic.trafficRule.gtCountry'])
                    ->where('site', 'cs')
                    ->where('is_act', '1')
                    ->whereHas('position', function($query) {
                        $query->where('pos', 6);
                    })
                    ->whereHas('traffic', function($query) use ($countryCode) {
                        $query->whereHas('trafficRule', function($query) use ($countryCode) {
                            $query->where('traffic', '1');
                            $query->whereHas('gtCountry', function($query) use ($countryCode) {
                                $query->where('code', $countryCode);
                            });
                        });
                    })->first();
                    if(!$url){
                        $url =  EsnBanner::with(['position', 'traffic.trafficRule', 'traffic.trafficRule.gtCountry'])
                        ->where('site', 'cs')
                        ->where('is_act', '1')
                        ->whereHas('position', function($query) {
                            $query->where('pos', 6);
                        })
                        ->where(function($query) use ($countryCode) {
                        $query->where('site', 'cs')
                            ->where('is_act', '1')
                            ->whereHas('position', function($query) {
                                $query->where('pos', 6);
                            })
                            ->WhereHas('traffic.trafficRule', function($query) use ($countryCode) {
                                $query->where('traffic', '0');
                            });
                        })->first();
                    }
                    if ($url) {
                        $url = $url['url'];
                    }else{
                        $url = 'https://bet-boom.com/registration/base/?utm_source=escorenews&utm_medium=add&utm_campaign=escorenews_&utm_term=odds_betting';
                    }

                } else {
                    $x = DB::table('gt_dota2lounge')
                        ->where('type',  $site)
                        ->where('mid', $request->get('m'))
                        ->orderBy('num', 'desc')
                        ->first('link')
                        ->link;

                    if ($x) {
                        $url = $x;
                    }
                }
            }

            App::setLocale($request->get('lang'));

            return view('go', [
                'url' => $url
            ]);
        }
    }
}
