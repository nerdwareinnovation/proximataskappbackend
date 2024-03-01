<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\AstrologerDetails;
use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\PinnedMessage;
use App\Models\Astrology\Chat;
use App\Models\Astrology\SampleQuestions;
use App\Models\Astrology\CustomerNotes;
use App\Models\Astrology\SampleQuestionsModerator;
use App\Models\Astrology\SampleQuestionsCategory;
use App\Models\Astrology\SampleQuestionsCategoryModerator;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;;
class DashboardController extends Controller
{
    public function index(){

        $messages = Chat::whereHas('sender', function ($query){
            $query->where('role_id', '2');
        })->where('read','!=',2)->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->latest()->get();

        $t_messages = (Chat::whereHas('sender', function ($query){
            $query->where('role_id', '2');})->get());
        $total_messages= Count($t_messages);

        $answered_moderator = (count($t_messages->where('read','=','2')));
        $sent_to_psychologist_count = (count($t_messages->where('read','=','4'))/$total_messages)*100;;
        $answered_count = (count($t_messages->where('read','=','2'))/$total_messages)*100;
        $postponed_count = (count($t_messages->where('read','=','3'))/$total_messages)*100;
        $customers_count = (count(User::all()->where('role_id','=','2')));
        $astrologers_count = (count(User::all()->where('role_id','=','3')));
        $moderator_count= (count(User::all()->where('role_id','=','4')));
        $queries_count =(count(AstrologerQuery::all()));
        return view('admin.dashboard')->with(compact('messages','answered_moderator','answered_count','postponed_count','customers_count','moderator_count','astrologers_count','queries_count','sent_to_psychologist_count'));

    }
    public function filterDashboard(Request $request){
//        dd($request->all());

        $filterOption = $request['filterOption'];
        $messages = Chat::whereHas('sender', function ($query){
            $query->where('role_id', '2');
        })->where('read','!=',2)->where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)->latest()->get();

