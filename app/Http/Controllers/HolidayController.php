<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HolidayController extends Controller
{
    public function index()
    {
        $days = Holiday::all();
        return view('holidays', ['days' => $days]);
    }

    public function create()
    {
        return view('holidays');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'color' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'nullable|integer',
            'recurrent' => 'required|boolean',
        ]);

        $holiday = Holiday::create([
            'name' => $data['name'],
            'color' => $data['color'],
            'day' => $data['day'],
            'month' => $data['month'],
            'year' => $data['year'],
            'recurrent' => $data['recurrent'],
        ]);
        return redirect()->route('holidays.index')->with('success', 'Holiday created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Holiday $holiday)
    {
        return view('holiday-edit', ['holiday' => $holiday]);
    }

    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->validate([
            'name' => 'required',
            'color' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'nullable|integer',
            'recurrent' => 'required|boolean',
        ]);

        try {
            $holiday ->update([
                'name' => $data['name'],
                'color' => $data['color'],
                'day' => $data['day'],
                'month' => $data['month'],
                'year' => $data['year'],
                'recurrent' => $data['recurrent'],
            ]);

            return redirect()->route('holidays.index')->with('success', 'Día actualizado correctamente');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
            }
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('holidays.index')->with('success', 'Día eliminado correctamente');
    }
}
