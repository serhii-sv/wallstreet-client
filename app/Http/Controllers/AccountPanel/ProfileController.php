<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\CloudFile;
use App\Models\CloudFileFolder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    
    public function edit() {
        return view('accountPanel.profile.edit',[
            'user' => Auth::user(),
        ]);
    }
    
    public function update(Request $request) {
        $request->validate([
            'login' => 'required|min:3|unique:users,login,' . Auth::user()->id,
            'email' => 'required|min:3|unique:users,email,' . Auth::user()->id,
            'name' => 'required|min:2',
        ]);
        $user = Auth::user();
        $user->update($request->except('_method'));
        return redirect()->route('accountPanel.profile')->with('success','Данные успешно изменены!');
    }
    
    public function updatePhoto(Request $request) {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $file       = $request->file('avatar');
        $folder_id   = $request->folder_id;
        $newName    = md5($file->getClientOriginalName().rand(0, 1000000).microtime()).'.'.$file->getExtension();
    
        try {
            DB::transaction(function() use($newName, $file, $folder_id) {
                if (!is_null($folder_id)) {
                    $folder = CloudFileFolder::findOrFail($folder_id);
                
                    $upload = Storage::disk('do_spaces')->putFileAs(
                        $folder->folder_name, $file, $newName
                    );
                } else {
                    $upload = Storage::disk('do_spaces')->put($newName, $file, 'private');
                }
            
                $user = auth()->user();
                /** @var User $createdBy */
                $createdBy = $user;
            
                $cloudFile = CloudFile::create([
                    'created_by'    => $createdBy->id,
                    'name'          => strtolower($file->getClientOriginalName()),
                    'ext'           => $file->getExtension(),
                    'mime'          => $file->getMimeType(),
                    'url'           => $upload,
                    'cloud_file_folder_id' => $folder_id,
                    'last_access'   => null,
                    'size'          => $file->getSize(),
                ]);
           
                $user->avatar = $cloudFile->id;
                $user->save();
            });
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
        
        return redirect()->route('accountPanel.profile', !is_null($folder_id) ? ['folder' => $folder_id] : [])->with('success', 'Файл успешно загружен');
    }
    public function getAvatar($id) {
        $avatar_id = User::findOrFail($id)->avatar;
        
        $file = CloudFile::findOrFail($avatar_id);
        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);
        
        
        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);
    }
    
}
