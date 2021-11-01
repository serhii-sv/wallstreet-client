<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    //
    public function index() {
        $lang = app()->getLocale();
        
        $result = [];
        $files = $this->getFileTemplates();
        $codes = $this->scanLangCodes($files);
        if (count($codes) > 0){
            foreach ($codes as $code) {
                
            }
            dd($result);
        }
        else{
            dd('Empty');
        }
    }
    
    public function scanLangCodes($file) {
        if (file_exists($file)) {
            $file_content = file_get_contents($file);
            preg_match_all("/__[(]['\"](?P<key>[\\s\\w.?!]+)['\"][)]/ui", $file_content, $matches);
            return array_unique($matches['key']);
        }
        return [];
    }
    
    public function getFileTemplates() {
        $view_path = resource_path() . "/views/";
       
      
        $file = $view_path . "customer/main.blade.php";
        //$files = $this->scanDirectories($view_path);
        return $file;
        //return $files;
    }
    
    public function scanDirectories($dir) {
        
    }
}