        $t_messages = (Chat::whereHas('sender', function ($query){
            $query->where('role_id', '2');})->where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)->get());
        $total_messages= Count($t_messages);

        $answered_moderator = (count($t_messages->where('read','=','2')));
        $sent_to_psychologist_count = 0;
        $answered_count = 0;
        $postponed_count = 0;
        $customers_count = 0;
        $astrologers_count = 0;
        $moderator_count= 0;
        $queries_count =0;
        if($total_messages != 0 ){
        $sent_to_psychologist_count = (count($t_messages->where('read','=','4'))/$total_messages)*100;;
        $answered_count = (count($t_messages->where('read','=','2'))/$total_messages)*100;
        $postponed_count = (count($t_messages->where('read','=','3'))/$total_messages)*100;
        $customers_count = (count(User::all()->where('role_id','=','2')->where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)));
        $astrologers_count = (count(User::all()->where('role_id','=','3')->where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)));
        $moderator_count= (count(User::all()->where('role_id','=','4')->where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)));
        $queries_count =(count(AstrologerQuery::where('created_at','>=', $request->from_date)->where('created_at','<=', $request->to_date)->get()));
        }
        return view('admin.dashboard')->with(compact('messages','answered_moderator','answered_count','postponed_count','customers_count','moderator_count','astrologers_count','queries_count','sent_to_psychologist_count','filterOption'));

    }
    public function customerList(){

        $customers = User::with('package')->where('role_id','=','2')->get();

        return view('admin.customerList')->with(compact('customers'));
    }

    public function psychologistList(){
        $psychologists = User::all()->where('role_id','=','5');

        return view('admin.psychologistList')->with(compact('psychologists'));
    }




    public function astrologerList(){
        $astrologers = User::all()->where('role_id','=','3');

        return view('admin.astrologerList')->with(compact('astrologers'));
    }


    public function customer($id){
        $messages = Chat::find($id);
        $customer = $messages->sender;
        $customer_notes =  CustomerNotes::where('customer_id','=',$customer->id)->get();
        $questions = SampleQuestionsCategory::all();
       $cus_messages = Chat::with('astrologerQuery','rating')->where('sender_id','=',$customer->id)->orWhere('sender_id','=',0)->orWhere('receiver_id','=',$customer->id)->get();
        $pinnedMessages = PinnedMessage::where('pinned_by',Auth::user()->id)->latest()->get();

        return view('admin.customerScreen')->with(compact('customer','messages','questions','customer_notes','cus_messages','pinnedMessages'));
    }

    public function customerSample(){
        $questions = SampleQuestionsCategory::all();
        return view('admin.question.customerSample')->with(compact('questions'));
    }

    public function editCustomerQuestion($id){
        $questions = SampleQuestionsCategory::all();
        $ques_edit = SampleQuestions::find($id);
        return view('admin.question.customerSample')->with(compact('questions','ques_edit'));
    }

    public function questionModCategory(){
            $categories = SampleQuestionsCategoryModerator::all();
            return view('admin.question.categoryModerator')->with(compact('categories'));
    }
    public function editQuestionModCategory($id){
        $categories = SampleQuestionsCategoryModerator::all();
        $category = SampleQuestionsCategoryModerator::find($id);
        return view('admin.question.categoryModerator')->with(compact('categories','category'));
    }
    public function updateCategoryModerator(Request $request,$id){
            $validated = $request->validate([
                'category_name' => 'required',
                'description' => 'required',
            ]);
            $category =  SampleQuestionsCategoryModerator::find($id);
            $category->category_name = $request['category_name'];
            $category->description = $request['description'];
            $category->save();
            return redirect(route('admin.questionModCategory'));

    }

    public function questionCategory(){
        $categories = SampleQuestionsCategory::all();
        return view('admin.question.category')->with(compact('categories'));
    }
    public function updateCustomerQuestionCategory(Request $request,$id){
        $validated = $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);
        $category =  SampleQuestionsCategory::find($id);
        $category->category_name = $request['category_name'];
        $category->description = $request['description'];
        $category->save();
        return redirect(route('admin.questionCategory'));

    }
    public function deleteCustomerQuestionCategory($id){
        $questions = SampleQuestionsCategory::where('id','=',$id)->first();
        $questions->delete();
        return redirect()->route('admin.questionCategory');

    }

    public function editCustomerQuestionCategory($id){
        $categories = SampleQuestionsCategory::all();
        $category = SampleQuestionsCategory::find($id);
        return view('admin.question.category')->with(compact('categories','category'));
    }
        public function deleteCustomerQuestion($id){
            $questions = SampleQuestions::where('id','=',$id)->first();
            $questions->delete();
            return redirect()->route('admin.customerSample');

        }

    public function deleteModeratorQuestionCategory($id){
            $questions = SampleQuestionsCategoryModerator::where('id','=',$id)->first();
            $questions->delete();
            return redirect()->route('admin.questionModCategory');

        }

    public function deleteModeratorQuestion($id){
        $questions = SampleQuestionsModerator::where('id','=',$id)->first();
        $questions->delete();
        return redirect()->route('admin.moderatorSample');

    }

    public function moderatorSample(){
        $questions = SampleQuestionsCategoryModerator::with('questions')->get();

        return view('admin.question.moderatorSample')->with(compact('questions'));
    }

    public function editModeratorQuestion($id){
        $questions = SampleQuestionsCategoryModerator::with('questions')->get();
        $ques_edit = SampleQuestionsModerator::find($id);
        return view('admin.question.moderatorSample')->with(compact('questions','ques_edit'));
    }
    public function updateModeratorQuestionSample(Request $request,$id){
        $questions = SampleQuestionsModerator::find($id);
        $questions->question = $request['question'];
        $questions->category_id = $request['category_id'];
        $questions->save();
        return redirect()->route('admin.moderatorSample');

    }
    public function updateCustomerQuestionSample(Request $request,$id){
         $questions = SampleQuestions::find($id);
         $questions->question = $request['question'];
         $questions->category_id = $request['category_id'];
         $questions->order_ques = $request['order_by'];
         $questions->save();
        return redirect()->route('admin.customerSample');

    }
    public function updateCustomerQuestionSampleOrder(Request $request){
        $questions = SampleQuestions::where('id',$request['sample_id'])->first();
        $questions->order_ques = $request['order_by'];
        $questions->save();
        return redirect()->back();

    }
    public function storeCustomerQuestionSample (Request $request){
        $questions = new SampleQuestions;
        $questions->question = $request['question'];
        $questions->category_id = $request['category_id'];
        $questions->order_ques = $request['order_by'];
        $questions->role = 1;

        $questions->is_published = 1;


        $questions->save();
        return redirect()->route('admin.customerSample');
    }

    public function storeModeratorQuestionSample (Request $request){
        $questions = new SampleQuestionsModerator;
        $questions->question = $request['question'];
        $questions->category_id = $request['category_id'];
        $questions->is_published = 1;
        $questions->save();
        return redirect()->route('admin.moderatorSample');
    }
    public function disableUser($id){
        $user = User::find($id);
        if ($user){
            $user->status = 0;
            $user->save();
        }
        $notification=array(
            'messege'=>'User Disabled Successfully!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function activateUser($id){
        $user = User::find($id);
        if ($user){
            $user->status = 1;
            $user->save();
        }
        $notification=array(
            'messege'=>'User Activated Successfully!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteUser($id){
            $user = User::find($id);
            if ($user){
                $user->delete();

            }
            $notification=array(
                'messege'=>'User Deleted Successfully!',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }


    public function storeCategory(Request $request){
        $validated = $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);
        $category = new SampleQuestionsCategory();
        $category->category_name = $request['category_name'];
        $category->description = $request['description'];
        $category->save();
         return redirect(route('admin.questionCategory'));
    }

     public function storeCategoryModerator(Request $request){
            $validated = $request->validate([
                'category_name' => 'required',
                'description' => 'required',
            ]);
            $category = new SampleQuestionsCategoryModerator();
            $category->category_name = $request['category_name'];
            $category->description = $request['description'];
            $category->save();
            return redirect(route('admin.questionModCategory'));
        }
}
