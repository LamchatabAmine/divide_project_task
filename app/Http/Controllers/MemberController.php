<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\MemberRepository;
use App\Repositories\ManageMemberRepository;


class MemberController extends AppBaseController
{

    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }


    public function index()
    {
        $members = $this->memberRepository->index(['role' => 'member']);
        return view('member.index', compact('members'));
    }


    public function create()
    {
        return view('member.create');
    }


    public function store(Request $request)
    {
        // Define validation rules
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // If validation passes, continue with storing the member
        $validatedData = $request->all();
        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        $this->memberRepository->store($validatedData);

        $user = User::latest()->first();
        $user->assignRole('member');

        return redirect()->route('member.index')->with('success', 'Member created successfully');
    }


    public function edit(Member $member)
    {
        $member = $this->memberRepository->edit($member);

        return view('member.edit', compact('member'));
    }


    public function update(Request $request, Member $member)
    {
        // Define validation rules
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // If validation passes, continue with storing the member
        $validatedData = $request->all();

        $this->memberRepository->update($validatedData, $member);

        return redirect()->route('member.index')->with('success', 'Member updated successfully');
    }


    public function destroy(Member $member)
    {
        $this->memberRepository->destroy($member);

        return redirect()->route('member.index')->with('success', 'member supprimé avec succès');

    }


    public function export()
    {
        $members = User::role('member')->select('firstName', 'lastName', 'email')->get();

        return Excel::download(new MemberExport($members), 'members.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // dd($request);

        try {
            Excel::import(new MemberImport, $request->file('file'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre formulaire: ' . $errorMessage);
        } catch (\Exception $e) {
            return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        }

        return redirect()->route('member.index')->with('success', 'Membres a ajouté avec succès');
    }




    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        // Check if the search value is empty
        if (empty($search)) {
            $members = $this->memberRepository->index(['role' => 'member']);

        } else {
            $members = $this->memberRepository->index(['roleSearch' => ['role' => 'member', 'search' => $search]], 'firstName');
        }

        if ($request->ajax()) {
            return response()->json([
                'table' => view('member.table', compact('members'))->render(),
                'pagination' => $members->links()->toHtml(), // Get pagination links
            ]);
        }
    }





}
