<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contributions;

class ContributionController extends Controller
{
    // ! Student  Contribution
    // show all contributions of auth student
    public function studentAllContribution(){
        $cModel = new Contributions;
        $getOnlyAuthContributions = $cModel->getOnlyAuthContributions();
       
        if(!count($getOnlyAuthContributions) > 0)
        return redirect()->route('contribution.upload')->with('success', 'Your Contributions does not exist. Please upload now'); 
        $datas = [];
        foreach($getOnlyAuthContributions as $contribution){
            $datas[] = [
                'id' => $contribution->id,
                'contribution_name' => $contribution->title,
                'file' => $contribution->file,
                'issue_name' => $contribution->magazineIssue()->first()->title,
                'faculty_name' => $contribution->magazineIssue()->first()->faculty()->first()->name,
                'acedemic_year' => $contribution->magazineIssue()->first()->academic_year()->first()->title,
                'is_published' => $contribution->is_published,
                'uploaded_at' => $contribution->created_at
            ];
        }
        return view('contributions.student.index',compact('datas'));
    }

    public function upload(){
        $ufModel = new \App\UserFaculty;
        $availableMagazineIssuesWithFaculty = $ufModel->getMagazines();
        return view('contributions.student.upload',compact('availableMagazineIssuesWithFaculty'));
    }
    // users -> user_faculty => faculty // magzines_issue_faculty -> select('magazine_issue')

    // store
    public function store(Request $request){
        $request->validate([
            'issueId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => ['required', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        if($request->hasFile('file')){
            $file = $request['file'];
            $fileName =$file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $upload_path = public_path().'/storage/contributions/';
            $file->move($upload_path,$fileName);
            // $file->storeAs('public/contributions/',$fileName);
        }
        $newContribution = new Contributions;
        $newContribution->student_id = \Auth::user()->id;
        $newContribution->issue_id = $request['issueId'];
        $newContribution->title = $request['title'];
        $newContribution->description = $request['description'];
        $newContribution->is_published = '0';
        $newContribution->file = $fileName;
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
            'issueId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => ['required', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        if($request->hasFile('file')){
            $file = $request['file'];
            $fileName =$file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $file->storeAs('public/contributions/',$fileName);
        }
        $updateContribution = \App\Contributions::find($request->id);
        $updateContribution->issue_id = $request['issueId'];
        $updateContribution->title = $request['title'];
        $updateContribution->description = $request['description'];
        $updateContribution->is_published = '0';
        $updateContribution->file = $fileName;
        $updateContribution->save();

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
            'status' => 'updated'
        ];

        // @ Call sendMailToContributor mail function
        $sendMailToContributor = $this->sendMailToContributor($mailData);
        $getResult = $sendMailToContributor->getOriginalContent();
        if($getResult["message"] != "success"){
            return redirect()->route('contribution.student.edit',$request->id)->with('fail', 'Mail Failed, Try again!');
        }

        return redirect()->route('contribution.student.edit',$request->id)->with('success', 'Student Contribution uploaded successfully!');
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
        $contributions = \App\Contributions::findOrfail($id);
        $ufModel = new \App\UserFaculty;
        $availableMagazineIssuesWithFaculty = $ufModel->getMagazines();
        return view('contributions.student.edit',compact('contributions','availableMagazineIssuesWithFaculty'));
    }



}
