<?php

namespace App\Http\Controllers;

use App\Atricle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Atricle::paginate(3);
        $url = route('articles.index');
        $flash = false;

        if ($request->session()->exists('status')) {
            $value = $request->session()->get('status');
            $flash = $value;
        }

        return view('article.index', compact('articles', 'flash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Atricle();
        return view('article.new', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        $this->validate($request, [
            'name' => 'required|unique:atricles',
            'body' => 'required|min:20',
        ]);

        $article = new Atricle();
        // Заполнение статьи данными из формы
        $article->fill($request->all());
        // При ошибках сохранения возникнет исключение
        $article->save();

        $request->session()->flash('status', 'Статья добавлена!');

        // Редирект на указанный маршрут с добавлением флеш сообщения
        return redirect()
            ->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atricle  $atricle
     * @return \Illuminate\Http\Response
     */
    public function show(Atricle $atricle, $id)
    {
        $article = Atricle::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atricle  $atricle
     * @return \Illuminate\Http\Response
     */
    public function edit(Atricle $atricle, $id)
    {
        $article = Atricle::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atricle  $atricle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atricle $atricle, $id)
    {
        $article = Atricle::findOrFail($id);
        $this->validate($request, [
            // У обновления немного измененная валидация. В проверку уникальности добавляется id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:atricles,' . $article->id,
            'body' => 'required|min:20',
        ]);

        $request->session()->flash('status', 'Статья обновлена!');

        $article->fill($request->all());
        $article->save();
        return redirect()
            ->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atricle  $atricle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atricle $atricle, $id)
    {
        $article = Atricle::findOrFail($id);
        $article->delete();
        return redirect()
            ->route('articles.index');
    }
}
