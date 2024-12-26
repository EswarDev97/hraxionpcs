<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Access;

class OrganizationController extends Controller
{
    public function index()
    {
        $accesses = Access::all();
        $ceo = Employee::where('name', 'Arul Ramdoss')->first();
        $tree = $ceo->getOrganizationTree();

        return view('organization.index', compact('tree'), ['accesses' => $accesses]);
    }


    public function showOrganizationTree()
{
    $employee = Employee::find(1); // Or the root employee id you want to start with
    if (!$employee) {
        return view('organization.tree', ['tree' => null]);
    }

    $tree = $employee->getOrganizationTree();

    return view('organization.tree', ['tree' => $tree]);
}
public function showTree()
{
    $tree = $this->getOrganizationTree(); // Adjust based on your implementation

    return view('organization.tree', compact('tree'));
}

}