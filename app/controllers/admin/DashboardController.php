<?php namespace Admin;

use View;
use DB;
use Response;
use Project;
use Carbon\Carbon;

class DashboardController extends BaseAdminController
{
    public function index()
    {
        $today = Carbon::now()->toDateTimeString();
        $recentProjects = Project::take(5)->get();
        return View::make('admin.dashboard.main')->with('recentProjects', $recentProjects);
    }

    /**
     * Get JSON chart data for monthly projects total in a selected year
     *
     * @param  int $year Year from which to get projects
     * @return Response       JSON response containg array with total projects by month
     */
    public function getProjectsChartData($year)
    {
        $data = [];
        for ($month = 1; $month <= 12; $month++)
        {
            $query = DB::select('SELECT COUNT(*) AS total FROM projects WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?', [$month, $year]);
            $data[] = $query[0]->total;
        }

        return Response::json($data);
    }
}