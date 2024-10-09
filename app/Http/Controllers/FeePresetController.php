<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeePreset;
use App\Models\FeePercentage;
use App\Models\Service;

class FeePresetController extends Controller
{
    // عرض قائمة الرسوم
    public function index()
    {
        $feePresets = FeePreset::all(); // جلب جميع Fee Presets
        return view('fee_presets.index', compact('feePresets'));
    }

    // عرض نموذج إنشاء رسوم جديدة
    public function create()
    {
        return view('fee_presets.create'); // عرض صفحة إنشاء جديدة
    }

    // تخزين عنصر جديد
    public function store(Request $request)
    {
        // تحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // إنشاء رسوم جديدة
        $feePreset = FeePreset::create([
            'name' => $request->name,
        ]);

        // إعادة توجيه إلى قائمة الرسوم مع رسالة نجاح
        return redirect()->route('fee_presets.index')->with('success', 'Fee Preset created successfully.');
    }

    // show fee percentages for every preset..
    public function show($id)
    {   
        $feePreset = FeePreset::findOrFail($id);
        $services = Service::all(); // Get all services
        $feePercentages = FeePercentage::with(['feePreset', 'service', 'threshold'])
                                ->where('fee_preset_id', $id)
                                ->get()
                                ->groupBy('process_id'); // Grouping by process_id;
        return view('fee_presets.show', compact('feePreset', 'feePercentages', 'services'));
    }

    // عرض نموذج تحرير رسوم موجودة
    public function edit($id)
    {
        $feePreset = FeePreset::findOrFail($id); // جلب الرسوم المحددة
        return view('fee_presets.edit', compact('feePreset')); // عرض صفحة تحرير
    }

    // تحديث عنصر موجود
    public function update(Request $request, $id)
    {
        // تحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // تحديث الرسوم
        $feePreset = FeePreset::findOrFail($id);
        $feePreset->update([
            'name' => $request->name,
        ]);

        // إعادة توجيه إلى قائمة الرسوم مع رسالة نجاح
        return redirect()->route('fee_presets.index')->with('success', 'Fee Preset updated successfully.');
    }

    // حذف عنصر موجود
    public function destroy($id)
    {
        $feePreset = FeePreset::findOrFail($id);
        $feePreset->delete();

        // إعادة توجيه إلى قائمة الرسوم مع رسالة نجاح
        return redirect()->route('fee_presets.index')->with('success', 'Fee Preset deleted successfully.');
    }
}
