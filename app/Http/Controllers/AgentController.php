<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ Agent};
use DB;
use Validator;
class AgentController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.agentRegistration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'agent_name' =>'required|min:5|max:255',
            'phone_number' =>'required|min:|max:255|unique:agents',
            'agent_image' => 'file|required|mimes:jpeg,bmp,png,PNG,jpg,JPEG|max:1999',
            'state' =>'required|min:1|max:255',
            'lga' =>'required|min:1|max:255',
            'email' => 'required|min:|max:255|unique:agents',
            'category' =>'required|min:1|max:255',
            'description' => 'required|min:1|max:255',
        ]);
        

        if($request->hasFile('agent_image')){
            //Getting File Name With Extension
            $filenameWithExt = $request->file('agent_image')->getClientOriginalName();
            // Get Just File Name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('agent_image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $filename.'.'.$extension;
            //upload the image
            $path=$request->file('agent_image')->move('agent-logo', $fileNameToStore);
        }else{
            $fileNameToStore = 'no-image.png';
        }

        $data = new Agent([
            
            "agent_name" => $request->input('agent_name'),
            "phone_number" => $request->input('phone_number'),
            "agent_image" =>  $fileNameToStore,
            'state' => $request->input('state'),
            'lga' => $request->input('lga'),
            "agent_number" => rand(001, 1000),
            'registration_id' => rand(10, 700),
            "email" => $request->input('email'),
            "category" => $request->input('category'),
            "description" => $request->input('description'),
        ]);
        $owner = $request->input('email');
       
        if($data->save()){ 
            //return redirect()->route("dashboard")->with("success", "You Have Registered Successfully");
            return redirect()->back()->with([
                'success'=> 'You Have Completed Your Registration Successfully',
                'owner'=> $owner,
                
            ]);
            //return response()->json(['success'=> 'You Have Completed Your Registration Successfully']);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agentDetails(Request $request)
    {
        $data = $this->validate($request, [
            'state' =>'required|min:1|max:255',
            'lga' =>'required|min:1|max:255',
        ]);

        $check = Agent::where([
            "state" => $request->input('state'), 
            "lga" => $request->input('lga'),
        ])->first();
        if(empty($check)){
            return redirect()->back()->with(['error'=> 'No Agent was found in the selected areas']);
        }else{
            $agent =Agent::where([
                "state" => $request->input('state'), 
                "lga" => $request->input('lga')
            ])->get();
            
            return  view('website.listAgents')->with([
                'agent' => $agent,
                'success'=> 'List of Selected Agents in '. 
                $request->input['state'] . " ". $request->input['lga'],
            ]);
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agentProperties($identity)
    {
        $seeProper =DB::table('properties')->where(["identity" => $identity ])->get();   
        return view("website.propertyDetails")->with('seeProper', $seeProper);
    }

    public function seeProperties($email)
    {
        $seePro =DB::table('properties')->where(["email" => $email])->get();
        return view("agentProperties")->with('seePro', $seePro);
    }

    public function agentInformtion($email)
    {
        $seeProper =DB::table('properties')->where(["email" => $email ])->get();
        $info =DB::table('agents')->where(["email" => $email ])->get();     
        return view("website.agentDetails")->with([
            'seeProper' =>$seeProper,
            "info" => $info,
        ]);
    }

    public function agent()
    {
       return view('agentProperties');
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
