<?php


namespace BinshopsBlog\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use BinshopsBlog\Middleware\LoadLanguage;
use BinshopsBlog\Middleware\UserCanManageBlogPosts;
use BinshopsBlog\Models\Solutions;
use BinshopsBlog\Models\Pages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use BinshopsBlog\Models\BinshopsCategory;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;
use App\Models\Captcha;
use App\Models\FormSetting;

class BinshopsMenuAdminController extends Controller
{
    /**
     * BinshopsLanguageAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
        $this->middleware(LoadLanguage::class);

    }

    public function index(){
        return view("binshopsblog_admin::menu.index");
    }

    public function page_main(){
        $pages = Pages::all();
        return view("binshopsblog_admin::page.main", compact('pages'));
    }

    public function page_edit($pages_id){
        $page = Pages::where('id',$pages_id)->first();
        return view("binshopsblog_admin::page.edit", compact('page'));
    }

    public function page(){
        return view("binshopsblog_admin::page.index");
    }

    public function page_add(Request $request){

        $validate = $request->validate([
            'page_name' => 'required|min:5|string|max:255',
            'page_subname' => 'required|min:5|string|max:255',
            'page_description' => 'required|min:5|string|max:1500',
            'slug' => 'required|unique:pages,slug',
            'page_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('page_block_image') ) {
            $fileNameToStore = $request->file('page_block_image')->store('main_image', 'public');
        }
    
        Pages::create([
            'title' => Purifier::clean($request->get('page_name')),
            'subtitle' => Purifier::clean($request->get('page_subname')),
            'description' => Purifier::clean($request->get('page_description')),
            'image' => $fileNameToStore,
            'slug' => $request->get('slug'),
        ]);

        return redirect()->route('binshopsblog.admin.page.main')->with('success', 'Page created.');
    }

    public function page_update(Request $request, $pages_id){

       $validate = $request->validate([
           'page_name' => 'required|min:5|string|max:255',
           'page_subname' => 'required|min:5|string|max:255',
           'page_description' => 'required|min:5|string|max:1500',
           'slug' => ['required', Rule::unique('pages', 'slug')->ignore($request->slug, 'slug')],
       ]);

       $page = Pages::find($pages_id);
       $page->title = Purifier::clean($request->get('page_name'));
       $page->subtitle = Purifier::clean($request->get('page_subname'));
       $page->description = Purifier::clean($request->get('page_description'));

       $file = $request->file('page_block_image');
       if ($file) {

           $validate = $request->validate([
               'page_block_image' => 'image|mimes:jpeg,png,jpg,gif',
           ]);

           $path = $file->store('main_image', 'public');

           $old = $page->image;
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $page->image = $path;
       }

       $page->save();
       return redirect()->route('binshopsblog.admin.page.main')->with('success', 'Page updated.');
    }

    public function page_delete($pages_id){

        $pageFiles = Pages::where('id',$pages_id)->first();

        Storage::disk('public')->delete($pageFiles->image);

        $page = Pages::where('id',$pages_id)->delete();
        return redirect()->route('binshopsblog.admin.page.main')->with('success', 'Page deleted.');
    }

    public function solutions(){
        return view("binshopsblog_admin::solutions.index");
    }

    public function solutions_edit($solutions_id){
        $solution = Solutions::where('id',$solutions_id)->first();
        $colors = ['red', 'blue', 'fiolet', 'yellow'];
        return view("binshopsblog_admin::solutions.edit", compact('solution', 'colors'));
    }

    public function solutions_main(){
        $solutions = Solutions::all();
        return view("binshopsblog_admin::solutions.main", compact('solutions'));
    }

    public function solutions_add(Request $request){

        $validate = $request->validate([
            'solution_name' => 'required|min:5|string|max:255',
            'solution_subname' => 'required|min:5|string|max:255',
            'solution_description' => 'required|min:5|string|max:500',

            'solution_first_block' => 'required|min:5|string|max:255',
            'solution_second_block' => 'required|min:5|string|max:255',
            'solution_third_block' => 'required|min:5|string|max:255',
            'solution_fourth_block' => 'required|min:5|string|max:255',

            'solution_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'solution_first_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'solution_second_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'solution_third_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'solution_fourth_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('solution_block_image') ) {
            $fileNameToStore = $request->file('solution_block_image')->store('main_image', 'public');
        }

        if ($request->hasFile('solution_first_block_image') ) {
            $fileNameToStore1 = $request->file('solution_first_block_image')->store('main_image', 'public');
        }

        if ($request->hasFile('solution_second_block_image') ) {
            $fileNameToStore2 = $request->file('solution_second_block_image')->store('main_image', 'public');
        }

        if ($request->hasFile('solution_third_block_image') ) {
            $fileNameToStore3 = $request->file('solution_third_block_image')->store('main_image', 'public');
        }

        if ($request->hasFile('solution_fourth_block_image') ) {
            $fileNameToStore4 = $request->file('solution_fourth_block_image')->store('main_image', 'public');
        }
    
        Solutions::create([
            'title' => Purifier::clean($request->get('solution_name')),
            'subtitle' => Purifier::clean($request->get('solution_subname')),
            'description' => Purifier::clean($request->get('solution_description')),

            'first_block' => Purifier::clean($request->get('solution_first_block')),
            'second_block' => Purifier::clean($request->get('solution_second_block')),
            'third_block' => Purifier::clean($request->get('solution_third_block')),
            'fourth_block' => Purifier::clean($request->get('solution_fourth_block')),

            'first_block_image' => $fileNameToStore1,
            'second_block_image' => $fileNameToStore2,
            'third_block_image' => $fileNameToStore3,
            'fourth_block_image' => $fileNameToStore4,

            'image' => $fileNameToStore,

            'color' => $request->get('color'),
        ]);

        return redirect()->route('binshopsblog.admin.solutions.main')->with('success', 'Solution created.');
        
    }

    public function solutions_update(Request $request, $solutions_id){

        $validate = $request->validate([
            'solution_name' => 'required|min:5|string|max:255',
            'solution_subname' => 'required|min:5|string|max:255',
            'solution_description' => 'required|min:5|string|max:500',

            'solution_first_block' => 'required|min:5|string|max:255',
            'solution_second_block' => 'required|min:5|string|max:255',
            'solution_third_block' => 'required|min:5|string|max:255',
            'solution_fourth_block' => 'required|min:5|string|max:255',
        ]);

        $solution = Solutions::find($solutions_id);

        $solution->title = Purifier::clean($request->get('solution_name'));
        $solution->subtitle = Purifier::clean($request->get('solution_subname'));
        $solution->description = Purifier::clean($request->get('solution_description'));

        $solution->first_block = Purifier::clean($request->get('solution_first_block'));
        $solution->second_block = Purifier::clean($request->get('solution_second_block'));
        $solution->third_block = Purifier::clean($request->get('solution_third_block'));
        $solution->fourth_block = Purifier::clean($request->get('solution_fourth_block'));

        $solution->color = $request->get('color');
 
        if ($request->hasFile('solution_block_image')) {
            $path = $request->file('solution_block_image')->store('main_image', 'public');

            $validate = $request->validate([    
                'solution_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
 
            $old = $solution->image;
            if ($old) {
                 Storage::disk('public')->delete($old);
            }
 
            $solution->image = $path;
        }

        if ($request->hasFile('solution_first_block_image')) {
            $path = $request->file('solution_first_block_image')->store('main_image', 'public');
 
            $validate = $request->validate([    
                'solution_first_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $old = $solution->first_block_image;
            if ($old) {
                 Storage::disk('public')->delete($old);
            }
 
            $solution->first_block_image = $path;
        }

        if ($request->hasFile('solution_second_block_image')) {
            $path = $request->file('solution_second_block_image')->store('main_image', 'public');
 
            $validate = $request->validate([    
                'solution_second_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $old = $solution->second_block_image;
            if ($old) {
                 Storage::disk('public')->delete($old);
            }
 
            $solution->second_block_image = $path;
        }

        if ($request->hasFile('solution_third_block_image')) {
            $path = $request->file('solution_third_block_image')->store('main_image', 'public');
 
            $validate = $request->validate([    
                'solution_third_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $old = $solution->third_block_image;
            if ($old) {
                 Storage::disk('public')->delete($old);
            }
 
            $solution->third_block_image = $path;
        }

        if ($request->hasFile('solution_fourth_block_image')) {
            $path = $request->file('solution_fourth_block_image')->store('main_image', 'public');
 
            $validate = $request->validate([    
                'solution_fourth_block_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $old = $solution->fourth_block_image;
            if ($old) {
                 Storage::disk('public')->delete($old);
            }
 
            $solution->fourth_block_image = $path;
        }
 
        $solution->save();
        return redirect()->route('binshopsblog.admin.solutions.main')->with('success', 'Solution updated.');
     }

    public function solutions_delete($solutions_id){

        $solutionFiles = Solutions::where('id',$solutions_id)->first();

        Storage::disk('public')->delete($solutionFiles->image, $solutionFiles->first_block_image, $solutionFiles->second_block_image, $solutionFiles->third_block_image, $solutionFiles->fourth_block_image);

        $solution = Solutions::where('id',$solutions_id)->delete();
        return redirect()->route('binshopsblog.admin.solutions.main')->with('success', 'Solution deleted.');
    }

    public function forms(){

        $forms = Form::orderBy('id', 'desc')->get();
        $setting = DB::table('email_setting')->first();
        return view("binshopsblog_admin::forms.main", compact('forms', 'setting'));
    }

    public function forms_update(Request $request, $email_id){
    
        $setting = DB::table('email_setting')->where('id',$email_id)->update(['email'=>$request->get('email')]);
        return redirect()->route('binshopsblog.admin.forms.index')->with('success', 'Email setting updated.');
    }

    public function forms_captcha_update(Request $request, $id){
    
        $captcha = Captcha::find($id);
        $captcha->site_key = Purifier::clean($request->get('site_key'));
        $captcha->secret_key = Purifier::clean($request->get('secret_key'));
        $captcha->save();
        return redirect()->route('binshopsblog.admin.forms.index')->with('success', 'Captcha setting updated.');
    }

    public function forms_url_update(Request $request, $id){
    
        $url = FormSetting::find($id);
        $url->url = Purifier::clean($request->get('url'));
        $url->active = Purifier::clean($request->get('active'));
        $url->save();
        return redirect()->route('binshopsblog.admin.forms.index')->with('success', 'Form setting updated.');
    }

    public function forms_delete($forms_id){

        $forms = Form::where('id',$forms_id)->delete();
        return redirect()->route('binshopsblog.admin.forms.index')->with('success', 'Solution deleted.');
    }

    public function tree(Request $request){
        $language_id = $request->get('language_id');
        $cat_roots = BinshopsCategory::roots()->get();
        BinshopsCategory::loadSiblingsWithList($cat_roots);
        $pages = Pages::all();
        return view("binshopsblog_admin::tree.main", compact('cat_roots', 'language_id', 'pages'));
    }

    public function youtube() {
        $youtube = DB::table('youtube')->first();
        return view("binshopsblog_admin::forms.youtube", compact('youtube'));
    }

    public function youtube_update(Request $request, $youtube_id){
    
        $youtube = DB::table('youtube')->where('id',$youtube_id)->update(['youtube_src'=>$request->get('youtube_src')]);
        return redirect()->route('binshopsblog.admin.youtube.index')->with('success', 'Youtube URL updated.');
    }
}
