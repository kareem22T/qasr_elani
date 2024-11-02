<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class ContactsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(10);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.contacts.index');
    }

    public function show(Contact $contact)
    {
        return View('admin.contacts.show', compact('contact'));
    }

    public function changeStatus(Contact $contact)
    {
        if ($contact->status == 0)
            $contact->update(['status' => 1]);
        else if ($contact->status == 1)
            $contact->update(['status' => 0]);
        return setRedirectWithMsg('other', 'admin/contacts/'.$contact->id);
    }

    public function addNotes(Request $request,Contact $contact)
    {
        $contact->update(['notes' => $request->notes , 'status' => 1]);
        return setRedirectWithMsg('other', 'admin/contacts/'.$contact->id);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return setRedirectWithMsg('delete', 'admin/contacts');
    }

    public function dataTable()
    {
        $contacts = Contact::select('id', 'name', 'phone', 'message','status','notes', 'created_at')->get();
        return DataTables::of($contacts)->editColumn('control', function ($model) {
            $all  = '<a href="' . url('/admin/contacts/' . $model->id) . '" class="btn btn-primary btn-circle" ><i class="fa fa-eye-slash"></i></a>';
            $all .= '<a href="' . url('/admin/contacts/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" ><i class="fa fa-trash-o"></i></a>';
            return $all;
        })->editColumn('message', function ($model) {
            return Str::limit($model->message, 50);
        })->editColumn('notes', function ($model) {
            return Str::limit($model->notes, 50);
        })->editColumn('status', function ($model) {
            if ($model->status == 0) {
                $all = '<button class="btn btn-danger btn-circle"> <i class="fa fa-times"></i>' . trans('contacts.open') . '</button> ';
            } else if ($model->status == 1) {
                $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('contacts.closed') . '</button> ';
            }
            return $all;
        })->rawColumns(['control', 'status'])->make(true);
    }
}
