<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\CloudFile;
use App\Models\CloudFileFolder;
use App\Models\PaymentSystem;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserWalletDetail;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit() {
        $wallets = Wallet::with('currency')->where('user_id', auth()->user()->id)->with('currency')->get();
        
        $auth_log = UserAuthLog::orderByDesc('created_at')->limit(5)->get();
        return view('accountPanel.profile.edit', [
            'user' => Auth::user(),
            'auth_log' => $auth_log,
            'wallets' => $wallets,
        ]);
    }
    
    public function updateWalletDetails(Request $request) {
        $request->validate([
            'payment_system_id' => 'required|uuid',
            'user_id' => 'required|uuid',
            'wallet_id' => 'required|uuid',
            'currency_id' => 'required|uuid',
            'external' => 'max:255',
        ]);
        
        $external = $request->get('external');
        $user_id = $request->get('user_id');
        $payment_system_id = $request->get('payment_system_id');
        $wallet_id = $request->get('wallet_id');
        $currency_id = $request->get('currency_id');
        
        if ($user_id !== auth()->user()->id){
            return redirect()->back()->with('error', 'Жулик!');
        }
        $payment_system = PaymentSystem::find($payment_system_id);
        if ($payment_system === null){
            return redirect()->back()->with('error', 'Платёжная система не доступна!');
        }
        $wallet = Wallet::where('id', $wallet_id)->where('user_id', $user_id)->where('currency_id', $currency_id)->first();
        if ($wallet === null){
            return redirect()->back()->with('error', 'Попробуй заново!');
        }
        
        $wallet_details = new UserWalletDetail($request->all());
       
        $wallet_details->save();
        return redirect()->back()->with('success', 'Данные успешно сохранены!');
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $request->validate([
            'login' => 'required|min:3|unique:users,login,' . Auth::user()->id,
            'email' => 'required|min:3|unique:users,email,' . Auth::user()->id,
            'name' => 'required|min:2',
        ]);
        $user = Auth::user();
        $user->update($request->except('_method'));
        return redirect()->route('accountPanel.profile')->with('success', 'Данные успешно изменены!');
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function updatePhoto(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $file = $request->file('avatar');
        $folder_id = $request->folder_id;
        $newName = md5($file->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $file->getExtension();
        
        try {
            DB::transaction(function () use ($newName, $file, $folder_id) {
                if (!is_null($folder_id)) {
                    $folder = CloudFileFolder::findOrFail($folder_id);
                    
                    $upload = Storage::disk('do_spaces')->putFileAs($folder->folder_name, $file, $newName);
                } else {
                    $upload = Storage::disk('do_spaces')->put($newName, $file, 'private');
                }
                
                $user = auth()->user();
                /** @var User $createdBy */
                $createdBy = $user;
                
                $cloudFile = CloudFile::create([
                    'created_by' => $createdBy->id,
                    'name' => strtolower($file->getClientOriginalName()),
                    'ext' => $file->getExtension(),
                    'mime' => $file->getMimeType(),
                    'url' => $upload,
                    'cloud_file_folder_id' => $folder_id,
                    'last_access' => null,
                    'size' => $file->getSize(),
                ]);
                
                $user->avatar = $cloudFile->id;
                $user->save();
            });
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
        
        return redirect()->route('accountPanel.profile', !is_null($folder_id) ? ['folder' => $folder_id] : [])->with('success', 'Файл успешно загружен');
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAvatar($id) {
        $avatar_id = User::findOrFail($id)->avatar;
        
        $file = CloudFile::findOrFail($avatar_id);
        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);
        
        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadDocuments(Request $request) {
        $validator = Validator::make($request->all(), [
            'passportImage' => 'required|mimes:jpeg,gif,png,bmp',
            'selfie' => 'required|mimes:jpeg,gif,png,bmp',
            'full_name' => 'required|string|max:255',
        ], [
            'passportImage.required' => 'Фото паспорта обязятельно',
            'passportImage.mimes' => 'Неверный формат файла для фото паспорта',
            
            'selfie.required' => 'Селфи обязятельно',
            'selfie.mimes' => 'Неверный формат файла для селфи',
            
            'full_name.required' => 'Поле имени обязательно',
            'full_name.max' => 'Максимальное количество символов 255',
        ]);
        
        if (count($validator->errors()->messages())) {
            return back()->with('short_error_array', $validator->errors()->messages());
        }
        
        $passportFile = $request->file('passportImage');
        $selfie = $request->file('selfie');
        
        try {
            DB::transaction(function () use ($passportFile, $selfie, $request) {
                $newName = md5($passportFile->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $passportFile->getExtension();
                $passportFile = Storage::disk('do_spaces')->putFileAs('user_verification_documents', $passportFile, $newName);
                
                $newName = md5($selfie->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $selfie->getExtension();
                $selfie = Storage::disk('do_spaces')->putFileAs('user_verification_documents', $selfie, $newName);
                
                Storage::disk('do_spaces')->setVisibility($passportFile, 'public');
                Storage::disk('do_spaces')->setVisibility($selfie, 'public');
                
                $user = auth()->user();
                
                $user->verifiedDocuments()->create([
                    'passport_image' => $passportFile,
                    'selfie_image' => $selfie,
                    'full_name' => $request->full_name,
                ]);
            });
        } catch (\Exception $exception) {
            return back()->with('short_error', $exception->getMessage());
        }
        
        return back()->with('short_success', 'Заявка на подтверждение личности создана');
    }
}
