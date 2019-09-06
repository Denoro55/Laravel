<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Atricle;

class ArticleController extends Controller
{
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

    public function new()
    {
        $article = new Atricle();
        return view('article.new', compact('article'));
    }

    public function edit($id)
    {
        $article = Atricle::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update(Request $request, $id)
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

    public function show($id)
    {
        $article = Atricle::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function delete($id)
    {
        $article = Atricle::findOrFail($id);
        $article->delete();
        return redirect()
            ->route('articles.index');
    }

    function create(Request $request)
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
}
