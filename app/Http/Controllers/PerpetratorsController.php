<?php

namespace App\Http\Controllers;
use App\DataTables\PerpetratorsDataTable;
use App\Models\Perpetrator;

use Illuminate\Http\Request;

class PerpetratorsController extends Controller
{
    public function index(PerpetratorsDataTable $dataTable)
    {
        // return $dataTable->render('users.index');
        return $dataTable->render('pages.log.perpetrator.index');
    }

    public function destroy($id)
    {
        $perpetrator = Perpetrator::find($id);

        // Delete from db
        $perpetrator->delete();
    }
}
