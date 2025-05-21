<?php

namespace App\Http\Controllers\Panel;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AdminRequest;
use App\Http\Requests\Panel\BlogRequest;
use App\Http\Requests\Panel\CourseRequest;
use App\Http\Requests\Panel\LectureRequest;
use App\Http\Resources\Panel\AdminResource;
use App\Http\Resources\Panel\BlogResource;
use App\Http\Resources\Panel\CourseResource;
use App\Http\Resources\Panel\FaqResource;
use App\Http\Resources\Panel\LectureResource;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Faq;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class LectureController extends Controller
{
    public function index($id)
    {
        $data['course'] = Course::query()->findOrFail($id);
        return view('panel.lectures.index', $data);
    }

    public function datatable($id)
    {
        $items = Lecture::query()->where('course_id', $id)->latest()->filter();
        $resource = new LectureResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create($id)
    {
        Course::query()->findOrFail($id);
        return view('panel.lectures.create');
    }

    public function store($id, LectureRequest $request)
    {
        $course = Course::query()->find($id);
        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ]);
        }

        $data = $request->all();
        $data['course_id'] = $id;
        Lecture::query()->create($data)->createTranslation($request);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }


    public function edit($id, $l_id)
    {
        Course::query()->findOrFail($id);
        $data['item'] = Lecture::query()->where('course_id', $id)->findOrFail($l_id);
        return view('panel.lectures.create', $data);

    }

    public function update($id, $l_id, LectureRequest $request)
    {
        $course = Course::query()->find($id);
        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ]);
        }

        $item = Lecture::query()->where('course_id', $id)->find($l_id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }
        $data = $request->all();

        $item->update($data);
        $item->createTranslation($request);

        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);

    }

    public function destroy($id, $l_id)
    {
        $course = Course::query()->find($id);
        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ]);
        }

        $item = Lecture::query()->where('course_id', $id)->find($l_id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }

        if ($item->delete()) {
            return response()->json([
                'status' => true,
                'message' => __('messages.deleted_successfully')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => __('messages.error')
            ], 500);
        }
    }


    public function operation($id , $l_id)
    {
        $course = Course::query()->find($id);
        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ]);
        }

        $item = Lecture::query()->where('course_id' , $id)->find($l_id);


        if (isset($item)) {
            $item->is_active = !$item->is_active;
            $item->save();
            return response()->json([
                'status' => true,
                'message' => __('messages.done_successfully')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => __('messages.error')
            ], 500);
        }
    }
}
