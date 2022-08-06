<?php

namespace App\Http\Controllers\Admin;

use App\Models\Careers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


        public function index()
    {

            $jobs = Careers::orderBy('id', 'DESC')->get();



        return view('admin.careers.index',compact('jobs'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.careers.create');
    }
    public function GetApplications($id)
    {
        $career = Careers::findOrfail($id);

        $requests= $career->job_requests()->get();
         return view('admin.careers.job-requests', compact('requests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validationRules = [
            'title_ar' => 'required|min:3|max:20',
            'title_en' => 'required|min:3|max:20',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'brief_description_ar' => 'nullable',
            'brief_description_en' => 'nullable',
            'responsibilities_ar' => 'nullable',
            'responsibilities_en' => 'nullable',
         ];
        $attributes = $request->validate($validationRules);

        $job = Careers::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'brief_description_ar' => $request->brief_description_ar,
            'brief_description_en' => $request->brief_description_en,
            'responsibilities_ar' => $request->responsibilities_ar,
            'responsibilities_en' => $request->responsibilities_en,
            'created_at'=>Carbon::now(),
          ]);


        return redirect()->route('admin.careers.index')->with([
            'type' => 'success',
            'message' => 'Job insert successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Careers::find($id);
 return view('admin.careers.show',compact('job')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Careers::find($id);
        return view('admin.careers.edit',compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $attributes = $request->validate([
            'title_ar' => 'required|min:3|max:20',
            'title_en' => 'required|min:3|max:20',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'brief_description_ar' => 'nullable',
            'brief_description_en' => 'nullable',
            'responsibilities_ar' => 'nullable',
            'responsibilities_en' => 'nullable',
        ]);
     Careers::where('id', $id)
            ->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'brief_description_ar' => $request->brief_description_ar,
                'brief_description_en' => $request->brief_description_en,
                'responsibilities_ar' => $request->responsibilities_ar,
                'responsibilities_en' => $request->responsibilities_en,
            ]);

        return redirect()->route('admin.careers.index')->with([
            'type' => 'success',
            'message' => 'Job Update successfuly'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Careers::find($id)->delete();
        return redirect()->route('admin.careers.index')->with([
            'type' => 'success', 'message' => 'job deleted successfuly'
        ]);
    }
    public function changestatus($id){
        $job = Careers::find($id);
        if (!$job)
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

        $status =  $job -> status  == 0 ? 1 : 0;

        $job -> update(['status' =>$status ]);

        return redirect()->route('admin.careers.index')->with([
            'type' => 'success',
            'message' => 'Status Update successfuly'
        ]);

    }

}
