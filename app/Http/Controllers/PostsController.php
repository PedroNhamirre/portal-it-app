<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\user;
use App\Models\View;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::orderByDesc('created_at')->paginate(2);
        $users = User::whereIn('id', $posts->pluck('id_user'))->get();
        return view("posts.index")->with("posts", $posts)->with("users", $users);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "body" => "required",
            "cover_image" => "image|nullable|max:1999",
        ]);

        //handle file upload
        if ($request->hasFile('cover_image')) {
            //get fileName with extension
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();

            //get just the fileName
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

            // get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = "no-image.jpg";
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->id_user = Auth::id();
        $post->id_category = 2;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        $comments = Comment::where('id_post', $post->id)->get();
        $totalComments = $comments->count();


        // Verifica se o usuário já viu este post
        $view = View::where('id_post', $post->id)
            ->where('id_user', Auth::id())
            ->first();

        if (!$view) {
            // Incrementa o contador de visualizações apenas se o usuário não viu este post
            $post->view_count++;
            $post->save();

            // Registra a visualização no banco de dados
            View::create([
                'id_post' => $post->id,
                'id_user' => Auth::id(),
            ]);
        }

        // Get the username from id_user
        $username = User::find($post->id_user)->name;

        return view("posts.show")->with("post", $post)->with("username", $username)->with("totalComments", $totalComments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        if (Auth::id() !== $post->id_user) {
            abort(403); // Acesso Negado
        }

        return view("posts.edit")->with("post", $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            "title" => "required",
            "body" => "required",
            "cover_image" => "image|nullable|max:1999",
        ]);


        $post = Post::find($id);


        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->id_user = Auth::id();
        $post->id_category = 2;

        // Verifique se o usuário tem uma imagem de perfil anteriormente armazenada
        if ($post->cover_image && $post->cover_image !== 'no-image.jpg') {
            // Exclua a imagem antiga do armazenamento
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        if ($request->hasFile('cover_image')) {
            // Remove a imagem anterior, se existir
            if ($post->cover_image !== 'no-image.jpg') {
                Storage::delete('public/cover_images/' . $post->cover_image);
            }

            // Processo de upload da nova imagem
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

            // Atualiza o nome do arquivo da imagem no banco de dados
            $post->cover_image = $fileNameToStore;
        }


        $post->save();


        return redirect('/posts/' . $post->id)->with('success', 'Post editado com sucesso!');


    }


    public function search(Request $request)
    {
        $query = $request->input('query'); // Obtém a consulta de pesquisa do formulário

        // Usa o Eloquent para buscar postagens com base na consulta
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')
            ->orWhereRaw("LOWER(title) LIKE ?", ["%" . strtolower($query) . "%"])
            ->paginate(2);


        return view('posts.result')->with('posts', $posts);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (Auth::id() !== $post->id_user) {
            abort(403); // Acesso Negado
        }

        if ($post->cover_image !== 'no-image.jpg') {
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post removido com sucesso!');
    }
}
