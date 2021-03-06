<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use App\Models\TempExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $data['class_wise_exam'] = ArrangeExam::where('class',  Auth::user()->class)->latest()->get();
        $data['group_wise_exam'] = ArrangeExam::where('group_id', Auth::user()->group_ids)->where('group_id', '!=', null)->latest()->get();
        return view('student.exam.index')->with($data);
    }

    public function exam(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $exam_details = ArrangeExam::find($id);
            $data['exam'] = $exam_details;
            $data['questions'] = Question::where('exam_id', $exam_details->id)->get();

            // Calculate exam time
            $start_time = strtotime($exam_details->start_time);
            $end_time = strtotime($exam_details->end_time);

            $exam_time = (($end_time - $start_time)/60);
            $data['exam_time'] = date('H:i', $end_time - $start_time);
            // $data['exam_time'] = date('H:i', $end_time - $start_time);
            return view('student.exam.exam')->with($data);
        }
        if ($request->isMethod('POST')) {
            // dd($request->all());
            // dd($request->index);
            $current_user_id = Auth::user()->id;

            $yes_ans = 0;
            $no_ans = 0;
            $skip_ans = 0;

            $total_marks = 0;
            $data = $request->all();
            $exam_details = ArrangeExam::find($request->exam_id);
            // dd($data);

            for ($i = 1; $i <= $request->index; $i++) {
                if (isset($data['question_id' . $i])) {
                    $exam = new Exam();

                    $question = Question::where('id', $data['question_id' . $i])->first();

                    // For MCQ Question
                    // It's calculate right and wrong answer
                    if ($exam_details->exam_type == 1) {

                        /* It's check if the ansher is automatically submitted or not
                        1 means user submitted and 0 means automatically submitted */
                        if ($request->is_user_submitted == "1") {
                            if ($question->answer === $data['answer' . $i]) {
                                $yes_ans++;
                            }
                            elseif ($data['answer' . $i] === null) {
                                $skip_ans++;
                            }
                            else {
                                $no_ans++;
                            }
                        }else{
                            $no_ans++;
                        }

                    }

                    // For mixed MCQ Question
                    // It's calculate right and wrong answer
                    if ($exam_details->exam_type == 3) {
                        // if ($data['question_type'][$i] == 1) {
                        if ($request->is_user_submitted == "1") {
                            if ($question->answer === $data['answer' . $i]) {
                                $yes_ans++;
                            }
                            elseif ($data['answer' . $i] === null) {
                                $skip_ans++;
                            }
                            else {
                                $no_ans++;
                            }
                        }else{
                            $no_ans++;
                        }
                        // }
                    }

                    // It's determine if the user is answer an question or not
                    if ($request->is_user_submitted == "1") {
                        if ($data['answer' . $i]) {
                            $exam->is_ans = "Yes";
                        }
                        elseif ($data['answer' . $i] === null) {
                            $exam->is_ans = "Skipped";
                        }
                        else{
                            $exam->is_ans = "No";
                        }
                    }else{
                        $exam->is_ans = "No";
                    }

                    $exam->user_id = $current_user_id;
                    $exam->question_id =  $question->id;
                    $exam->answer = $data['answer' . $i];
                    $exam->save();
                }
            }

            // Calculation of total marks for MCQ
            if ($exam_details->exam_type == 1 || $exam_details->exam_type == 3) {
                if ($request->is_user_submitted == "1") {
                    if ($yes_ans > 0) {
                        $total_marks = $yes_ans;
                    }
                    if ($no_ans > 0 && $exam_details->negative_marks == 1) {
                        $negative_marks = ($no_ans * 0.25);
                        $total_marks = ($total_marks - $negative_marks);
                    }
                }else{
                    $total_marks = 0;
                }
            }

            // Save result details
            $result = new Result();
            $result->user_id = $current_user_id;
            $result->exam_id = $data['exam_id'];
            if ($exam_details->exam_type == 1) {
                $result->yes_ans = $yes_ans;
                $result->no_ans = $no_ans;
                $result->skipped_ans = $skip_ans;
                $result->total_marks = $total_marks;
            }
            if ($exam_details->exam_type == 3) {
                $result->yes_ans = $yes_ans;
                $result->no_ans = $no_ans;
                $result->skipped_ans = $skip_ans;
                $result->temp_marks = $total_marks;
            }
            if ($request->is_user_submitted == "1") {
                $result->is_auto_submitted = 1;
            }else{
                $result->is_auto_submitted = 0;
            }
            $result->save();
            return redirect()->route('user.exam.index')->with('Success', 'Thank you :)');
        }
    }

    /*
        For descriptive type question student can save answer
        The answer store in  "temp_exam" table for tempory purpose
    */
    public function answer_save(Request $request)
    {
        if ($request->ajax()) {
            $current_user_id = Auth::user()->id;
            $question_id = $request->question_id;
            $answer = $request->answer;

            $already_answerd = TempExam::where('user_id',$current_user_id)->where('question_id',$question_id)->first();

            if (!$already_answerd) {
                $temp_exam = new TempExam();
                $temp_exam->user_id = $current_user_id;
                $temp_exam->question_id = $question_id;
                $temp_exam->answer = $answer;
                $temp_exam->save();
            }else{
                $already_answerd->answer = $answer;
                $already_answerd->save();
            }

            return response()->json('success');
        }
    }
}
