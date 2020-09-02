<?php

namespace App\Http\Controllers;

use App\File;
use Facade\Ignition\Support\Packagist\Package;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home', ["files" => Auth::user()->files, "order" => Auth::user()->order]);
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
        $validate = $request->validate([
            "upload"=> "required|max:100000"
        ]);
        foreach ($validate["upload"] as $file){
            $localName = uniqid();
            $realName = $file->getClientOriginalName();
            $dbFile = new File([
                "user_id" => Auth::user()->id,
                "real_name" => $realName,
                "local_name" => $localName,
                "size" =>$file->getSize(),
            ]);
            $dbFile->save();

            $file->storeAs("uploads", $localName);

        }

        return redirect("home");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "filename" => "required|min:1|max:128"
        ]);

        $file = File::find($id);

        if ($file) {
            $file->real_name = $validated["filename"];
            $file->save();
        } else {
            return response()->json(["error" => __("files.edit.invalidId")]);
        }

        return response()->json(["success" => __("files.edit.success")]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!$request->ids){
            return response()->json(["error" => __("files.delete.error")]);
    }
        $ids = explode(",",$request->ids);
        foreach ($ids as $id) {
            $file = File::find($id);
            if($file){
                Storage::delete("/uploads/{$file->local_name}");
                $file->delete();
            }
        }
        return response()->json(["success"=>__("files.delete.success")]);
    }
    public function makeZip($ids){

        $zip = new ZipArchive;
        $date  = date("d-m-Y");
        $username = Auth::user()->name;

        $fileName = "$date-$username-archive.zip";

        if ($zip->open(storage_path("app/archives/{$fileName}"), ZipArchive::CREATE)===TRUE){
            foreach ($ids as $id){
                $dbFile = File::find($id);
                if ($dbFile){
                    $zip->addFile(storage_path("app/uploads/{$dbFile->local_name}"), $dbFile->real_name);
                }
            }
           $zip->close();
        } else{
            return response()->json(["error"=>"files.download.ziperror"]);
        }
        return $fileName;
    }

    public function download(Request $request, $ids){
        if (!$ids){
            return response()->json(["error" => "files.download.error"]);
        }
        $ids = explode(",",$ids);
        if (count($ids) > 1) {
            $filename = $this->makeZip($ids);
            return response()->download(storage_path("/app/archives/{$filename}"));
        }else {
            $file = File::find($ids[0]);
            $filename = $file->local_name;
            return response()->download(storage_path("/app/uploads/{$filename}"),$file->real_name);
        }
    }
}
