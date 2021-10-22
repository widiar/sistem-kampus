<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionsRequest;
use App\Models\QuestionCategory;
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
        $category = QuestionCategory::all();
        return view('admin.questions.create', compact('category'));
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
                'category_id' => $request->category
            ]);
        }
        $q->options()->createMany($options);
        return redirect()->route('admin.questions.index')->with(['success' => 'Berhasil menambah Data']);
    }

    public function edit(Questions $question)
    {
        $category = QuestionCategory::all();
        return view('admin.questions.edit', compact('question', 'category'));
    }

    public function update(QuestionsRequest $request, Questions $question)
    {

        $question->text = $request->text;
        $question->score = $request->score;
        $question->category_id = $request->category;
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

    public function categoryIndex()
    {
        $category = QuestionCategory::all();
        return view('admin.questions.kategori.index', compact('category'));
    }

    public function categoryCreate()
    {
        return view('admin.questions.kategori.create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        QuestionCategory::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.questions.category')->with(['success' => 'Berhasil menambah Data']);
    }

    public function categoryEdit(QuestionCategory $category)
    {
        return view('admin.questions.kategori.edit', compact('category'));
    }

    public function categoryUpdate(Request $request, QuestionCategory $category)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.questions.category')->with(['success' => 'Berhasil update Data']);
    }

    public function categoryDelete(QuestionCategory $category)
    {
        $category->delete();
        return "Sukses";
    }
}
