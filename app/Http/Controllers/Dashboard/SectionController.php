<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('id', 'desc')->get();
        return view('dashboard.sections.index', compact('sections'));
    }

    public function store(SectionRequest $request)
    {
        try {

            // Request Validator
            $section = $request->all();
            $exists = Section::where('name', $section['name'])->exists();
            if ($exists) {
                toast('هذا الاسم موجود ادخل اسم مختلف', 'error');
                return redirect()->route('sections.index');
            }

            // Create new section
            Section::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'created_by' => auth()->user()->name,
            ]);
            toast('تم الاضافة بنجاح', 'success');
            return redirect()->route('sections.index');

            // Exception
        } catch (\Exception $exception) {
            toast('حدث خطا ما حاول مرة اخري', 'error');
            return redirect()->route('sections.index');
        }
    }


    public function update(SectionRequest $request, $id)
    {
        $section = Section::find($id);
        $section->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        toast('تم التعديل بنجاح', 'success');
        return redirect()->route('sections.index');
    }

    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        toast('تم الحذف بنجاح', 'success');
        return redirect()->route('sections.index');
    }
}
