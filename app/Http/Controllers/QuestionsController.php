<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionsRequest;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Questions::all();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(QuestionsRequest $request)
    {
        $options = [];
        foreach (array_combine($request->options, $request->isTrue) as $opt => $isTr) {
            $option = [
                'text' => $opt,
                'is_true' => $isTr
            ];
            array_push($options, $option);
        }
        if ($request->image) {
            $image = $request->image;
            $q = Questions::create([
                'text' => $request->text,
                'score' => $request->score,
                'image' => $image->hashName()
            ]);
            $image->storeAs('public/questions/image', $image->hashName());
        } else {
            $q = Questions::create([
                'text' => $request->text,
                'score' => $request->score,
            ]);
        }
        $q->options()->createMany($options);
        return redirect()->route('admin.questions.index')->with(['success' => 'Berhasil menambah Data']);
    }

    public function edit(Questions $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(QuestionsRequest $request, Questions $question)
    {

        $question->text = $request->text;
        $question->score = $request->score;
        if ($request->image) {
            $image = $request->image;
            $question->image = $image->hashName();
            if ($question->image) Storage::disk('public')->delete('questions/image/' . $question->image);
            $image->storeAs('public/questions/image', $image->hashName());
        }
        $question->save();
        //delete
        foreach ($question->options as $opt) $op[$opt->id] = $opt->text;
        foreach (array_diff_key($op, $request->options) as $key => $opt) $question->options()->find($key)->delete();
        //update insert
        $isTrue = $request->isTrue;
        foreach ($request->options as $key => $value) {
            $opt = $question->options()->find($key);
            $option = [
                'text' => $value,
                'is_true' => $isTrue[$key]
            ];
            if ($opt) $opt->update($option);
            else $question->options()->create($option);
        }
        return redirect()->route('admin.questions.index')->with(['success' => 'Berhasil Edit Data']);
    }


    public function delete($id)
    {
        $question = Questions::find($id);
        $question->options()->delete();
        $question->delete();
        return "Sukses";
    }
}
