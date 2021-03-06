<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
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
            'title'          => 'required',
            // 'video'          =>'required | mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'paid_video'     => 'nullable | mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'video_type'     => 'required',
            'description'    => 'required',
            'video_link'    => 'required'
        ]);

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = imageUpload($video, 'video');
        } else {
            $videoName = null;
        }

        if ($request->hasFile('paid_video')) {
            $video = $request->file('paid_video');
            $paidVideoName = imageUpload($video, 'video');
        } else {
            $paidVideoName = null;
        }

        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->video = $videoName;
        $video->paid_video = $paidVideoName;
        $video->status = 1;
        $video->video_link = $request->video_link;
        $video->amount = $request->amount;
        $video->video_type = $request->video_type;
        $video->save();
        return redirect()->route('admin.video.index')->with('success', 'Video added successfully');
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
        $video = Video::find($id);
        return view('admin.videos.edit', compact('video'));
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
        $this->validate($request, [
            'title'          => 'required',
            'video'          => 'nullable | mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'paid_video'     => 'nullable | mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'video_type'     => 'required',
            'description'    => 'required',
            'video_link'    => 'required'
        ]);

        $video = Video::find($id);
        // Thumbnail Video
        if ($request->hasFile('video')) {
            $image = $request->file('video');
            $video_name = explode('/', $video->video)[2];
            if (File::exists('upload/video/' . $video_name)) {
                File::delete('upload/video/' . $video_name);
            }
            $videoName = imageUpload($image, 'video');
        } else {
            $videoName = $video->video;
        }

        // Paid Video
        if ($request->hasFile('paid_video')) {
            $image = $request->file('paid_video');
            if ($video->paid_video) {
                $video_name = explode('/', $video->paid_video)[2];
                if (File::exists('upload/video/' . $video_name)) {
                    File::delete('upload/video/' . $video_name);
                }
            }

            $paidVideoName = imageUpload($image, 'video');
        } else {
            $paidVideoName = $video->paid_video;
        }

        $video->title = $request->title;
        $video->description = $request->description;
        $video->video = $videoName;
        $video->paid_video = $paidVideoName;
        $video->status = 1;
        $video->video_link = $request->video_link;
        $video->amount = $request->amount;
        $video->video_type = $request->video_type;
        $video->save();
        return redirect()->route('admin.video.index')->with('success', 'Video details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        return redirect()->route('admin.video.index')->with('success', 'Video details deleted successfully');
    }
}