<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TranslationController extends Controller
{
    public function changeLang(Request $request) {
        //dump($request->all());
        $name = $request->post('name');
        $value = $request->post('text');
        $lang = app()->getLocale();

        // Check lang file
        if (Storage::disk('lang')->exists($lang . '.json')) {
            $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
        } else {
            $translations = [];
        }

        // check lang_manual file
        if (Storage::disk('lang')->exists($lang . '_manual.json')) {
            $manual = json_decode(Storage::disk('lang')->get($lang . '_manual.json'), true);
            if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                unset($manual[$name]);
            } else {
                $manual[$name] = true;
            }
            Storage::disk('lang')->put($lang . '_manual.json', json_encode($manual));
        } else {
            $manual = [];
            if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                unset($manual[$name]);
            } else {
                $manual[$name] = true;
            }
            Storage::disk('lang')->put($lang . '_manual.json', json_encode($manual));
        }

        $translations[$name] = htmlspecialchars($value);

        if (Storage::disk('lang')->put($lang . '.json', json_encode($translations))) {
            return json_encode([
                'status' => 'good',
                'msg' => 'Фраза изменена!',
            ]);
        }

        return json_encode([
            'status' => 'bad',
            'msg' => 'Фраза не была изменена!',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|never
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTranslations(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        if (!$user) {
            return abort(403);
        }

        $languages = Language::all();
        $translations = [];
        $translationKeys = [];

        foreach ($languages as $language) {
            $translations[$language->code] = Storage::disk('lang')->exists($language->code . '.json') ? json_decode(Storage::disk('lang')->get($language->code . '.json'), true) : [];
            $translationKeys = array_merge($translationKeys, array_keys($translations[$language->code]));
        }

        $translationKeys = array_unique($translationKeys);

        return response()->json([
            'translations' => $translations,
            'translationKeys' => $translationKeys
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|never
     */
    public function setTranslations(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        if (!$user) {
            return abort(403);
        }

        try {
            foreach ($request->translations as $lang => $translation) {
                foreach ($translation as $name => $value) {

                    // Check lang file
                    if (Storage::disk('lang')->exists($lang . '.json')) {
                        $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
                    } else {
                        $translations = [];
                    }

                    // check lang_manual file
                    if (Storage::disk('lang')->exists($lang . '_manual.json')) {
                        $manual = json_decode(Storage::disk('lang')->get($lang . '_manual.json'), true);
                        if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                            unset($manual[$name]);
                        } else {
                            $manual[$name] = true;
                        }
                        Storage::disk('lang')->put($lang . '_manual.json', json_encode($manual));
                    } else {
                        $manual = [];
                        if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                            unset($manual[$name]);
                        } else {
                            $manual[$name] = true;
                        }
                        Storage::disk('lang')->put($lang . '_manual.json', json_encode($manual));
                    }

                    $translations[$name] = htmlspecialchars($value);

                    Storage::disk('lang')->put($lang . '.json', json_encode($translations));
                }
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
