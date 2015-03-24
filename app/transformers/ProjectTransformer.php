<?php namespace Transformers;

use Project;
use DB;
use Parsedown;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    public function transform(Project $project)
    {
        $markdown = new Parsedown();
        return
        [
            'id'                => (int) $project->id,
            'user'              => $project->user->first_name . ' ' . $project->user->last_name,
            'userId'            => (int) $project->user->id,
            'title'             => $project->title,
            'description'       => $project->description,
            'descriptionParsed' => $markdown->text($project->description),
            'skills'            => $project->skills,
            'skillsParsed'      => $markdown->text($project->skills),
            'category'          => $project->category->name,
            'categoryId'        => (int) $project->category->id,
            'tagsArray'         => (array) explode(',', $project->tags),
            'tags'              => $project->tags,
            'date'              => date_format(date_create($project->created_at), 'd.m.Y'),
            'startDate'         => date_format(date_create($project->start_date), 'd.m.Y'),
            'endDate'           => date_format(date_create($project->end_date), 'd.m.Y'),
            'location'          => $project->location,
            'contactType'       => $project->contact_type,
            'messages'          => (int) DB::table('messages')->where('project_id', '=', $project->id)->count()
        ];
    }
}