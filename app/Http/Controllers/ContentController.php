<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\DynamicLink;
use Illuminate\Http\Request;
use App\Http\Resources\ContentsResource;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request()->get('per_page', 20);

        $contents = Content::paginate($perPage);
        //Return grouped linked list with values in one record and values are concat with comma seperate
        $groupedDynamicLinks = DynamicLink::select(['group', 'link'])
            ->selectRaw("GROUP_CONCAT(CONCAT(title)) AS titles")
            ->groupBy('group')
            ->get();

        foreach ($groupedDynamicLinks as $group) {
            $titlesGroup = explode(',', $group->titles);
            foreach ($titlesGroup as $title) {
                $titleWithoutLinkPattern = "/(?<=^|[^>])$title(?=$|[^<])/";
                foreach ($contents as &$content) {
                    //All word without <a> tag in body that equal to title in group
                    $content->body = preg_replace_callback($titleWithoutLinkPattern, function ($matches) use ($title, $group) {
                        return "<a href='$group->link'>" . $title . "</a>";
                    }, $content->body);
                }
            }
        }
        return ContentsResource::collection($contents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
