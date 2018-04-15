<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Member;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request){
        if(Member::where('username',$request->username)->exists()){
          if(Hash::check($request->password,
            Member::where('username',$request->username)->first()->password)){
              $member = Member::where('username',$request->username)->first();
              do{
                $member->token = str_random(30);
              } while(Member::where('token',$member->token)->exists());

              $member->save();

              return response()->json($member->token,200);
          }
          else {
            return response()->json('Wrong password');
          }
        }
        else {
          return response()->json('No such user',403);
        }
    }

    public function register(Request $request){
      //check if member exists
      if(Member::where('username',$request->username)->exists()){
        return response()->json('User exists',403);
      }
      else {
        Member::create(['username'=>$request->username,'password'=>Hash::make($request->password),'displayName' => $request->displayName]);
        return response()->json('Registration success',200);
      }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
