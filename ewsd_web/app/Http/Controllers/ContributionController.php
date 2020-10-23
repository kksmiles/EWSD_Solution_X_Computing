<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Contributions;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ContributionController extends Controller
{
    // ! Student  Contribution
    // show all contributions of auth student
    
    public function studentAllContribution(){
        $contributions = Auth::user()->contributions;
        if(!isset($contributions)) {
            return redirect()->route('contribution.upload')->with('success', 'Your Contributions does not exist. Please upload now'); 
        }
        session()->forget('header');
        return view('student.contribution.index', compact('contributions'));
    }

    public function upload(){
        $ufModel = new \App\UserFaculty;
        $availableMagazineIssuesWithFaculty = $ufModel->getMagazines();
        return view('student.contribution.upload',compact('availableMagazineIssuesWithFaculty'));
    }
    // users -> user_faculty => faculty // magzines_issue_faculty -> select('magazine_issue')

    // store
    public function store(Request $request){
        $request->validate([
            'issueId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => ['mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        $newContribution = new Contributions;
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('file')){
            $file_name = $current_timestamp . "_" . $request->file->getClientOriginalName();
            $extension = $request->file->extension();
            $request->file->storeAs('/public/contribution-files/', $file_name. "." .$extension);
            $file_url = Storage::url("contribution-files/" .$file_name. "." .$extension);
            $newContribution->file = $file_url;
        }
        
        $newContribution->student_id = \Auth::user()->id;
        $newContribution->issue_id = $request['issueId'];
        $newContribution->title = $request['title'];
        $newContribution->description = $request['description'];
        $newContribution->is_published = '0';
        $newContribution->save();

        // send mail to respective contributor
        $contributor = \App\MagazineIssue::findOrFail($request['issueId'])->staff()->first();
        $contributorName = $contributor->fullname;
        $contributorMail = $contributor->email;
        $mailData = [
            'contributor_name' => $contributorName,
            'contributor_mail' => $contributorMail,
            'student_name'  => \Auth::user()->fullname,
            'student_gmail' => \Auth::user()->email,
            'title' => $request['title'],
            'status' => 'new'
        ];

        // @ Call sendMailToContributor mail function
        $sendMailToContributor = $this->sendMailToContributor($mailData);
        $getResult = $sendMailToContributor->getOriginalContent();
        if($getResult["message"] != "success"){
            return redirect()->route('contribution.upload')->with('fail', 'Mail Failed, Try again!');
        }

        return redirect()->route('contribution.upload')->with('success', 'Student Contribution uploaded successfully!');
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => ['mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        $updateContribution = \App\Contributions::find($request->id);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('file')){
            $file_name = $current_timestamp . "_" . $request->file->getClientOriginalName();
            $extension = $request->file->extension();
            $request->file->storeAs('/public/contribution-files/', $file_name. "." .$extension);
            $file_url = Storage::url("contribution-files/" .$file_name. "." .$extension);
            $updateContribution->file = $file_url;
        }
        $updateContribution->title = $request['title'];
        $updateContribution->description = $request['description'];
        $updateContribution->is_published = '0';
        $updateContribution->save();

        // send mail to respective contributor
        $contributor = \App\MagazineIssue::findOrFail($updateContribution->issue_id)->staff()->first();
        $contributorName = $contributor->fullname;
        $contributorMail = $contributor->email;
        $mailData = [
            'contributor_name' => $contributorName,
            'contributor_mail' => $contributorMail,
            'student_name'  => \Auth::user()->fullname,
            'student_gmail' => \Auth::user()->email,
            'title' => $request['title'],
            'status' => 'updated'
        ];

        // @ Call sendMailToContributor mail function
        $sendMailToContributor = $this->sendMailToContributor($mailData);
        $getResult = $sendMailToContributor->getOriginalContent();
        if($getResult["message"] != "success"){
            return redirect()->route('contribution.student.all',$request->id)->with('fail', 'Mail Failed, Try again!');
        }

        return redirect()->route('contribution.student.all',$request->id)->with('success', 'Student Contribution uploaded successfully!');
    }

    // ! Send Mail To Contributor 
    // @ this global function
    public function sendMailToContributor($data){
        $to_name =  $data['contributor_name'];
        $to_email = $data['contributor_mail'];
        $user_data = [
            'contributor_name' => $data['contributor_name'],
            'student_name' => $data['student_name'],
            'email' => $data['student_gmail'],
            'msg_inbox' => $data['title'],
            'title' => $data['status'] == 'new' ? 'Student Contribution Request' : 'Student Contribution [Updated]'
        ];
        \Mail::send('mails.send', $user_data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject("Student Contribution Request");
            $message->from('thuchangetheworld03@gmail.com','no-reply');
        });
        // @ check for failures
        if (\Mail::failures()) {
            return response()->json(['message' => 'failed']);
        }
        return response()->json(['message' => 'success']);
    }

    // @ student edit
    public function studentContributionEdit($id){
        $contribution = \App\Contributions::findOrfail($id);
        $ufModel = new \App\UserFaculty;
        $availableMagazineIssuesWithFaculty = $ufModel->getMagazines();
        return view('student.contribution.edit',compact('contribution','availableMagazineIssuesWithFaculty'));
    }
    // Show contribution Details
    public function show(Contributions $contribution) 
    {
        if(Gate::allows('isStudent')) {
            $this->authorize('view',$contribution);
            return view('student.contribution.show', compact('contribution'));
        } else if(Gate::allows('isMarketingCoordinator')) {
            $this->authorize('viewAsCoordinator',$contribution);
            return view('contributions.show', compact('contribution'));
        } else if (Gate::allows('isMarketingManager')||Gate::allows('isGuest')) {
            return view('contributions.show',compact('contribution'));
        } 
    }
    public function facultyIndexSelectedContributions()
    {
        $magazine_issues = Auth::user()->faculties->first->magazine_issues->get();
        foreach($magazine_issues as $magazine_issue)
        {   
            foreach($magazine_issue->contributions as $contribution) {
                if($contribution->is_published == 1){
                    $coordinatorContributions[] = $contribution;
                }
            }
        }
        return view('contributions.coordinator.index',compact('coordinatorContributions'));
    }
    // This is for marketing coordinator specific magazine issues -> contributions
    public function coordinatorIndexSelectedContributions()
    {
        $magazine_issues = Auth::user()->magazine_issues;
        
        $selected_contributions = new Collection();
        foreach($magazine_issues as $magazine_issue)
        {
            $selected_contributions->push($magazine_issue->contributions->where('is_published', 1));
        }
        return $selected_contributions;
    }
    //  This is to index all the selected contributions for guest.
    public function indexSelectedContributions()
    {
        $coordinatorContributions = Contributions::all()->where('is_published', 1);
        return view('contributions.coordinator.index',compact('coordinatorContributions'));
    }



}