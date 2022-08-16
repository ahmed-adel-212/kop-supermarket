<?php

namespace App\Http\Controllers\Api;

use App\Models\Careers;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use DB;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\HealthInfo;
use App\Models\Item;
use App\Models\News;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;

class FrontController extends BaseController
{
    //aboutUS
    public function getAboutUS()
    {
        $aboutUS = AboutUs::all();
        return $this->sendResponse($aboutUS, 'AboutUS retrieved successfully.');
    }

    //gallery
    public function getGallery()
    {
        $gallery = Gallery::paginate(12);
        return $this->sendResponse($gallery, 'All Gallery retrieved successfully.');
    }

    //media Video
    public function getVideo($videoID = null)
    {
        $media = [];
        if ($videoID == null) {
            $all = Media::all();
            if (count($all) > 0) {
                $media['current'] = $all[0];
                //$media['allRemain'] = array_slice((array)$all, 1);
                $media['allRemain'] = $all;
            }
        } else {
            $media['current'] = Media::find($videoID);
            //$media['allRemain'] = Media::all()->except($videoID);
            $media['allRemain'] = Media::all();
        }
        return $this->sendResponse($media, 'All Media retrieved successfully.');
    }

    //News
    public function getAllNews()
    {
        $news = News::paginate(6);
        return $this->sendResponse($news, 'All News retrieved successfully.');
    }
    public function getAllNewsNoPaginate()
    {
        $news = News::all();
        return $this->sendResponse($news, 'All News retrieved successfully.');
    }

    public function getNew($newID)
    {
        $new = News::find($newID);
        if ($new) {
            return $this->sendResponse($new, 'News retrieved successfully.');
        }
        return $this->sendError('There is something');
    }

    //Health Info
    public function getAllHealthInfo()
    {
        $healthInfo = HealthInfo::all();
        return $this->sendResponse($healthInfo, 'All Health Info retrieved successfully.');
    }

    //Jobs
    public function getAllJobs()
    {
        $careers = Careers::where('status', true)->get();
        return $this->sendResponse($careers, 'All Careers Info retrieved successfully.');
    }

    public function GetJob($id)
    {
        $careers = Careers::find($id);

        return $this->sendResponse($careers, 'All Careers Info retrieved successfully.');
    }

    public function jobRequest(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'cv_file' => 'required|mimes:pdf',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Errors!', $validator->errors());
        }
        //check if application exist
        $countExist = JobRequest::where('id', $id)
            ->where(function ($q) use ($request) {
                $q->where('email', $request->email)
                    ->orWhere('phone', $request->phone);
            })->get()->count();
        if ($countExist > 0) {
            return $this->sendError('You have already sent an application for this job before', 'Application Not Sent');
        }

        try {
            $jobRequest = new JobRequest();
            $jobRequest->job_id = $id;
            $jobRequest->name = $request->name;
            $jobRequest->email = $request->email;
            $jobRequest->phone = $request->phone;
            $jobRequest->description = $request->description;

            if ($request->hasFile('cv_file')) {
                $cv_file = $request->cv_file;
                $cv_file_new_name = time() . $cv_file->getClientOriginalName();
                $cv_file->move(public_path('CV'), $cv_file_new_name);
                $jobRequest->cv_file = '/CV/' . $cv_file_new_name;
            }
            $jobRequest->save();

            return $this->sendResponse($jobRequest, 'Application Sent');
        } catch (\Exception $ex) {
            return $this->sendError('There is something', $validator->errors());
        }
    }

    public function getHomeSections()
    {
        $banner = Banner::all();

        // recommended items
        $recommended = Item::where('recommended', true)->get();

        // categories with items
        $categories = Category::with('items')->get();

        // offers
        $offers = Offer::with('buyGet', 'discount')->where('main', true)->get();

        return $this->sendResponse(compact('banner', 'recommended', 'categories', 'offers'), 'Get all menu items');
    }
}
