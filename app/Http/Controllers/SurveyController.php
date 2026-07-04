<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller {
    public function store(Request $request) {
        // 驗證並儲存
        $survey = new Survey();
        $survey->role = $request->role;
        $survey->rating = $request->rating;
        $survey->other_skills = $request->other_skills; // Model 中需設定 casts => json
        $survey->save();

        return response()->json(['status' => 'success']);
    }
}
