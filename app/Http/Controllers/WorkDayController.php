<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkDay;
use App\Models\WorkDayComment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkDayController extends Controller
{
    // EMPLOYEE: lista dni z bieżącego miesiąca
    public function employeeIndex(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m')); // np. 2026-01

        $days = WorkDay::with(['comments.user', 'creator'])
            ->where('user_id', auth()->id())
            ->whereRaw("DATE_FORMAT(day, '%Y-%m') = ?", [$month])
            ->orderBy('day', 'asc')
            ->get();

        return view('employee.workdays.index', compact('days', 'month'));
    }

    // MANAGER/ADMIN: formularz dodania godzin
    public function managerCreate()
    {
        $employees = User::where('role', 'employee')->orderBy('name')->get();
        return view('manager.workdays.create', compact('employees'));
    }

    // MANAGER/ADMIN: zapis godzin
    public function managerStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'day' => ['required', 'date'],
            'hours' => ['required', 'integer', 'min:0', 'max:24'],
        ]);

        WorkDay::updateOrCreate(
            ['user_id' => $validated['user_id'], 'day' => $validated['day']],
            ['hours' => $validated['hours'], 'created_by' => auth()->id()]
        );

        return redirect()->back()->with('success', 'Godziny zapisane.');
    }

    // KOMENTARZ: employee/manager/admin
    public function comment(Request $request, WorkDay $workDay)
    {
        $request->validate([
            'body' => ['required', 'string', 'min:2'],
        ]);

        // employee może komentować tylko swoje dni
        if (auth()->user()->role === 'employee' && $workDay->user_id !== auth()->id()) {
            abort(403);
        }

        WorkDayComment::create([
            'work_day_id' => $workDay->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Komentarz dodany.');
    }

    public function adminIndex(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $userId = $request->get('user_id');

        $query = WorkDay::with(['user', 'creator', 'comments.user'])
            ->whereRaw("DATE_FORMAT(day, '%Y-%m') = ?", [$month])
            ->orderBy('day', 'asc');

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $days = $query->get();

        $employees = User::orderBy('name')->get(); // admin może filtrować po każdym

        return view('admin.workdays.index', compact('days', 'month', 'userId', 'employees'));
    }

}
