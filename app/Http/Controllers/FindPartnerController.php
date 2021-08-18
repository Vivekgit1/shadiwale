<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::where('id',Auth::id())->firstORFail();
        $findpartner = User::where([['gender','!=', $user->gender],['manglik','=',$user->manglik],['occupation','=',$user->occupation]])->get();
        if(count($findpartner)>0){
            session()->flash('status', 'Perfect 100% Match Profiles');
        }else{
            $findpartner = User::where([['gender','!=', $user->gender],['manglik','=',$user->manglik]]) ->orWhere('occupation','!=', $user->occupation)->get();
            session()->flash('status', 'Here our suggestion for you might like.');
        }
        
        return view('findpartner',compact('findpartner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->manglik =='both'){
            $request['manglik'] = array('0','1');
        }else{
            $request['manglik'] = array($request['manglik']);
        }
    
       $findpartner = User::select('fname','lname','gender','dob','occupation','salary','family_type','manglik','image')
       ->where([['salary','<=',$request->salary],['id','!=',Auth::id()],['gender','!=',Auth::user()->gender]])
       ->whereIn('occupation',$request->jobtype,'and')->whereIn('family_type',$request->familytype,'and')
       ->whereIn('manglik',$request->manglik,'and')->get();
       
       if(count($findpartner)>0){
        session()->flash('status', 'Search Result on the basis of Peference');
        }else{
            session()->flash('status', 'No Result Found');
        }
       
        return view('findpartner',compact('findpartner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $findpartner
     * @return \Illuminate\Http\Response
     */
    public function show(User $findpartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $findpartner
     * @return \Illuminate\Http\Response
     */
    public function edit(User $findpartner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $findpartner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $findpartner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $findpartner
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $findpartner)
    {
        //
    }
}
